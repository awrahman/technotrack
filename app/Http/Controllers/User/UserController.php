<?php

namespace App\Http\Controllers\User;

use App\AllUser;
use App\Assign_technician_device;
use App\Complain;
use App\order;
use App\Payment;
use App\User;
use App\user_logins;
use App\payment_history;
use App\Price_categaroy;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function user_dashboard()
{
        $user = User::find(Auth::user()->id);
        $sessionid = Session::getId();
            
        if($user->login_status==0){
        $user->login_status = 1;
        $user->login_session = $sessionid;
        $user->update();
        
        $newlogin = new user_logins();
        $newlogin->user_id = Auth::user()->id;
        $newlogin->user_ip = request()->ip();
        $newlogin->login_session = $sessionid;
        $newlogin->save();
        
        return redirect()->to('https://www.technotrack.com.bd/user/first_time_login');
        
        }else{
        
            if($user->login_session !== $sessionid){
            
                $newlogin = new user_logins();
                $newlogin->user_id = Auth::user()->id;
                $newlogin->user_ip = request()->ip();
                $newlogin->login_session = $sessionid;
                $newlogin->save();
            
                $user->login_session = $sessionid;
                $user->update();
            }
        }
            
            $package_order = order::where('user_id',Auth::id())->latest()->get();
            $user_id = Auth::id();
            $user_info = AllUser::where('user_id',$user_id)->first();
            $payment = payment_history::where('user_id',$user_info->id)->orderBy('id','desc')->get();
            $orders = Assign_technician_device::where('user_id',$user_info->id)->orderBy('id','desc')->get();
            return view('frontend.user_dashboard',compact('user_info','payment','orders','package_order'));
    }

    public function first_time_login()
    {
        return view('frontend.first_time_login');
    }
    public function changePassword(Request $request){

        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            Toastr::error('Your current password does not matches with the password you provided. Please try again.');
            return redirect()->back();
        }

        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            //Current password and new password are same
            Toastr::error('New Password cannot be same as your current password. Please choose a different password.');
            return redirect()->back();
        }

        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:6|confirmed',
        ]);

        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();

        Toastr::success('Password changed successfully !','success');
        return redirect()->back()->with("success","Password changed successfully !");

    }

    public function payment($id)
    {
        $package = Price_categaroy::find($id);
        $user = Auth::user();
        return view('frontend.payment',compact('user','package'));
    }


    public function post_complain(Request $request,$id)
    {
        $complain = new Complain();
        $complain->user_id = $id;
        $complain->description = $request->Complain_description;
        $complain->save();

        Toastr::success('Your Complain Placed Successfully','success');
        return redirect()->back();
    }


    public function cash_on_delevery(Request $request)
    {
        $package = Price_categaroy::find($request->package_id);

            $all_user = AllUser::where('user_id',$request->user_id)->first();
            $all_user->order_status = 1;
            $all_user->update();


            $payments = new Payment();
            $payments->name = $all_user->name;
            $payments->user_id = $all_user->user_id;
            $payments->email = $all_user->email;
            $payments->phone = $all_user->phone;
            $payments->amount = $package->monthly_charge + $package->device_price;
            $payments->status = 'Processing';
            $payments->address = $all_user->par_add;
            $payments->transaction_id = uniqid();
            $payments->currency = 'BDT';
            $payments->save();



            $order = new order();
            $order->user_id = $all_user->user_id;
            $order->order_status = 0;
            $order->payment_status = 'cash_on_delivery';
            $order->package_id = $request->package_id;
            $order->transaction_id  =$payments->id;
            $order->save();


//

            Toastr::success('New Order Placed Successfully','Success');
            return redirect()->route('user.user_dashboard');
    }





}
