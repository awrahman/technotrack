<?php

namespace App\Http\Controllers\Admin;

use App\AllUser;
use App\Billing_shedule;
use App\Contact_info;
use App\Demo;
use App\HappyClient;
use App\HomePageModel;
use App\order;
use App\payment_history;
use App\payment_confarmation_history;
use App\service;
use App\Team;
use App\technician_device_stock;
use App\Transaction_history;
use App\User;
use App\Testimonials;
use App\Coverages;
use App\website_message;
use App\partner_showcase;
use App\user_logins;
use App\offers;
use App\Notices;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;


class AdminDashboardController extends Controller
{
    public function index(){
        
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
        
        return redirect()->to('https://www.technotrack.com.bd/admin/first_time_login');
        
        }else{
        
        if($user->login_session !== $sessionid){
            
            if($user->id !== 1){
                $newlogin = new user_logins();
                $newlogin->user_id = Auth::user()->id;
                $newlogin->user_ip = request()->ip();
                $newlogin->login_session = $sessionid;
                $newlogin->save();

                $user->login_session = $sessionid;
                $user->update();
            }
        }
        
        $order = order::where('order_status',1)->get();
        $registered_user = AllUser::where('order_status',0)->where('demo',0)->get();
        $total_collected_amount = payment_confarmation_history::whereNotIn('user_id',[1,1])->sum('updated_amount');
        $total_device_sale = technician_device_stock::sum('quantity');
        $today_collected_bill = payment_confarmation_history::whereNotIn('user_id',[1,1])->whereDate('updated_at', Carbon::today())->sum('updated_amount');
        $total_due_user = AllUser::where('payment_status',0)->where('expair_status',0)->where('demo',0)->get()->count();
        $total_device_sale_tk = AllUser::sum('device_price');
        $total_expair_user = AllUser::where('expair_status',1)->get()->count();
        $total_this_month = payment_confarmation_history::whereNotIn('user_id',[1,1])->whereMonth('updated_at', Carbon::now()->format('m'))->whereYear('updated_at', Carbon::now()->format('Y'))->sum('updated_amount');
        //payment_history::whereNotIn('user_id',[1,1])->whereMonth('updated_at', Carbon::now()->format('m'))->sum('payment_this_date');
        $total_monthly_bill = AllUser::where('expair_status',0)->where('demo',0)->sum('monthly_bill');
        $notice = Notices::where('status',0)->where('completed',0)->get();

        $day_by_day_payment_history = payment_history::whereNotIn('user_id',[1,1])->whereDate('created_at', '>', Carbon::now()->subDays(30))->get()
                            ->groupBy(function ($grouped) {
                                return $grouped->created_at->format('d');
                            });

        $day_by_day_sales_history = technician_device_stock::whereDate('created_at', '>', Carbon::now()->subDays(30))->get()
                            ->groupBy(function ($grouped) {
                                return $grouped->created_at->format('d');
                            });

        $schedule = Billing_shedule::whereDate('date', Carbon::today())->get();

        return view('backend.dashboard',compact('order','notice', 'sessionid','total_monthly_bill','total_this_month','registered_user','total_collected_amount','day_by_day_payment_history','day_by_day_payment_history','day_by_day_sales_history','total_device_sale','schedule','today_collected_bill','total_due_user','total_expair_user','total_device_sale_tk'));
        }
    }
    
    public function first_time_login()
    {
        return view('frontend.first_time_login');
    }
    public function Password_change_page()
    {
        return view('backend.password_change');
    }

    public function blank()
    {
        return view('backend.blank');
    }

    public function home_page_banner()
    {
        $home = HomePageModel::latest()->get();
        return view('backend.add_home_page_banner',compact('home'));
    }

    public function home_page_banner_save(Request $request)
    {
        $image = $request->file('cover_image');
        if(isset($image))
        {
//            make unipue name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName  = $currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            if(!Storage::disk('public')->exists('home_cover'))
            {
                Storage::disk('public')->makeDirectory('home_cover');
            }

            $moveImage = Image::make($image)->stream();;
            Storage::disk('public')->put('home_cover/'.$imageName,$moveImage);
            
            //Compress Image Code Here
            $filepath = public_path('storage/home_cover/'.$imageName);
 
            try {
                \Tinify\setKey("gblDjBX4WTNf8hYdLdqLgj96B8Nb2yQf"); // Alternatively, you can store your key in .env file.
                $source = \Tinify\fromFile($filepath);
                $source->toFile($filepath);
            } catch(\Tinify\AccountException $e) {
            // Verify your API key and account limit.
                return redirect()->back()->with('error', $e->getMessage());
            } catch(\Tinify\ClientException $e) {
            // Check your source image and request options.
                return redirect()->back()->with('error', $e->getMessage());
            } catch(\Tinify\ServerException $e) {
            // Temporary issue with the Tinify API.
                return redirect()->back()->with('error', $e->getMessage());
            } catch(\Tinify\ConnectionException $e) {
            // A network connection error occurred.
                return redirect()->back()->with('error', $e->getMessage());
            } catch(Exception $e) {
            // Something else went wrong, unrelated to the Tinify API.
                return redirect()->back()->with('error', $e->getMessage());
            }

        } else {
            $imageName = "default.png";
        }


        $home_page = new HomePageModel();
        $home_page->cover_image = $imageName;
        $home_page->animated_text = $request->animated_text;
        $home_page->small_text = $request->cover_small_text;
        $home_page->save();

        Toastr::success('save Successfully :)','Success');
        return redirect()->back();


    }

    public function home_page_banner_delete($id)
    {
        $home = HomePageModel::findOrfail($id);
         if (Storage::disk('public')->exists('home_cover/'.$home->cover_image))
        {
            Storage::disk('public')->delete('home_cover/'.$home->cover_image);
        }
        $home->delete();

        Toastr::success('Post Successfully Deleted :)','Success');
        return redirect()->back();
    }

    public function partners()
    {
        $partners = partner_showcase::orderBy('partner_type','asc')->get();

        return view('backend.partners', compact('partners'));
    }
    public function partnerSave(Request $request)
    {
        $request->validate([
                'name' => ['required', 'string'],
                'type' => ['required', 'string'],
         ]);
        $image = $request->file('partner_image');
        if(isset($image))
        {
//            make unipue name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName  = $currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            if(!Storage::disk('public')->exists('partner_image'))
            {
                Storage::disk('public')->makeDirectory('partner_image');
            }

            $moveImage = Image::make($image)->resize(428,186)->stream();
            Storage::disk('public')->put('partner_image/'.$imageName,$moveImage);

        } else {
            $imageName = "default.png";
        }


        $partner_image = new partner_showcase();
        $partner_image->name = $request->name;
        $partner_image->image = $imageName;
        $partner_image->partner_type = $request->type;
        $partner_image->save();

        Toastr::success('Partner '.$request->name.' saved Successfully :)','Success');
        return redirect()->back();
    }
    public function partnerDeactivate($id)
    {
        $partner = partner_showcase::findOrfail($id);
        $partner->status = 0;
        $partner->update();

        Toastr::success('Partner '.$partner->name.' deactivated Successfully!','Success');
        return redirect()->back();
    }
    public function partnerActivate($id)
    {
        $partner = partner_showcase::findOrfail($id);
        $partner->status = 1;
        $partner->update();

        Toastr::success('Partner '.$partner->name.' activated Successfully!','Success');
        return redirect()->back();
    }
    public function offers()
    {
        $offers = offers::orderBy('id','desc')->get();

        return view('backend.offers', compact('offers'));
    }
    public function addOffer(Request $request)
    {
        $request->validate([
                'title' => ['required', 'string'],
                'content' => ['required', 'string'],
                'icon' => ['required', 'string'],
         ]);

        $offers_add = new offers();
        $offers_add->title = $request->title;
        $offers_add->content = $request->content;
        $offers_add->image = $request->icon;
        $offers_add->save();

        Toastr::success('Offer '.$request->title.' saved Successfully :)','Success');
        return redirect()->back();
    }
    public function offerDeactivate($id)
    {
        $offer = offers::findOrfail($id);
        $offer->flag = 0;
        $offer->update();

        Toastr::success('Offer '.$offer->title.' deactivated Successfully!','Success');
        return redirect()->back();
    }
    public function offerActivate($id)
    {
        $offer = offers::findOrfail($id);
        $offer->flag = 1;
        $offer->update();

        Toastr::success('Offer '.$offer->title.' activated Successfully!','Success');
        return redirect()->back();
    }
    public function offerEdit($id)
    {
        $offer = offers::findOrfail($id);

        return view('backend.edit_offer', compact('offer'));
    }
    public function offerUpdate(Request $request, $id)
    {
        $request->validate([
                'title' => ['required', 'string'],
                'content' => ['required', 'string'],
                'icon' => ['required', 'string'],
         ]);

        $offer_update = offers::findOrfail($id);
        $offer_update->title = $request->title;
        $offer_update->content = $request->content;
        $offer_update->image = $request->icon;
        $offer_update->update();

        $offers = offers::orderBy('id','desc')->get();

        Toastr::success('Offer updated Successfully to '.$request->title.'!','Success');
        return view('backend.offers', compact('offers'));
    }
    public function testimonial()
    {
        $testimonials = Testimonials::all();
        return view('backend.testimonial', compact('testimonials'));
    }
    public function addTestimonial(Request $request)
    {
        $request->validate([
                'name' => ['required', 'string'],
                'feedback' => ['required', 'string'],
         ]);
         
        $image = $request->file('client_image');
        
        if(isset($image))
        {
//            make unipue name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName  = $currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            if(!Storage::disk('public')->exists('testimonials'))
            {
                Storage::disk('public')->makeDirectory('testimonials');
            }

            $moveImage = Image::make($image)->resize(215,215)->stream();
            Storage::disk('public')->put('testimonials/'.$imageName,$moveImage);

        } else {
            $imageName = "default.png";
        }

        $testimonial = new Testimonials();
        $testimonial->client_name = $request->name;
        $testimonial->client_image = $imageName;
        $testimonial->client_fedback = $request->feedback;
        $testimonial->save();
        
        
        Toastr::success('Testimonial added Successfully!','Success');
        return redirect()->back();
    }
    public function testimonialDeactivate($id)
    {
        $testimonial = Testimonials::find($id);
        $testimonial->status = 0;
        $testimonial->update();
        
        Toastr::success('Testimonial Deactivated Successfully!','Success');
        return redirect()->back();
    }
    public function testimonialActivate($id)
    {
        $testimonial = Testimonials::find($id);
        $testimonial->status = 1;
        $testimonial->update();
        
        Toastr::success('Testimonial Activated Successfully!','Success');
        return redirect()->back();
    }
    public function testimonialDelete($id)
    {
        $testimonial = Testimonials::find($id);
        $testimonial->delete();
        
        Toastr::success('Testimonial Deleted Successfully!','Success');
        return redirect()->back();
    }
    public function coverages()
    {
        $coverages = Coverages::all();
        return view('backend.coverage', compact('coverages'));
    }
    public function AddCoverage(Request $request)
    {
        $request->validate([
                'name' => ['required', 'string'],
         ]);
         
        $image = $request->file('image');
        
        if(isset($image))
        {
//            make unipue name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName  = $currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            if(!Storage::disk('public')->exists('coverages'))
            {
                Storage::disk('public')->makeDirectory('coverages');
            }

            $moveImage = Image::make($image)->stream();
            Storage::disk('public')->put('coverages/'.$imageName,$moveImage);

        } else {
            $imageName = "default.png";
        }

        $coverage = new Coverages();
        $coverage->name = $request->name;
        $coverage->image = $imageName;
        $coverage->save();
        
        
        Toastr::success('Coverage added Successfully!','Success');
        return redirect()->back();
    }
    public function message()
    {
         $messages = website_message::orderBy('status','desc')->get();
         return view('backend.website_message',compact('messages'));
    }

    public function MessageView($id)
    {
        $messages = website_message::findOrfail($id);
        $messages->status = 0;
        $messages->update();
        return view('backend.single_message',compact('messages'));
    }
    public function MessageDelete($id)
    {
        $single_message = website_message::findOrfail($id);
        $single_message->delete();

        $messages = website_message::orderBy('status','desc')->get();
        
        Toastr::success('Message deleted Successfully!','Success');
        return view('backend.website_message', compact('messages'))->with('message', 'Message deleted Successfully!');
    }
    public function sendReply(Request $request, $id)
    {

        $request->validate([
                'reply' => ['required', 'string'],
         ]);
        //$data = array('name'=>"Virat Gandhi");
        $email = website_message::findOrfail($id);
        $message = $request->reply;
        $subject = 'Re: Reply from TechnoTrack';


        Toastr::success('Reply to '.$email->name.' sent Successfully!','Success');
        return redirect()->back();        
    }


    //happy client
    public function happy_client()
    {
        $client = HappyClient::all();
        return view('backend.add_happy_client',compact('client'));
    }

    public function happy_client_save(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string'],
         ]);
        $image = $request->file('image');
        $client_name = $request->name;
        if(isset($image))
        {
//            make unipue name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName  = $currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            if(!Storage::disk('public')->exists('happy_client'))
            {
                Storage::disk('public')->makeDirectory('happy_client');
            }

            $moveImage = Image::make($image)->resize(95,67)->stream();
            Storage::disk('public')->put('happy_client/'.$imageName,$moveImage);

        } else {
            $imageName = "default.png";
        }

        $client = new HappyClient();
        $client->image = $imageName;
        $client->name = $client_name;
        $client->save();

        Toastr::success('save Successfully :)','Success');
        return redirect()->back();
    }

    public function happy_client_delete($id)
    {
        $home = HappyClient::findOrfail($id);
         if (Storage::disk('public')->exists('happy_client/'.$home->image))
        {
            Storage::disk('public')->delete('happy_client/'.$home->image);
        }
        $home->delete();
        Toastr::success('Successfully Deleted :)','Success');
        return redirect()->back();
    }



    //    services

    public function add_services()
    {
        $service = service::all();
        return view('backend.add_service',compact('service'));
    }

    public function add_services_save(Request $request)
    {
        $image = $request->file('image');
        if(isset($image))
        {
//            make unipue name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName  = $currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            if(!Storage::disk('public')->exists('service'))
            {
                Storage::disk('public')->makeDirectory('service');
            }

            $moveImage = Image::make($image)->resize(640,460)->stream();;
            Storage::disk('public')->put('service/'.$imageName,$moveImage);

        } else {
            $imageName = "default.png";
        }

        $service = new service();
        $service->image = $imageName;
        $service->title = $request->title;
        $service->description = $request->description;
        $service->save();

        Toastr::success('save Successfully :)','Success');
        return redirect()->back();
    }



    public function service_delete($id)
    {
        $home = service::findOrfail($id);
         if (Storage::disk('public')->exists('service/'.$home->image))
        {
            Storage::disk('public')->delete('service/'.$home->image);
        }
        $home->delete();

        Toastr::success('Successfully Deleted :)','Success');
        return redirect()->back();
    }



//demo

public function add_demo()
{
    $demo = Demo::all();
    return view('backend.demo',compact('demo'));
}

public function demo_save(Request $request)
{
    $image = $request->file('image');
        if(isset($image))
        {
//            make unipue name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName  = $currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            if(!Storage::disk('public')->exists('demo'))
            {
                Storage::disk('public')->makeDirectory('demo');
            }

            $moveImage = Image::make($image)->resize(556,693)->stream();;
            Storage::disk('public')->put('demo/'.$imageName,$moveImage);

        } else {
            $imageName = "default.png";
        }

        $demo = new Demo();
        $demo->image = $imageName;
        $demo->link = $request->link;
        $demo->save();

        Toastr::success('save Successfully :)','Success');
        return redirect()->back();
}


public function demo_delete($id)
{
    $home = Demo::findOrfail($id);
         if (Storage::disk('public')->exists('demo/'.$home->image))
        {
            Storage::disk('public')->delete('demo/'.$home->image);
        }
        $home->delete();
        Toastr::success('Successfully Deleted :)','Success');
        return redirect()->back();
}


//team
public function team()
{
    $team = Team::all();
    return view('backend.team',compact('team'));
}

public function team_save(Request $request)
{
    $image = $request->file('image');
        if(isset($image))
        {
//            make unipue name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName  = $currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            if(!Storage::disk('public')->exists('team'))
            {
                Storage::disk('public')->makeDirectory('team');
            }

            $moveImage = Image::make($image)->resize(270,348)->stream();;
            Storage::disk('public')->put('team/'.$imageName,$moveImage);

        } else {
            $imageName = "default.png";
        }

        $demo = new Team();
        $demo->image = $imageName;
        $demo->name = $request->name;
        $demo->designation = $request->designation;
        $demo->fb_link = $request->fb_link;
        $demo->skipe_link = $request->skipe_link;
        $demo->save();

        Toastr::success('save Successfully :)','Success');
        return redirect()->back();
}


public function team_delete($id)
{
    $home = Team::findOrfail($id);
         if (Storage::disk('public')->exists('team/'.$home->image))
        {
            Storage::disk('public')->delete('team/'.$home->image);
        }
        $home->delete();
        Toastr::success('Successfully Deleted :)','Success');
        return redirect()->back();
}


public function contact()
{
    $contact = Contact_info::all()->first();
    return view('backend.contact',compact('contact'));
}

public function contact_save(Request $request)
{
    $contact = new Contact_info();
        $contact->address = $request->address;
        $contact->phone = $request->phone;
        $contact->email = $request->email;
        $contact->header_phone_1 = $request->header_phone_1;
        $contact->header_phone_2 = $request->header_phone_2;
        $contact->header_phone_3 = $request->header_phone_3;
        $contact->bKash = $request->bKash;
        $contact->Nagad = $request->Nagad;
        $contact->Rocket = $request->Rocket;
        $contact->save();

        Toastr::success('save Successfully :)','Success');
        return redirect()->back();
}
public function contact_update(Request $request, $id)
{
        $contact = Contact_info::findOrfail($id);
        $contact->address = $request->address;
        $contact->phone = $request->phone;
        $contact->email = $request->email;
        $contact->header_phone_1 = $request->header_phone_1;
        $contact->header_phone_2 = $request->header_phone_2;
        $contact->header_phone_3 = $request->header_phone_3;
        $contact->bKash = $request->bKash;
        $contact->Nagad = $request->Nagad;
        $contact->Rocket = $request->Rocket;
        $contact->update();

        Toastr::success('Contact information updated Successfully!)','Success');
        return redirect()->back();
}

public function contact_delete($id)
{
    $home = Contact_info::findOrfail($id);
        $home->delete();
        Toastr::success('Successfully Deleted :)','Success');
        return redirect()->back();
}



public function sub_admins()
{
    $user = User::where('role',3)->orwhere('role',0)->where('type','sub_admin')->orwhere('type','web_admin')->get();

    return view('backend.sub_admin',compact('user'));
}
public function sub_admin_requests()
{
    $user = User::where('role',3)->orwhere('role',0)->where('type','sub_admin')->get();

    return view('backend.sub_admin',compact('user'));
}
public function sub_admins_approve($id)
{
    $user = User::find($id);

    if ($user->role == 3)
    {
        $user->role = 0;
        $user->update();
        Toastr::success('Sub admin Active Successfull','Success');
        return redirect()->back();
    }
    elseif($user->role == 0)
    {
        $user->role = 3;
        $user->update();
        Toastr::success('Sub admin Deactive Successfull','Success');
        return redirect()->back();
    }
}
public function subAdminEdit($id)
{
    $subadmin = User::find($id);
    
    return view('backend.sub_admin_edit', compact('subadmin'));
}
public function subAdminUpdate(Request $request, $id)
{
    $subadmin = User::find($id);
    $request->validate([
        'name' => ['required', 'string'],
        'phone' => ['required', 'string'],
        'email' => ['required', 'string'],
        'adminRole' => 'required',
    ]);
    
        $subadmin->name = $request->name;
        $subadmin->email = $request->email;
        $subadmin->phone = $request->phone;
        $subadmin->password = Hash::make($request->password);
        $subadmin->type = $request->adminRole;
        $subadmin->update();
        
        $curl = curl_init();
        curl_setopt_array($curl, array( CURLOPT_RETURNTRANSFER => 1, CURLOPT_URL => 'http://api.greenweb.com.bd/api.php?token=26a7280482e3d86e5ceb1ae5ffacd67d&to='.$request->phone.'&message='. rawurlencode('Hello '.$request->name.'! You now have admin privilege. Your credentials are Phone:'.$request->phone.' and Password: '.$request->password.'. Please use this cridentials only to login.
        TechnoTrack Admin').'', CURLOPT_USERAGENT => 'Sample cURL Request' ));
        $resp = curl_exec($curl);
        curl_close($curl);
        
        Toastr::success('Admin information updated Successfully!)','Success');
        return redirect()->back();
}
public function addAdmin()
{
    return view('backend.sub_admin_add');
}
public function addNewAdmin(Request $request)
{
    $request->validate([
        'name' => ['required', 'string'],
        'phone' => ['required', 'string'],
        'email' => ['required', 'string'],
        'adminRole' => 'required',
        'password' => 'required',
    ]);
    
    $newadmin = new User();
    $newadmin->name = $request->name;
    $newadmin->phone = $request->phone;
    $newadmin->email = $request->email;
    $newadmin->role = 3;
    $newadmin->password = Hash::make($request->password);
    $newadmin->type = $request->adminRole;
    $newadmin->save();
    
        $curl = curl_init();
        curl_setopt_array($curl, array( CURLOPT_RETURNTRANSFER => 1, CURLOPT_URL => 'http://api.greenweb.com.bd/api.php?token=26a7280482e3d86e5ceb1ae5ffacd67d&to='.$request->phone.'&message='. rawurlencode('Hello '.$request->name.'! You now have admin privilege. Your credential are Phone: '.$request->phone.' and Password: '.$request->password.'
        TechnoTrack Admin').'', CURLOPT_USERAGENT => 'Sample cURL Request' ));
        $resp = curl_exec($curl);
        curl_close($curl);
    
    Toastr::success('New admin added Successfully!)','Success');
    return redirect()->back();
    
}

public function userLogins()
{
    $logins = user_logins::whereNotIn('user_id',[1,2])->orderBy('id','desc')->get();
    
    return view('backend.user_logins', compact('logins'));
}
public function notice()
{
    $notice = Notices::where('status',0)->orderBy('id', 'desc')->get();
    return view('backend.notices', compact('notice'));
}
public function newNotice()
{
    return view('backend.add_notice');
}
public function postNotice(Request $request)
{
    $request->validate([
        'notice' => ['required', 'string'],
        'adminRole' => ['required', 'string'],
    ]);
    
    $notice = new Notices();
    $notice->created_by = Auth::user()->id;
    $notice->notice = $request->notice;
    $notice->notice_for = $request->adminRole;
    $notice->save();
    
    Toastr::success('Notice posted successfully !)','Success');
    return redirect()->to('https://www.technotrack.com.bd/admin/notices');
}
public function updateNotice($id)
{
    $notice = Notices::find($id);
    $notice->completed = 1;
    $notice->updated_by = Auth::user()->id;
    $notice->update();
    
    Toastr::success('Notice updated successfully !)','Success');
    return redirect()->back();
}
public function deleteNotice($id)
{
    $notice = Notices::find($id);
    $notice->updated_by = Auth::user()->id;
    $notice->status = 1;
    $notice->update();
    
    Toastr::success('Notice deleted successfully !)','Success');
    return redirect()->back();
}



}
