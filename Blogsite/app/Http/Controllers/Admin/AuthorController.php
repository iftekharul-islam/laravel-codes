<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthorController extends Controller
{
    public function index()
    {
    	$authors = User::authors()
    	->withcount('posts')
    	->withcount('comments')
    	->withcount('favorite_posts')
    	->get();

        $currenDate = carbon::now()->toDateTimeString();

    	

    	return view('admin.authors',compact('authors','currenDate'));
    }

    public function destroy($id)
    {
        $author = User::findOrFail($id)->delete();
        Toastr::success('Author Successfully Deleted','Success');
        return redirect()->back();
    }
}
