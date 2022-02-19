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
use App\offers;
use App\User;
use App\Testimonials;
use App\service;
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

class HomePageController extends Controller
{

    public function index()
    {
        $price = Price_categaroy::orderBy('id', 'asc')->get();
        $offers = offers::where('flag', 1)->take(3)->orderBy('id', 'desc')->get();
        $feature = Feature::take(12)->inRandomOrder()->get();
        $service = service::take(4)->inRandomOrder()->get();
        $happy_client = HappyClient::where('status', 1)->take(6)->inRandomOrder()->get();
        $testimonials = Testimonials::where('status', 1)->take(5)->inRandomOrder()->get();
        $coverages = Coverages::where('status', 1)->take(8)->inRandomOrder()->get();
        $cars = vehicle_details::where('vehicle_type', 1)->get();
        $truck = vehicle_details::where('vehicle_type', 2)->get();
        $motorcycle = vehicle_details::where('vehicle_type', 3)->get();
        $cng = vehicle_details::where('vehicle_type', 4)->get();
        $excavator = vehicle_details::where('vehicle_type', 5)->get();
        $users = AllUser::all();
        return view('main',compact('service','price','feature','happy_client', 'offers', 'testimonials', 'coverages', 'cars', 'truck', 'motorcycle','cng', 'excavator', 'users'));
    }
}
