<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class AdminController extends Controller
{
    public function admin_login(){
        return view('admin.login');
    }

    public function authenticate(Request $request){
        $validator = Validator::make($request->all(),[
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        $credentails = $request->only('email','password');
        if ($validator->passes()) {
            if(Auth::guard('admin')->attempt($credentails,$request->get('remember'))){
                return redirect()->route('admin.dashboard');
            }else{
                return redirect()->route('admin.login')->with('error','Invalid Email or Password');
            }
        }else{
            return redirect()->route('admin.login')
                ->withErrors($validator)
                ->withInput($request->only('email'));
        }
    }
}
