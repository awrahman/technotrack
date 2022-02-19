<?php

namespace App\Http\Controllers;

use App\AllUser;
use App\Assign_technician_device;
use App\Contact_info;
use App\Feature;
use App\HappyClient;
use App\HomePageModel;
use App\payment_confarmation_history;
use App\payment_history;
use App\Price_categaroy;
use App\TrackingDevice;
use App\offers;
use App\User;
use App\Faq;
use App\Demo;
use App\Testimonials;
use App\Coverages;
use App\vehicle_details;
use App\website_message;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;

class HomeController2 extends Controller
{

    public function index()
    {
        $price = Price_categaroy::orderBy('id', 'desc')->get();
        $offers = offers::where('flag', 1)->take(3)->orderBy('id', 'desc')->get();
        $feature = Feature::take(12)->inRandomOrder()->get();
        $happy_client = HappyClient::where('status', 1)->take(6)->inRandomOrder()->get();
        $testimonials = Testimonials::where('status', 1)->take(5)->inRandomOrder()->get();
        $coverages = Coverages::where('status', 1)->take(8)->inRandomOrder()->get();
        $cars = vehicle_details::where('vehicle_type', 1)->get();
        $truck = vehicle_details::where('vehicle_type', 2)->get();
        $motorcycle = vehicle_details::where('vehicle_type', 3)->get();
        $cng = vehicle_details::where('vehicle_type', 4)->get();
        $excavator = vehicle_details::where('vehicle_type', 5)->get();
        $users = AllUser::all();
        return view('home',compact('price','feature','happy_client', 'offers', 'testimonials', 'coverages', 'cars', 'truck', 'motorcycle','cng', 'excavator', 'users'));
    }
    public function contact()
    {
        $contact = Contact_info::all();
        return view('frontend.contact',compact('contact'));
    }
    public function new()
    {
        return view('main');
    }
    public function demo()
    {
        return view('frontend.demo');
    }
    public function demo_add(Request $request)
    {
        $validator =   $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255',],
            'phone' => ['required',],
         ]);
        
        $demo = new Demo();
        $demo->name = $request->name;
        $demo->email = $request->email;
        $demo->phone = $request->phone;
        $demo->social_media = $request->social;
        $demo->link = $request->link;
        $demo->save();
        
        if(isset($request->link)){
            Toastr::success('Demo account added successfully!','Successfull');
            return redirect()->back();
        }else{
            Toastr::success('Your request for demo account has received. Our custmer support will contact you soon.','Successfull');
            return redirect()->back();
        }
        
    }
    
    public function testimonial()
    {
        return view('frontend.blank');
    }
    
    public function user_registration()
    {
        return view('frontend.registration');
    }

    public function user_registration_store(Request $request)
    {
              $validator =   $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255',],
                'password' => ['required', 'string', 'min:4', 'confirmed'],
                'phone' => ['required','unique:users'],
                'car_model' => 'required',
                'par_add' => 'required',
         ]);

        $for_user_table = new User();
        $for_user_table->name = $request->name;
        $for_user_table->email = $request->email;
        $for_user_table->phone = $request->phone;
        $for_user_table->password = Hash::make($request->password);
        $for_user_table->role = 2;
        $for_user_table->type = 'user';
        $for_user_table->save();


        $user = new AllUser();
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->user_id = $for_user_table->id;
        $user->alter_phone = $request->alter_phone;
        $user->email = $request->email;
        $user->par_add = $request->par_add;
        $user->user_type = 1;
        $user->order_status = 1;

        $user->car_number = $request->car_number;
        $user->car_model = $request->car_model;
        $user->installation_date = $request->installation_date;
        $user->due_date = $request->due_date;
        $user->monthly_bill = $request->monthly_bill;
        $user->total_due = $request->total_due;
        $user->next_payment_date = '-';
        $user->total_paied = $request->total_paied;
        $user->save();

        Toastr::success('You have Successfully registered ','Registration Successfull');
        return redirect()->route('user_login')->with('message','You have Successfully registered');

    }


    public function user_login()
    {
        return view('frontend.user_login');
    }
    public function appLogin()
    {
        return view('frontend.app_login');
    }

    public function passwordReset(Request $request)
    {
        $request->validate([
                'resetPassword' => ['required', 'string'],
                'repeatResetPassword' => ['required', 'string'],
         ]);
        if($request->resetPassword == $request->repeatResetPassword){
            
            if(Auth::user()->role==2){
                $user = User::findOrFail(Auth::user()->id);
                $user->password = Hash::make($request->resetPassword);
                $user->update();
                
                $all_user = AllUser::where('user_id',$user->id)->firstOrFail();
                $all_user->password = $request->resetPassword;
                $all_user->update();
                
                $user->login_status = 1;
                $user->update();

                
                Toastr::success('Password reset Successfully!)','Success');
                return redirect()->to('https://www.technotrack.com.bd/user/user_dashboard');
                
            }else{
                $user = User::find(Auth::user()->id);
                $user->password = Hash::make($request->resetPassword);
                $user->update();
                
                $user->login_status = 1;
                $user->update();
                
                Toastr::success('Password reset Successfully!)','Success');
                return redirect()->to('https://www.technotrack.com.bd/admin/adminDashboard');
            }
            
        }else{
            Toastr::error('Password did not match! :)','Password Error!');
            return redirect()->back();
        }
    }

    public function update_user_info(Request $request,$id){

           $main_user_table = User::find($id);

           if ($request->phone == $main_user_table->phone){

               $main_user_table->phone = $request->phone;
               $main_user_table->name = $request->name;
               $main_user_table->email = $request->email;
               $main_user_table->update();


               $old_user_table = AllUser::where('user_id',$id)->first();
               $old_user_table->phone = $request->phone;
               $old_user_table->name = $request->name;
               $old_user_table->email = $request->email;
               $old_user_table->par_add = $request->par_add;
               $old_user_table->update();

               Toastr::success('Account Information updated Successfully','Success');
               return redirect()->back()->with('message','Account Information updated Successfully');
           }


           $validator =   $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'phone' => ['required','unique:users'],
            ]);


           $main_user_table->phone = $request->phone;
           $main_user_table->name = $request->name;
           $main_user_table->email = $request->email;
           $main_user_table->update();


           $old_user_table = AllUser::where('user_id',$id)->first();
           $old_user_table->phone = $request->phone;
           $old_user_table->name = $request->name;
           $old_user_table->email = $request->email;
           $old_user_table->par_add = $request->par_add;
           $old_user_table->update();

           Toastr::success('Account Information updated Successfully','Success');
           return redirect()->back()->with('message','Account Information updated Successfully');

    }

    public function contact_us(Request $request)
    {
      $validator =   $request->validate([
                'name' => ['required', 'string', 'max:50'],
                'email' => ['required', 'string', 'email', 'max:50',],
                'phone' => ['required', 'string', 'min:11',],
                'message' => 'required',
         ]);

      $website_message = new website_message();
      $website_message->name = $request->name;
      $website_message->email = $request->email;
      $website_message->phone = $request->phone;
      $website_message->message = $request->message;
      $website_message->save();


      Toastr::success('Message has been sent Successfully. We will contact you ASAP.','Success');
      return redirect()->back()->with('message','Message has been sent Successfully. We will contact you ASAP.');
    }

    public function price_list()
    {
        $price = Price_categaroy::all();
        return view('frontend.price_list',compact('price'));
    }

    public function post_complain(Request $request){

    }


    public function feature()
    {
        $feature = Feature::latest()->get();
        $faq = Faq::take(6)->inRandomOrder()->get();
        return view('frontend.feature',compact('feature','faq'));
    }

    public function our_devices()
    {
        $device = TrackingDevice::latest()->get();
        $feature = Feature::latest()->get();
        return view('frontend.devices',compact('device','feature'));
    }

    public function map()
    {
        return view('frontend.map');
    }

    public function Pay_bill()
    {
        return view('frontend.pay_bill');
    }

    public function phone_number_search(Request $request)
    {
            $query = $request->get('query');
             if($query !== '')
             {
              $phone = $request->get('query');
              $data1 = User::where('phone', $phone)->get();
              $data_count = User::where('phone', $phone)->count();

              if($data_count > 0)
              {
                    $data2 = AllUser::where('user_id', $data1->first()->id)->get()->first();

                    $previous_due_history = payment_history::where('user_id',$data2->id)->where('payment_status',0)->get();
                    $number_of_due_month = $previous_due_history->count();
                    $expire_date = $data2->next_payment_date;
                    $v_number = $data2->car_number;

                    $data = array(
                       'user'  => $data2,
                       'due_month'  => $number_of_due_month,
                       'expire_date' => $expire_date,
                       'car' => $v_number
                      );

                    return Response($data);
              }
              else
              {
                    $data = 'null';
                    return Response($data);
              }
             }else{
                 $data = 'null';
                    return Response($data);
             }

    }

    public function online_payment($id)
    {
        $user = User::find($id);
        $all_user = AllUser::where('user_id',$id)->firstOrFail();

        //$payment = payment_history::where('user_id',$all_user->id)->orderBy('id','desc')->get();
        //return view('frontend.payment_online',compact('all_user','payment'));
        
        Toastr::success('Message has been sent Successfully. '.$all_user->name.' We will contact you ASAP.','Success');
        return view('frontend.payment_online',compact('all_user','payment'));
    }





}
