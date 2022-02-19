<?php

namespace App\Http\Controllers\Admin;

use App\AllUser;
use App\website_message;;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WebmessageController extends Controller
{
    public function index()
    {
        $web_message = website_message::where('status', 1)->get();
        return view('backend.website_message',compact('web_message'));
    }

}
