<?php

namespace App\Http\Controllers\Admin;

use App\Payment;
use App\payment_confarmation_history;
use App\technician_device_stock;
use App\Transaction_history;
use App\payment_history;
use App\AllUser;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HistoryController extends Controller
{
    public function device_sell_history()
    {
        $device_history = Transaction_history::latest()->get();
        $total_sell_price = Transaction_history::sum('sell_price');

        return view('backend.history.device_sell_history',compact('device_history','total_sell_price'));
    }

    public function billing_history()
    {
        $billing = payment_confarmation_history::whereNotIn('user_id',[1,1])->latest()->get();
        $total_pay_amount = payment_confarmation_history::whereNotIn('user_id',[1,1])->get()->sum('updated_amount');
        return view('backend.history.billing_confarmation_history',compact('billing','total_pay_amount'));
    }

    public function billing_history_search_date(Request $request)
    {
        $start_date = Carbon::parse($request->start_date)->startOfDay()->toDateTimeString();
        $end_date = Carbon::parse($request->end_date)->startOfDay()->toDateTimeString();
        if ($start_date == $end_date){
            $billing = payment_confarmation_history::whereDate('created_at', '=',$start_date)->get();
            $total_pay_amount = payment_confarmation_history::whereDate('created_at', '=',$start_date)->sum('updated_amount');
        }else{
            $billing = payment_confarmation_history::whereBetween('created_at', [$start_date, $end_date])->get();
            $total_pay_amount = payment_confarmation_history::whereBetween('created_at', [$start_date, $end_date])->sum('updated_amount');
        }



         return view('backend.history.billing_confarmation_history',compact('billing','total_pay_amount'));
    }


    public function payment_by_online()
    {
        $online_payment = Payment::where('status','Processing')->latest()->get();
        $total_pay_amount = Payment::where('status','Processing')->sum('amount');
        return view('backend.history.online_payment_history',compact('online_payment','total_pay_amount'));
    }


    public function payment_by_online_search_date(Request $request)
    {
        $start_date = Carbon::parse($request->start_date)->startOfDay()->toDateTimeString();
        $end_date = Carbon::parse($request->end_date)->startOfDay()->toDateTimeString();
        if ($start_date == $end_date){
            $online_payment = Payment::whereDate('created_at', '=',$start_date)->where('status','Processing')->get();
            $total_pay_amount = Payment::whereDate('created_at', '=',$start_date)->where('status','Processing')->sum('amount');
        }else{
            $online_payment = Payment::whereBetween('created_at', [$start_date, $end_date])->where('status','Processing')->get();
            $total_pay_amount = Payment::whereBetween('created_at', [$start_date, $end_date])->where('status','Processing')->sum('amount');
        }

         return view('backend.history.online_payment_history',compact('online_payment','total_pay_amount'));
    }
    
    public function monthlyPayments()
    {
        $payments = payment_confarmation_history::whereNotIn('user_id',[1,1])->whereMonth('updated_at', Carbon::now()->format('m'))->whereYear('updated_at', Carbon::now()->format('Y'))->orderBy('id', 'desc')->get();
        $total = $payments->sum('updated_amount');
        
        return view('backend.history.monthly_history',compact('payments', 'total'));
    }
    
    public function dailyPayments()
    {
        $payments = payment_confarmation_history::whereNotIn('user_id',[1,1])->whereDate('updated_at', Carbon::today())->orderBy('id', 'desc')->get();
        
        $total = $payments->sum('updated_amount');

        return view('backend.history.daily_history',compact('payments', 'total'));
    }
}
