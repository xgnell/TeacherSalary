<?php

namespace App\Http\Controllers\Api;

use App\Exports\Teacher\TeacherExcelExport;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use App\Http\Requests\Teacher\createRequest;
use App\Http\Requests\Teacher\updateRequest;
use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Models\Salary;
use App\Models\Major;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;


class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      
        if($request->slug){ 
            $slug = $request->slug;
            $major = Major::all();
            $search = $request->get('search');
            $teacher = Teacher::select('teacher.*', 'major.name as nameMajor')->join('major', 'major.id', '=', 'teacher.major_id')->where('slug',$slug)->search()->paginate(5);
            return view('admin.teacher.index',compact('search', 'teacher','major','slug'));
        }else{
            $major = Major::all();
            $search = $request->get('search');
            $teacher = Teacher::orderBy('created_at','ASC')->search()->paginate(4);
            return view('admin.teacher.index',compact('search', 'teacher','major'));
        }
        
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $major = Major::all();
        $salary = Salary::all();
        return view('admin.teacher.create',compact('major', 'salary'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(createRequest $request)
    {
        $rand = Str::random(6);
        $password = Hash::make($rand);
        $request->merge(['password' => $password]);
        $data = $request->all();
        Mail::send('admin.mail.mailpassword',[
            'name' => $request->name,
            'address'=>$request->address,
            'phone'=>$request->phone,
            'birthday'=>$request->birthday,
            'rand' =>$rand,
        ], function($message) use($request){
            $mail = $request->email;
            $message->to($mail,$request->name);
            $message->from($_ENV["MAIL_USERNAME"]);
            $message->subject('Confirm');
        });
        if(Teacher::create($data)){
            return redirect()->route('teacher.index')->with('success', 'Create success!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function show(Teacher $teacher)
    {
        return view('admin.teacher.show',compact('teacher'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function edit(Teacher $teacher)
    {
        $major = Major::all();
        $salary = Salary::all();
        return view('admin.teacher.edit',compact('teacher','major','salary'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function update(updateRequest $request, Teacher $teacher)
    {
        $teacher->update($request->only('name','email', 'address','phone','birthday','gender','major_id','salary_id','status','image'));
        return redirect()->route('teacher.index')->with('success', 'Update success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teacher $teacher)
    {
        //
    }
    public function export(){
    
        $date = date('Y-m-d');
        return Excel::download(new TeacherExcelExport(), "Teacher_$date.xlsx");
    }
    
}
