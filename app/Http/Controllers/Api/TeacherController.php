<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Teacher\createRequest;
use App\Http\Requests\Teacher\updateRequest;
use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Models\Salary;
use App\Models\Major;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $teacher = Teacher::orderBy('created_at','ASC')->search()->paginate(5);
        return view('admin.teacher.index',compact('search', 'teacher'));
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
        $password = Hash::make($request->password);
        $request->merge(['password' => $password]);
        $data = $request->all();
        if(Teacher::create($data)){
            return redirect()->route('teacher.index')->with('success', 'Thêm thành công!');
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
        $teacher->update($request->only('first_name','last_name','address','phone','birthday','gender','major_id','salary_id','status','image'));
        return redirect()->route('teacher.index')->with('success','Cập nhật thành công!');
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
}
