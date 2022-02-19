<?php

namespace App\Http\Controllers\Admin;
use App\Contact_info;
use App\AllUser;
use App\Notifications\EmailNotifier;
use App\payment_history;
use Carbon\Carbon;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class SmsController extends Controller
{
    public function send_personal_sms($id)
    {
        $user = AllUser::find($id);
        $sms = Input::get('sms');


        $curl = curl_init();
        curl_setopt_array($curl, array( CURLOPT_RETURNTRANSFER => 1, CURLOPT_URL => 'http://api.greenweb.com.bd/api.php?token=26a7280482e3d86e5ceb1ae5ffacd67d&to='.$user->phone.'&message='. rawurlencode($sms).'', CURLOPT_USERAGENT => 'Sample cURL Request' ));
        $resp = curl_exec($curl);
        curl_close($curl);

          Toastr::success($resp,'Success');
          return redirect()->back();

    }

    public function sms_to_all()
    {
        $allSMS = Input::get('allSMS');
        $user = AllUser::where('expair_status',0)->get();
        $phone = '';
        
        foreach ($user as $key=>$data){
            
            $phone .= $data->phone . ','; 
            
        }
        $phone = trim($phone, ',');
        
        $curl = curl_init();
        curl_setopt_array($curl, array( CURLOPT_RETURNTRANSFER => 1, CURLOPT_URL => 'http://api.greenweb.com.bd/api.php?token=7e97ac417cf9476620499f271d56a2ad&to='.$phone.'&message='.rawurlencode($allSMS).'', CURLOPT_USERAGENT => 'Sample cURL Request' ));
        $resp = curl_exec($curl);
        curl_close($curl);
        
        Toastr::success('SMS sent successfully to all users.' ,'Success');
        return redirect()->back();
    }
    

    public function send_sms_to_due_user()
    {
        $contact = Contact_info::all()->first();
        $user = AllUser::where('payment_status',0)->where('order_status',0)->where('expair_status',0)->where('service_problem_status',0)->where('duesms',0)->take(50)->get();
        $month = Carbon::now()->format('m');
        $jsonsmsdata = '';
        if (count($user) > 0){
        foreach ($user as $key=>$data){

            $number_of_due_months = payment_history::where('user_id',$data->id)->where('payment_status',0)->get()->count();
            
            
            $message = rawurlencode('Dear '.$data->name.'
            Your monthly bill '.$number_of_due_months * $data->monthly_bill.' taka is due. Please pay the bill before your connection get expired. bKash - '.$contact->bKash.', Rocket- '.$contact->Rocket.', Nagad- '.$contact->Nagad.'.  Please call us at '.$contact->header_phone_3.' for support or email support@technotrack.com.bd. Use ref. Id: '.$month.''.$data->id.'TechnoTrack
            Techno Track BD');
            
            $genjsons = '{"to":"'.$data->phone.'","message":"'.$message.'"}';
	        $jsonsmsdata = "$genjsons,$jsonsmsdata";
	        
	        $data->duesms = $data->duesms+1;
            $data->update();
        }
            $jsonsmsdata = rtrim($jsonsmsdata, ',');
            $smsdata = '['.$jsonsmsdata.']';
            
            $token = "b2117eaa298df4b328d04f6633c15a4c";
            $smsdata = $smsdata;

            $url = "http://api.greenweb.com.bd/api2.php";


            $data= array(
                'smsdata'=>"$smsdata",
                'token'=>"$token"
            ); // Add parameters in key value
            
            $ch = curl_init(); // Initialize cURL
            curl_setopt($ch, CURLOPT_URL,$url);
            curl_setopt($ch, CURLOPT_ENCODING, '');
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $success = curl_exec($ch);
            $error = curl_error($ch);
            
            Toastr::success('SMS sent to '.count($user).' users successfully! ','Success');
        }else{
            Toastr::error('SMS already sent to all users!','Error');
        }
        return redirect()->back();
    }



    public function sms_first_reminder()
    {
        $contact = Contact_info::all()->first();
        $user = AllUser::where('payment_status',0)->where('order_status',0)->where('expair_status',0)->where('duesms',1)->where('service_problem_status',0)->take(50)->get();
        $month = Carbon::now()->format('m');
        $monthName = Carbon::now()->format('F');
        
        
        $jsonsmsdata = '';
        if (count($user) > 0){
        foreach ($user as $key=>$data){

            $number_of_due_months = payment_history::where('user_id',$data->id)->where('payment_status',0)->get()->count();
            
            $message = rawurlencode('Dear '.$data->name.'
            Your monthly bill '.$number_of_due_months * $data->monthly_bill.' taka is due. Please pay the bill by '.$monthName.' 12, 2020 to avoid disconnection! bKash - '.$contact->bKash.', Rocket- '.$contact->Rocket.', Nagad- '.$contact->Nagad.'.  Please call us at '.$contact->header_phone_3.' for support or email support@technotrack.com.bd. Use ref. Id: '.$month.''.$data->id.'TechnoTrack
            Techno Track BD');
            
            $genjsons = '{"to":"'.$data->phone.'","message":"'.$message.'"}';
	        $jsonsmsdata = "$genjsons,$jsonsmsdata";
	        
	        $data->duesms = $data->duesms+1;
            $data->update();
        }
            $jsonsmsdata = rtrim($jsonsmsdata, ',');
            $smsdata = '['.$jsonsmsdata.']';
            
            $token = "b2117eaa298df4b328d04f6633c15a4c";
            $smsdata = $smsdata;

            $url = "http://api.greenweb.com.bd/api2.php";


            $data= array(
                'smsdata'=>"$smsdata",
                'token'=>"$token"
            ); // Add parameters in key value
            
            $ch = curl_init(); // Initialize cURL
            curl_setopt($ch, CURLOPT_URL,$url);
            curl_setopt($ch, CURLOPT_ENCODING, '');
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $success = curl_exec($ch);
            $error = curl_error($ch);
            
            Toastr::success('SMS sent successfully!','Success');
        }else{
            Toastr::error('SMS already sent to all users!','Error');
        }
        return redirect()->back();
        
    }


public function over_due_sms()
    {
        $contact = Contact_info::all()->first();
        $user = AllUser::where('payment_status',0)->where('order_status',0)->where('expair_status',0)->where('duesms',2)->where('service_problem_status',0)->take(50)->get();
        $month = Carbon::now()->format('m');
        $monthName = Carbon::now()->format('F');
        
        
        $jsonsmsdata = '';
        if (count($user) > 0){
        foreach ($user as $key=>$data){

            $number_of_due_months = payment_history::where('user_id',$data->id)->where('payment_status',0)->get()->count();
            
            $message = rawurlencode('Dear '.$data->name.'
            Your monthly bill '.$number_of_due_months * $data->monthly_bill.' taka is due. Please pay the bill by '.$monthName.' 19, 2020 to avoid disconnection! bKash - '.$contact->bKash.', Rocket- '.$contact->Rocket.', Nagad- '.$contact->Nagad.'.  Please call us at '.$contact->header_phone_3.' for support or email support@technotrack.com.bd. Use ref. Id: '.$month.''.$data->id.'TechnoTrack
            Techno Track BD');
            
            $genjsons = '{"to":"'.$data->phone.'","message":"'.$message.'"}';
	        $jsonsmsdata = "$genjsons,$jsonsmsdata";
	        
	        $data->duesms = $data->duesms+1;
            $data->update();
        }
            $jsonsmsdata = rtrim($jsonsmsdata, ',');
            $smsdata = '['.$jsonsmsdata.']';
            
            $token = "b2117eaa298df4b328d04f6633c15a4c";
            $smsdata = $smsdata;

            $url = "http://api.greenweb.com.bd/api2.php";


            $data= array(
                'smsdata'=>"$smsdata",
                'token'=>"$token"
            ); // Add parameters in key value
            
            $ch = curl_init(); // Initialize cURL
            curl_setopt($ch, CURLOPT_URL,$url);
            curl_setopt($ch, CURLOPT_ENCODING, '');
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $success = curl_exec($ch);
            $error = curl_error($ch);
            
            Toastr::success('SMS sent successfully!','Success');
        }else{
            Toastr::error('SMS already sent to all users!','Error');
        }
        return redirect()->back();
        
    }


//public function over_due_sms()
//{
//            $user = AllUser::where('payment_status',0)->where('order_status',0)->where('expair_status',0)->get();
//
//        foreach ($user as $key=>$data){
//
//            if (payment_history::where('user_id',$data->id)->where('payment_status',0)->get()->count() > 2){
//                $curl = curl_init();
//            curl_setopt_array($curl, array( CURLOPT_RETURNTRANSFER => 1, CURLOPT_URL => 'http://api.greenweb.com.bd/api.php?token=26a7280482e3d86e5ceb1ae5ffacd67d&to='.$data->phone.'&message='.rawurlencode('Your Techno Track monthly bill is overdue. Total due: ( '.$data->monthly_bill * payment_history::where('user_id',$data->id)->where('payment_status',0)->get()->count() .' ) for ('.payment_history::where('user_id',$data->id)->where('payment_status',0)->get()->count().')Please pay your bill before your connection get expired. bKash - 01712212518 or 01950145080, Nagad- 01712212518, Rocket - 01779853003. Please call us at 01841119238 for support or email support@technotrack.com.bd. Use ref. Id- '.$data->id.'TechnoTrack
//Techno Track BD').''.$key, CURLOPT_USERAGENT => 'Sample cURL Request' ));
//            $resp = curl_exec($curl);
//            curl_close($curl);
//            }
//
//
//
//        }
//
//
//        Toastr::success('Sms Sent Successfully','Success');
//        return redirect()->back();
//}



public function single_sms($id)
{
    $contact = Contact_info::all()->first();
    $user = AllUser::find($id);
    $number_of_due_months = payment_history::where('user_id',$user->id)->where('payment_status',0)->get()->count();
    $curl = curl_init();
    curl_setopt_array($curl, array( CURLOPT_RETURNTRANSFER => 1, CURLOPT_URL => 'http://api.greenweb.com.bd/api.php?token=26a7280482e3d86e5ceb1ae5ffacd67d&to='.$user->phone.'&message='.rawurlencode('Your monthly bill '.$number_of_due_months * $user->monthly_bill.' tk was due. Please pay the bill before your connection get expired. bKash - '.$contact->bKash.', Rocket- '.$contact->Rocket.', Nagad- '.$contact->Nagad.'.  Please call us at '.$contact->header_phone_3.' for support or email support@technotrack.com.bd. Use ref. Id- '.$user->id.'TechnoTrack
    Techno Track BD ').'&csmsid=123456789', CURLOPT_USERAGENT => 'Sample cURL Request' ));
    $resp = curl_exec($curl);
    curl_close($curl);

    Toastr::success('SMS Sent Successfully','Success');
    return redirect()->back();
}



}
