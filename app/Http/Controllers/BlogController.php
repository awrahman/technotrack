<?php

namespace App\Http\Controllers;

use App\AllUser;
use App\User;
use App\Blog_post;
use App\Blog_comment;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Blog_post::all();
        $users = AllUser::all();
        return view('frontend.blog',compact('posts','users'));
    }
    
    public function singlePost($id)
    {
        $post_count = Blog_post::count();
        $post = Blog_post::find($id);
        $author = User::where('id',$post->created_by)->first();
        $cmnt = Blog_comment::where('post_id',$id)->where('status',1)->orderBy('id','desc')->get();
        return view('frontend.blog_post',compact('post','author','post_count','cmnt'));
    }
    public function searchBlog($id)
    {
        $posts = Blog_post::whereRaw("find_in_set('$id',blog_tags)")->get();
        $tag = $id;
        return view('frontend.blog',compact('posts','tag'));
    }
    public function postComment(Request $request)
    {
        $validator =   $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255',],
            'comment' => 'required',
         ]);
         
         $postComment = new Blog_comment();
         $postComment->name = $request->name;
         $postComment->post_id = $request->id;
         $postComment->email = $request->email;
         $postComment->comment = $request->comment;
         $postComment->save();
         
        Toastr::success('Comment posted successfully. Awating moderator approval.','Successful');
        return redirect()->back();
    }
}
