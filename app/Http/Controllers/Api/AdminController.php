<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HistoryKpi;
use App\Models\HistorySalary;
use App\Models\Teacher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard(Request $request){
        
        $history_salarys = Teacher::
        join('history_salary','history_salary.teacher_id','=','teacher.id')
        ->select(DB::raw('DISTINCT(history_salary.time),count(history_salary.teacher_id)'))
        ->groupBy(['history_salary.time','history_salary.teacher_id'])
        ->get(); 

        $so_nguoi_da_tra =0;
        $so_nguoi_chua_tra =0;
        $array = array();
        $paymented = array();
        $unpayment = array();
        $unpaymentss = array();
        
        $tong_so_giang_vien = null;
        $unpayments = null;
        foreach($history_salarys as $history_salary) { 
            $month = Carbon::parse($history_salary->time ?? "")->month;
            $year = Carbon::parse($history_salary->time ?? "")->year;
            $time = $year.'-'.$month;
            array_push($array,$time);
        $payment = Teacher::join('history_salary','history_salary.teacher_id','=','teacher.id')
            ->where('history_salary.status', 4)
            ->whereMonth('history_salary.time','=', $month)
            ->whereYear('history_salary.time','=', $year)
            ->get();
            $so_nguoi_da_tra = $payment->count();
            array_push($paymented,$so_nguoi_da_tra);

            $unpayments = DB::table('teacher')
            ->select('teacher.*')
            ->whereNotIn('teacher.id', DB::table('history_salary')
            ->select('history_salary.teacher_id')
            ->whereMonth('history_salary.time','=', $month)
            ->whereYear('history_salary.time','=', $year))->get();
            $unpayments->{"time"}=$time;
            array_push($unpaymentss,$unpayments);
        $teacher = Teacher::all();
        $tong_so_giang_vien = $teacher->count();

            $so_nguoi_chua_tra = $unpayments->count();
            array_push($unpayment,$so_nguoi_chua_tra);
        }
            // dd($paymented);
    //   dd($unpaymentss);
        return view('admin.Dashboard',compact(
            'array',
            'unpayment',
            'paymented',
            'tong_so_giang_vien',
            'unpayments',
            'unpaymentss'
        ));
    }
    public function kpi_highest(){
        echo "hello";
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
            return redirect()->route('admin.dashboard')->with('success', 'Login success!');
        }else{
            return redirect()->back()->with('error', 'Wrong email or password');
        }
    }
    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}
