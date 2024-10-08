<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class CoreAdminLoginController extends Controller
{
    function __construct()
	{
		$this->middleware('guest:core-admin');
	}
    public function showLoginForm()
    {
        $page_title = 'Login';
    	return view('auth.core-admin-login', [
            'title' => $page_title
        ]);
    }
    public function login(Request $request)
    {
    	//Validate the form data
    	$this->validate($request, [
    		'email' 	=> 'required|email',
    		'password'	=> 'required|min:6'
    	]);
    	//Attempt to log the user in
    	if(Auth::guard('core-admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)){
			//if successful, then redirect to their intended location
			return redirect()->intended(route('core-admin.dashboard'));
    	}
    	//if unsuccessful then redirect back to the login with the form data
    	return redirect()->back()->withInput($request->only('email','remember'));
    }
}
