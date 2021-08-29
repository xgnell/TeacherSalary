<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\salary\createRequest;
use App\Http\Requests\salary\updateRequest;
use App\Models\Salary;
use App\Models\SalaryLevel;
use Illuminate\Http\Request;

class SalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $salary = Salary::orderBy('salary_basic', 'ASC')->paginate(5);
        return view('admin.salary.index',compact('salary'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $salaryLevel =SalaryLevel::all();
        return view('admin.salary.create',compact('salaryLevel'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(createRequest $request)
    {
        $data = $request->validated();
        if(Salary::create($data)){
            return redirect()->route('salary.index')->with('success','Thêm thành công!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function show(Salary $salary)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function edit(Salary $salary)
    {
        $salaryLevel = SalaryLevel::all();
        return view('admin.salary.edit',compact('salary','salaryLevel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function update(updateRequest $request, Salary $salary)
    {
        $salary->update($request->only('salary_basic','salary_per_hour','salary_ot_per_hour'));
        return redirect()->route('salary.index')->with('success','Cập nhật thành công!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function destroy(Salary $salary)
    {
        if($salary->teacher->count() > 0){
            return redirect()->route('salary.index')->with('error','Mức lương này đang có giảng viên sử dụng!');
        }else{
            $salary->delete();
            return redirect()->route('salary.index')->with('success','Xóa Thành Công');
        }
    }
}
