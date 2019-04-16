<?php

namespace App\Http\Controllers\Author;


use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Comment;
use Brian2694\Toastr\Facades\Toastr;  

class CommentController extends Controller
{
    public function index()
    {

    $posts = Auth::user()->posts;
    return view('author.comments',compact('posts'));
    }

    public function destroy($id)
    {
    	$comment = Comment::findorFail($id);
        if($comment->post->user->id == Auth::id())
        {
            $comment->delete();
            Toastr::success('Comment Successfully Deleted','Success');

        }else{

            Toastr::error('You are not Authorized to Delete this Comment','Access Denied');


        }

    	return redirect()->back();
    }
}
