<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\WebPageSettingsModel;
use Hash;
use Session;
use Validator;

class UserAuthController extends Controller
{
    public function login(){
		$WebPageSettingsdata = WebPageSettingsModel::first();
        //return view("auth.login");
		return view("auth.login", compact('WebPageSettingsdata'));
    }

    public function loginUser(Request $request){ 
		
		$request->validate([
            'user_name'=>'required|min:1|max:40', 
            'InputPassword'=>'required|min:6|max:20'
        ]);
		
        $user = User::where('user_name', '=', $request->user_name)->first();
		if ($user){
			if(Hash::check($request->InputPassword,$user->user_password)){
				$request->session()->put('loginID', $user->user_id);
				return redirect('switch');
			}else{
				return back()->with('fail', 'Incorrect Password');
			}
		}else{
			return back()->with('fail', 'This Username is not Registered.');
		}
    }

    public function logout(){
		if(Session::has('loginID')){
			Session::pull('loginID');
			return redirect('/');
		}
    }
}
