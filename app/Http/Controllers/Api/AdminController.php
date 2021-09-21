<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HistorySalary;
use App\Models\Teacher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard(){
        $history_salary = HistorySalary::orderBy('time','ASC')->get();
        $salary_month = array();
        foreach($history_salary as $each) {
            $month = Carbon::parse($each->time)->month;
            $array_month = array($month);
            // dd($array_month);
        }
        $payment = HistorySalary::where('status', 1)->whereMonth('time', $month)->get();
        $so_nguoi_da_tra =0;
        foreach($payment as $each) {
            $so_nguoi_da_tra += $each->teacher_id;
            $paymented = [$so_nguoi_da_tra];
        }
        $teacher = Teacher::all();
        $tong_so_giang_vien = $teacher->count();
        $unpayment = $tong_so_giang_vien - $so_nguoi_da_tra;
        return view('admin.Dashboard',compact('array_month','paymented','unpayment'));
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
