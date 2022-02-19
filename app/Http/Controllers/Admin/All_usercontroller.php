<?php

namespace App\Http\Controllers\Admin;

use App\AllUser;
use App\Assign_technician_device;
use App\Billing_shedule;
use App\Device;
use App\Complain;
use App\custom_order;
use App\Contact_info;
use App\order;
use App\Exports\UsersExport;
use App\monthly_bill_update_status;
use App\Payment;
use App\payment_confarmation_history;
use App\payment_history;
use App\repair_service;
use App\Technician;
use App\User;
use App\vehicle_details;
use App\user_logins;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Webpatser\Uuid\Uuid;

class All_usercontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $technician = Technician::all();
        $user = AllUser::where('order_status',0)->latest()->get();
        $device = Device::all();
        return  view('backend.all_user.all_user',compact('user','technician','device'));
    }

    public function corporate_user()
    {
        $technician = Technician::all();
        $user = AllUser::where('user_type',2)->latest()->get();
        $device = Device::all();
        return  view('backend.all_user.all_user',compact('user','technician','device'));
    }

    public function individual_user()
    {
        $technician = Technician::all();
        $user = AllUser::where('user_type',1)->latest()->get();
        $device = Device::all();
        return  view('backend.all_user.all_user',compact('user','technician','device'));
    }
    public function expire_user()
    {
        $technician = Technician::all();
        $user = AllUser::where('expair_status',1)->latest()->get();
        $device = Device::all();
        return  view('backend.all_user.all_user',compact('user','technician','device'));
    }

    public function paid_user()
    {
        $technician = Technician::all();
        $user = AllUser::where('payment_status',1)->where('expair_status',0)->latest()->get();
        $device = Device::all();
        return  view('backend.all_user.all_user',compact('user','technician','device'));
    }

    public function due_user()
    {
        $one_months_plus = Carbon::createFromFormat('Y-m-d',Carbon::now()->toDateString())->firstOfMonth()->addMonths()->firstOfMonth();

        $now = Carbon::createFromFormat('Y-m-d',Carbon::now()->toDateString())->firstOfMonth();

        $total_due_user = AllUser::where('next_payment_date','<=',$now)->where('service_problem_status',0)->where('expair_status',0)->where('order_status',0)->get();
        $this_months_paid = AllUser::where('next_payment_date','=',$one_months_plus)->where('service_problem_status',0)->get();


        foreach ($total_due_user as $data)
        {
                $user = AllUser::find($data->id);
                $user->next_payment_date = $one_months_plus;
                $user->payment_status = 0;
                $user->duesms = 0;
                $user->update();

                $payment_history = new payment_history();
                $payment_history->user_id = $user->id;
                $payment_history->month_name = $now;
                $payment_history->total_paid_until_this_date = '';
                $payment_history->total_due = $user->monthly_bill;
                $payment_history->payment_status = 0;
                $payment_history->nest_payment_date = $user->next_payment_date;
                $payment_history->save();

        }

        $technician = Technician::all();
        $user = AllUser::where('payment_status',0)->where('demo',0)->where('expair_status',0)->where('service_problem_status',0)->latest()->get();
        $device = Device::all();
        return  view('backend.all_user.all_user',compact('user','technician','device'));
    }
    public function pendingServicing()
    {
        $user = AllUser::where('service_problem_status',1)->latest()->get();
        $technician = Technician::all();
        $device = Device::all();
        return  view('backend.all_user.all_user',compact('user','technician','device'));
    }
    public function updateRepair($id)
    {
        $user = AllUser::find($id);
        $user->service_problem_status = 0;
        $user->update();
        
        $repair = repair_service::where('user_id',$id)->where('service_status',0)->latest()->first();
        $repair->service_status = 1;
        $repair->update();
        
        $assign_tecnician = Assign_technician_device::where('user_id',$id)->where('status',0)->latest()->first();
        $assign_tecnician->status = 1;
        $assign_tecnician->update();
        
        $payment = payment_history::where('user_id',$id)->whereMonth('month_name', Carbon::now()->format('m'))->latest()->first();
        if($payment->count() == 0){
            
            $payment_history = new payment_history();
            $payment_history->user_id = $user->id;
            $payment_history->month_name = $now;
            $payment_history->total_paid_until_this_date = '';
            $payment_history->total_due = $user->monthly_bill;
            $payment_history->payment_status = 0;
            $payment_history->nest_payment_date = $user->next_payment_date;
            $payment_history->save();
        }
        
        Toastr::success('Technician completed the repair successfully!','Success');
        return redirect()->route('admin.pending_servicing');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return  view('backend.all_user.add_user');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'phone' => ['required','unique:users'],
                'user_type' => 'required',
                'car_number' => 'required',
                'car_model' => 'required',
                'installation_date' => 'required',
                'monthly_bill' => 'required',
                'due_date' => 'required',
//                'device_price' => 'required',
         ]);

        $due_date =  $request->due_date;

        $from = Carbon::createFromFormat('Y-m-d', $due_date)->firstOfMonth();

        $to = Carbon::createFromFormat('Y-m-d',Carbon::now()->toDateString())->firstOfMonth();




        $diff_in_months = $to->diffInMonths($from);
//        dd($to < $from,$to > $from,$to  == $from);



        $for_user_table = new User();
        $for_user_table->name = $request->name;
        $for_user_table->email = $request->email;
        $for_user_table->phone = $request->phone;
        $for_user_table->role = 2;
        $for_user_table->password = Hash::make('123456');
        $for_user_table->save();


        $user = new AllUser();
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->user_id = $for_user_table->id;
        $user->alter_phone = $request->alter_phone;
        $user->email = $request->email;
        $user->par_add = $request->par_add;
        $user->user_type = $request->user_type;

        $user->car_number = $request->car_number;
        $user->car_model = $request->car_model;
        $user->installation_date = $request->installation_date;
        $user->due_date = $request->due_date;
        $user->monthly_bill = $request->monthly_bill;
        $user->total_due = $request->total_due;
        $user->total_paied = $request->total_paied;
        $user->device_price = $request->device_price;
        $user->save();

        $vehicle = new vehicle_details();
        $vehicle->all_user_id = $user->id;
        $vehicle->user_id = $for_user_table->id;
        $vehicle->vehicle_registration = $request->car_number;
        $vehicle->vehicle_type = $request->car_model;
        $vehicle->price = $request->monthly_bill;
        $vehicle->save();

        if ($to < $from){
//            if ($request->payment_this_date == null){
//                Toastr::error('Please Input the advanced amount:)','Advanced payment Field Required');
//                return redirect()->back();
//            }

            $payment_history = new payment_history();
            $payment_history->user_id = $user->id;
            $payment_history->month_name = $from;
            $payment_history->payment_this_date = $request->payment_this_date;
            $payment_history->total_paid_until_this_date = '';
            $payment_history->total_due = $request->monthly_bill;
            $payment_history->payment_status = 0;
            $payment_history->nest_payment_date = $from->firstOfMonth();
            $payment_history->save();

            $user->next_payment_date = $to->addMonths(1)->firstOfMonth();
            $user->payment_status = 0;
            $user->update();
        }elseif($to == $from)
        {
            $after_reduce_one_months = $from->subMonth();
            for ($i=0; $i<=$diff_in_months;$i++){
            $trialExpires = $after_reduce_one_months->addMonths(1);

            $payment_history = new payment_history();
            $payment_history->user_id = $user->id;
            $payment_history->month_name = $trialExpires;
            $payment_history->payment_this_date = $request->payment_this_date;
            $payment_history->total_paid_until_this_date = '';
            $payment_history->total_due = $request->monthly_bill;

            $payment_history->save();
            }
               $user->next_payment_date = $trialExpires->addMonths()->firstOfMonth();
               $user->payment_status = 0;
               $user->update();
        }

        elseif($to > $from){
            $after_reduce_one_months = $from->subMonth();
            for ($i=0; $i<=$diff_in_months+1;$i++){
            $trialExpires = $after_reduce_one_months->addMonths(1);

            $payment_history = new payment_history();
            $payment_history->user_id = $user->id;
            $payment_history->month_name = $trialExpires;
            $payment_history->payment_this_date = $request->payment_this_date;
            $payment_history->total_paid_until_this_date = '';
            $payment_history->total_due = $request->monthly_bill;

            $payment_history->save();
            }
               $user->next_payment_date = $trialExpires->addMonths()->firstOfMonth();
               $user->payment_status = 0;
               $user->update();

        }
        $contact = Contact_info::all()->first();
        $user = AllUser::find($user->id);
        $number_of_due_months = payment_history::where('user_id',$user->id)->where('payment_status',0)->get()->count();
            $curl = curl_init();
            curl_setopt_array($curl, array( CURLOPT_RETURNTRANSFER => 1, CURLOPT_URL => 'http://api.greenweb.com.bd/api.php?token=26a7280482e3d86e5ceb1ae5ffacd67d&to='.$user->phone.'&message='.rawurlencode('Welcome to Techno Track BD. You can login to your user portal by visiting https://www.technotrack.com.bd/user_login with your phone number and password: 123456. Your due bill is '.$number_of_due_months * $user->monthly_bill.' tk. Please pay the bill before your connection get expired. bKash - '.$contact->bKash.', Rocket- '.$contact->Rocket.', Nagad- '.$contact->Nagad.'.  Please call us at '.$contact->header_phone_3.' for support. Use ref. Id- '.$user->id.'TechnoTrack
            Techno Track BD ').'', CURLOPT_USERAGENT => 'Sample cURL Request' ));
            $resp = curl_exec($curl);
            curl_close($curl);

        Toastr::success('User '.$user->name.' created Successfully :)','Success');
        return redirect()->route('admin.all_user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $user = AllUser::find($id);
        $payment = payment_history::where('user_id',$user->id)->orderBy('id','desc')->get();
        $payment_confermation = payment_confarmation_history::where('user_id',$id)->latest()->get();
        $monthly_bill_update_history = monthly_bill_update_status::where('user_id',$id)->latest()->get();
        $onloine_payment = Payment::where('user_id',$user->user_id)->where('status','Processing')->orderBy('id','desc')->get();
        $vehicles = vehicle_details::where('user_id',$user->user_id)->orderBy('status','desc')->get();

        return view('backend.all_user.user_profile',compact('user','payment','payment_confermation','monthly_bill_update_history','onloine_payment','vehicles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = AllUser::findOrFail($id);
        return view('backend.all_user.edit_user',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'car_number' => 'required',
//                'car_model' => 'required',
                'installation_date' => 'required',
                'monthly_bill' => 'required',
//                'device_price' => 'required',
         ]);
        $user = AllUser::findOrFail($id);

        $for_user_table = User::find($user->user_id);
        $for_user_table->name = $request->name;
        $for_user_table->email = $request->email;
        $for_user_table->password = Hash::make('123456');
        $for_user_table->update();


        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->alter_phone = $request->alter_phone;
        $user->email = $request->email;
        $user->par_add = $request->par_add;
        $user->car_number = $request->car_number;
        $user->car_model = $request->car_model;
        $user->installation_date = $request->installation_date;
        $user->monthly_bill = $request->monthly_bill;
        $user->device_price = $request->device_price;
        $user->update();

        Toastr::success('Update Successfully :)','Success');
        return redirect()->route('admin.all_user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = AllUser::findOrFail($id)->delete();
        Toastr::success('Deleted Successfully :)','Success');
        return redirect()->back();
    }

    public function user_delete($id)
    {
        $contact = Contact_info::all()->first();
        $user = AllUser::findOrFail($id);
        $user->expair_status = 1;
        $user->update();

        $payment_history = payment_history::where('user_id',$user->id)->where('payment_status',0)->get()->count();

        $curl = curl_init();
        curl_setopt_array($curl, array( CURLOPT_RETURNTRANSFER => 1, CURLOPT_URL => 'http://api.greenweb.com.bd/api.php?token=26a7280482e3d86e5ceb1ae5ffacd67d&to='.$user->phone.'&message='.rawurlencode('Your Connection has been expired. Please pay the due bill to active your connection. Your total due bill is '.$payment_history * $user->monthly_bill.'tk for '.$payment_history.' months. Please call us at '.$contact->header_phone_3.' for support. Thank you for being with TechnoTrack BD').'', CURLOPT_USERAGENT => 'Sample cURL Request' ));
        $resp = curl_exec($curl);
        curl_close($curl);

        Toastr::success('Expired Successfully :)','Success');
        return redirect()->back();
    }

    public function active_user($id)
    {
        $contact = Contact_info::all()->first();
        $user = AllUser::findOrFail($id);
        $user->expair_status = 0;
        $user->update();

        $curl = curl_init();
        curl_setopt_array($curl, array( CURLOPT_RETURNTRANSFER => 1, CURLOPT_URL => 'http://api.greenweb.com.bd/api.php?token=26a7280482e3d86e5ceb1ae5ffacd67d&to='.$user->phone.'&message='.rawurlencode('Thank You for Your Payment,Your Connection is Now Active. Thank you for being with TechnoTrack BD.').'', CURLOPT_USERAGENT => 'Sample cURL Request' ));
        $resp = curl_exec($curl);
        curl_close($curl);

        Toastr::success('Activated Successfully :)','Success');
        return redirect()->back();
    }

    public function single_sms($id)
    {
        $contact = Contact_info::all()->first();
        $user = AllUser::findOrFail($id);

        $curl = curl_init();
        curl_setopt_array($curl, array( CURLOPT_RETURNTRANSFER => 1, CURLOPT_URL => 'http://api.greenweb.com.bd/api.php?token=26a7280482e3d86e5ceb1ae5ffacd67d&to='.$user->phone.'&message='. rawurlencode('Your total due bill is '.$payment_history * $user->monthly_bill.'tk for '.$payment_history.' months. Please pay the bill as soon as possible. bKash - '.$contact->bKash.', Rocket- '.$contact->Rocket.', Nagad- '.$contact->Nagad.'.  Please call us at '.$contact->header_phone_3.' for support. Use ref. Id- '.$user->id.'TechnoTrack
        Techno Track BD. 
        Techno Track BD').'', CURLOPT_USERAGENT => 'Sample cURL Request' ));
        $resp = curl_exec($curl);
        curl_close($curl);

        Toastr::success('Message sent to '.$user->name.' :)','Success');
        return redirect()->back();
    }

    public function monthly_bill_update(Request $request,$id)
    {

        $request->validate([
                'monthly_bill' => 'required',
         ]);

        $user = AllUser::find($id);

        if ($user->monthly_bill == $request->monthly_bill){
            Toastr::Error('You Write The Same Previous Amount','Success');
            return redirect()->back();
        }else{
            $contact = Contact_info::all()->first();
            $curl = curl_init();
            curl_setopt_array($curl, array( CURLOPT_RETURNTRANSFER => 1, CURLOPT_URL => 'http://api.greenweb.com.bd/api.php?token=26a7280482e3d86e5ceb1ae5ffacd67d&to='.$user->phone.'&message='. rawurlencode('Your existing monthly bill '.$user->monthly_bill.' taka has been updated to '.$request->monthly_bill.' taka. Please call us at '.$contact->header_phone_3.' for support. ').'', CURLOPT_USERAGENT => 'Sample cURL Request' ));
            
            $resp = curl_exec($curl);
            curl_close($curl);
            
            $user->monthly_bill = $request->monthly_bill;
            $user->update();

            $monthly_bill_update_status = new monthly_bill_update_status();
            $monthly_bill_update_status->user_id = $id;
            $monthly_bill_update_status->admin_id = Auth::id();
            $monthly_bill_update_status->monthly_bill = $request->monthly_bill;
            $monthly_bill_update_status->save();

        Toastr::success('Monthly Bill Updated Successfully :)','Success');
        return redirect()->back();
        }

    }


    public function full_order_history($id)
    {
        $user = AllUser::findOrFail($id);
        $orders = Assign_technician_device::where('user_id',$user->id)->latest()->get();
        $payment_confermation = payment_confarmation_history::where('user_id',$id)->latest()->get();
        $monthly_bill_update_history = monthly_bill_update_status::where('user_id',$id)->latest()->get();
        $payment = payment_history::where('user_id',$user->id)->orderBy('id','desc')->get();


        return view('backend.all_user.order_history',compact('user','orders','payment_confermation','monthly_bill_update_history','payment'));
    }



    public function bill_schedule(Request $request)
    {
        $bill_schedule = new Billing_shedule();
        $bill_schedule->note = $request->note;
        $bill_schedule->date = $request->date;
        $bill_schedule->user_id = $request->user_id;
        $bill_schedule->save();

        Toastr::success('Billing Schedule Save Successfully','Success');
        return redirect()->back();
    }


    public function export()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }


public function update_user_after_mistake(Request $request)
    {
        $all_user = AllUser::find($request->user_id);
        $user = User::find($all_user->user_id)->delete();
        $all_user->delete();


        $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'phone' => ['required','unique:users'],
                'user_type' => 'required',
                'car_number' => 'required',
//                'car_model' => 'required',
                'installation_date' => 'required',
                'monthly_bill' => 'required',
                'due_date' => 'required',
//                'device_price' => 'required',
         ]);

        $due_date =  $request->due_date;

        $from = Carbon::createFromFormat('Y-m-d', $due_date)->firstOfMonth();

        $to = Carbon::createFromFormat('Y-m-d',Carbon::now()->toDateString())->firstOfMonth();




        $diff_in_months = $to->diffInMonths($from);
//        dd($to < $from,$to > $from,$to  == $from);



        $for_user_table = new User();
        $for_user_table->name = $request->name;
        $for_user_table->email = $request->email;
        $for_user_table->phone = $request->phone;
        $for_user_table->role = 2;
        $for_user_table->password = Hash::make('123456');
        $for_user_table->save();


        $user = new AllUser();
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->user_id = $for_user_table->id;
        $user->alter_phone = $request->alter_phone;
        $user->email = $request->email;
        $user->par_add = $request->par_add;
        $user->user_type = $request->user_type;

        $user->car_number = $request->car_number;
        $user->car_model = $request->car_model;
        $user->installation_date = $request->installation_date;
        $user->due_date = $request->due_date;
        $user->monthly_bill = $request->monthly_bill;
        $user->total_due = $request->total_due;
        $user->total_paied = $request->total_paied;
        $user->device_price = $request->device_price;
        $user->save();


        if ($to < $from){
//            if ($request->payment_this_date == null){
//                Toastr::error('Please Input the advanced amount:)','Advanced payment Field Required');
//                return redirect()->back();
//            }

            $payment_history = new payment_history();
            $payment_history->user_id = $user->id;
            $payment_history->month_name = $from;
            $payment_history->payment_this_date = $request->payment_this_date;
            $payment_history->total_paid_until_this_date = '';
            $payment_history->total_due = $request->monthly_bill;
            $payment_history->payment_status = 0;
            $payment_history->nest_payment_date = $from->firstOfMonth();
            $payment_history->save();

            $user->next_payment_date = $from->addMonths()->firstOfMonth();
            $user->payment_status = 1;
            $user->update();
        }elseif($to == $from)
        {
            $after_reduce_one_months = $from->subMonth();
            for ($i=0; $i<=$diff_in_months;$i++){
            $trialExpires = $after_reduce_one_months->addMonths(1);

            $payment_history = new payment_history();
            $payment_history->user_id = $user->id;
            $payment_history->month_name = $trialExpires;
            $payment_history->payment_this_date = $request->payment_this_date;
            $payment_history->total_paid_until_this_date = '';
            $payment_history->total_due = $request->monthly_bill;

            $payment_history->save();
            }
               $user->next_payment_date = $trialExpires->addMonths()->firstOfMonth();
               $user->payment_status = 0;
               $user->update();
        }

        elseif($to > $from){
            $after_reduce_one_months = $from->subMonth();
            for ($i=0; $i<=$diff_in_months+1;$i++){
            $trialExpires = $after_reduce_one_months->addMonths(1);

            $payment_history = new payment_history();
            $payment_history->user_id = $user->id;
            $payment_history->month_name = $trialExpires;
            $payment_history->payment_this_date = $request->payment_this_date;
            $payment_history->total_paid_until_this_date = '';
            $payment_history->total_due = $request->monthly_bill;

            $payment_history->save();
            }
               $user->next_payment_date = $trialExpires->addMonths()->firstOfMonth();
               $user->payment_status = 0;
               $user->update();

        }


        Toastr::success('Please Dont Mistake Again','Success');
        return redirect()->route('admin.all_user.index');
    }

    public function user_note_save(Request $request,$id)
    {
        $all_user = AllUser::find($id);
        $all_user->note =$request->note;
        $all_user->update();


        return response()->json([
            'message' => $all_user,
        ]);
    }
    
    /*---------------
    Vehicle management
    ---------------*/
    public function addVehicle(Request $request, $id)
    {
        $user = AllUser::find($id);
        
        $request->validate([
                'vehicle_number' => ['required', 'string', 'max:255'],
                'vehicle_type' => 'required',
                'price' => 'required',
        ]);
         
        $new_vehicle = new vehicle_details();
        $new_vehicle->all_user_id = $user->id;
        $new_vehicle->user_id = $user->user_id;
        $new_vehicle->vehicle_registration = $request->vehicle_number;
        $new_vehicle->vehicle_type = $request->vehicle_type;
        $new_vehicle->price = $request->price;
        $new_vehicle->save();
         
        $user->monthly_bill = $user->monthly_bill + $request->price;
        $user->payment_status = 0;
        $user->update();
        
        $due_update = payment_history::where('user_id',$id)->latest()->first();
        $due_update->total_due = $due_update->total_due + $request->price;
        $due_update->payment_status = 0;
        $due_update->update();
        
         
        Toastr::success('New vehicle added.','Success');
        return redirect()->back();
    }
    public function updateVehicle(Request $request, $id)
    {
        $updateVehicle = vehicle_details::find($id);
        $updateVehicle->updated_by = Auth::id();
        $updateVehicle->vehicle_registration = $request->vehicle_number;
        $updateVehicle->price = $request->price;
        $updateVehicle->update();
        
        Toastr::success('Vehicle updated successfully.','Success');
        return redirect()->back();
    }
    public function addExistingVehicle(Request $request, $id)
    {
        $user = AllUser::find($id);
        
        $request->validate([
                'vehicle_number' => ['required', 'string', 'max:255'],
                'vehicle_type' => 'required',
                'price' => 'required',
        ]);
         
        $new_vehicle = new vehicle_details();
        $new_vehicle->all_user_id = $user->id;
        $new_vehicle->user_id = $user->user_id;
        $new_vehicle->vehicle_registration = $request->vehicle_number;
        $new_vehicle->vehicle_type = $request->vehicle_type;
        $new_vehicle->price = $request->price;
        $new_vehicle->save();
         
        Toastr::success('Vehicle '.$request->vehicle_number.' updated on database.','Success');
        return redirect()->back();
    }
    
    public function deleteVehicle($id)
    {
        $vehicle = vehicle_details::find($id);
        $user = AllUser::find($vehicle->all_user_id);
        if($user->monthly_bill == $vehicle->price){
        
        Toastr::error('Mr. '.$user->name.' has this only vehicle. Try expiring the user instead.','Error');
        return redirect()->back();
        
        }else{
            $vehicle->status = 0;
            $vehicle->update();
        
            $user->monthly_bill = $user->monthly_bill - $vehicle->price;
            $user->update();
            
            $due_update = payment_history::where('user_id',$vehicle->all_user_id)->latest()->first();
            $due_update->total_due = $due_update->total_due - $vehicle->price;
            $due_update->update();
        }
        Toastr::success('Vehicle '.$vehicle->vehicle_registration.' removed successfully.','Success');
        return redirect()->back();
    }
    public function activateVehicle($id)
    {
        $vehicle = vehicle_details::find($id);
        $vehicle->status = 1;
        $vehicle->update();
        
        $user = AllUser::find($vehicle->all_user_id);
        $user->monthly_bill = $user->monthly_bill + $vehicle->price;
        $user->payment_status = 0;
        $user->update();
        
        $due_update = payment_history::where('user_id',$vehicle->all_user_id)->latest()->first();
        $due_update->total_due = $due_update->total_due + $vehicle->price;
        $due_update->payment_status = 0;
        $due_update->update();
        
        Toastr::success('Vehicle '.$vehicle->vehicle_registration.' activated successfully.','Success');
        return redirect()->back();
    }
    public function make_due($id)
    {
        $due_users = AllUser::find($id);
        $due_users->payment_status = 0;
        $due_users->update();
        
        Toastr::success(''.$due_users->name.' set to Due.','Success');
        return redirect()->back();
    }
    public function make_paid($id)
    {
        $paid_users = AllUser::find($id);
        $paid_users->payment_status = 1;
        $paid_users->update();
        
        Toastr::success(''.$paid_users->name.' set to Paid.','Success');
        return redirect()->back();
    }
    public function update_device_price(Request $request, $id)
    {
        $device_price = AllUser::find($id);
        $device_price->device_price = $request->device_price;
        $device_price->update();
        
        Toastr::success('Device price for '.$device_price->name.' updated successfully! ','Success');
        return redirect()->back();
    }
    public function vipUser(Request $request, $id)
    {
        $vip = AllUser::find($id);
        $vip->customer_level = $request->star;
        $vip->update();
        
        Toastr::success('VIP level updated successfully! ','Success');
        return redirect()->back();
    }
    public function registeredUsers()
    {
        $users = User::orderBy('id','desc')->get();
        
        return view('backend.all_user.all_registered_users',compact('users'));
    }
    public function deleteUser($id)
    {
        $rsgst = User::find($id);
        $user = AllUser::where('user_id', $id)->first();
        $rsgst->delete();
        $user->delete();

        
        Toastr::success(' User Deleted successfully! ','Success');
        return redirect()->back();
    }

}
