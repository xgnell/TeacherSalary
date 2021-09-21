<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HistoryKpi;
use App\Models\HistorySalary;
use App\Models\HistoryTeachingHours;
use Illuminate\Http\Request;
use App\Models\Major;
use App\Models\Salary;
use Illuminate\Support\Facades\Auth;
use App\Models\Teacher;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;


class HomeController extends Controller
{
    public function index(){
       
        $major = Major::all();
        return view('user.index',compact('major'));
    }

    public function contact(){
        $major = Major::all();
        $id = Auth::guard('teacher')->user()->id;
        $teacher = Teacher::where('id',$id)->first();
        return view('user.contact',compact('major','teacher'));
    }

    public function post_contact(Request $request) {
        Mail::send('mail.contact',[
            'name' => $request->name,
            'message' => $request->message,
        ], function($message) use($request){
            $mail = $request->email;
            $message->to('nguyenvdat8@gmail.com',$request->name);
            $message->from($mail);
            $message->subject('Feedback');
        });
        return response()->json([
            'success'=>'Feedback success!',
        ]);
     }

    public function mysalary(){
        $current_time = date('Y-m');
        $current_month = date('m');
        $id = Auth::guard('teacher')->user()->id;
         $history_kpi = HistoryKpi::whereMonth('time','=',$current_month)->where('teacher_id',$id)->get();
        $history_salary = HistorySalary::whereMonth('time','=',$current_month)->where('teacher_id',$id)->first();
        $history_teaching = HistoryTeachingHours::whereMonth('time','=',$current_month)->where('teacher_id',$id)->first();
        return view('user.mysalary',compact('history_salary','current_time','history_teaching','history_kpi'));
    }

    public function history(){
        $id = Auth::guard('teacher')->user()->id;
        $HistorySalary = HistorySalary::orderBy('time','ASC')->where('teacher_id',$id)->get();
        return view('user.history',compact('HistorySalary'));
    }
    public function detail_kpi(Request $request){
        $id = $request->id;
        $history_kpi = HistoryKpi::join('kpi','kpi.id','=','history_kpi.criteria_id')->orderBy('time','ASC')->where('teacher_id',$id)->get();
        return response()->json([
            'history_kpi' => $history_kpi,
        ]);
    }
    public function staff(){
        $id = Auth::guard('teacher')->user()->id;
        $teacher = Teacher::where('id',$id)->first();
        return view('user.staff',compact('teacher'));
    }

    public function login() {
        return view('user.login');
     }
     public function post_login(Request $request) {
         $request->session()->regenerate();
         
         $this->validate($request,[
            'email' => 'required|email',
            'password'=>'required',
        ]);
         if(Auth::guard('teacher')->attempt($request->only('email','password'),$request->has('remember'))){
             return redirect()->route('home')->with('success','Đăng Nhập Thành công!');
         }else{
             return redirect()->back()->with('error','Tài khoản hoặc mật khẩu không chính xác !');
         }
         
     }
     public function logout() {
        Auth::guard('teacher')->logout();
        // session(['cart'=>'']);
        return redirect()->route('home.login');
    }

     /**
     * Change the current password
     * @param Request $request
     * @return Renderable
     */
    public function change(Request $request)
    {       
        $id = Auth::guard('teacher')->user()->id;
        $user = Teacher::find($id);
        $userPassword = $user->password;
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|same:confirm_password',
            'confirm_password' => 'required',
        ]);

        if (!Hash::check($request->current_password, $userPassword)) {
            return response()->json([
                "error"=>"ERROR: Change password!",  
            ]);
        }

        $password = Hash::make($request->password);
        $request->merge(['password' => $password]);
        $user->update($request->only('password'));

        return response()->json([
            "success"=>"SUCCESS: Change password success!",  
        ]);
    }
}
