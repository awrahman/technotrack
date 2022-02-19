<?php

namespace App\Http\Controllers\Admin;


use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mail;

class WebmessageController extends Controller
{
    public function sendReply(Request $request, $id)
    {
        $request->validate([
                'reply' => ['required', 'string'],
         ]);

        $email = website_message::findOrfail($id);
        $message = $request->reply;
        $subject = 'Re: Reply from TechnoTrack';

        $retval = mail ($email->email,$subject,$message);
        if( $retval == true ) {
            Toastr::success('Reply to '.$email->name.' sent Successfully!','Success');
            return redirect()->back();
         }else {
            Toastr::success('Could not send email. '.error_reporting().'','Success');
            return redirect()->back();
         }

        
    }
}
