<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
    	return view('auth.passwords.change');
    }


    public function changePassword(Request $request)
    {


    	// return $request->all();



    	$this->validate($request,[
    		'oldpassword' => 'required',
    		'password' => 'required|confirmed'
    	]);

    	$hashedPassword = Auth::user()->password;
    	//return $hashedPassword;

    	if(Hash::check($request->oldpassword,$hashedPassword))
    	{
    		$user = User::find(Auth::id());
    		$user->password = Hash::make($request->password);
    		$user->save();
    		Auth::logout();
    		return redirect()->route('login')->with('successMsg',"Password is Changed Successfully");

    	}
    	else
    	{
    		return redirect()->back()->with('errorMsg',"Current password is invalid");
    	}
    }
}
