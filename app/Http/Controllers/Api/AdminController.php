<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard(){
        return view('admin.Dashboard');
    }
    public function login(){
        return view('admin.admin.login');
    }
    public function post_login(Request $request){
        $this->validate($request,[
            'email' => 'required|email',
            'password'=>'required',
        ]);
        if(Auth::attempt($request->only('email','password'),$request->has('remember'))){
            return redirect()->route('admin.dashboard')->with('success','Đăng Nhập Thành công!');
        }else{
            return redirect()->back()->with('error','Sai tài khoản hoặc mật khẩu!');
        }
    }
    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}
