<?php

namespace App\Http\Controllers\Admin;

use App\AllUser;
use App\Complain;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ComplainController extends Controller
{
    public function all_complain()
    {
        $complain = Complain::latest()->get();
        return view('backend.complain.complain',compact('complain'));
    }

    public function solve_complain($id)
    {
        $complain = Complain::find($id);
        $complain->status = 'Solved';
        $complain->update();

        $user = AllUser::find($complain->user_id);

//

        Toastr::success('Complain solved Successfully','Success');
        return redirect()->back();
    }
}
