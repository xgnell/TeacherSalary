<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SalaryLevel\createRequest;
use App\Http\Requests\SalaryLevel\updateRequest;
use App\Models\SalaryLevel;
use Illuminate\Http\Request;

class SalaryLevelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $salary_lv = SalaryLevel::orderBy('level', 'ASC')->paginate(5);
        return view('admin.salary.level.index',compact('salary_lv'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.salary.level.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      
        $this->validate($request,[
            'level'=> "required|unique:salary_level,level",
            'basic_salary'=> "required",
        ]); 
        $data = $request->all();
        
        if(SalaryLevel::create($data)){
            return redirect()->route('salary_level.index')->with('success', 'Create success!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SalaryLevel  $salaryLevel
     * @return \Illuminate\Http\Response
     */
    public function show(SalaryLevel $salaryLevel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SalaryLevel  $salaryLevel
     * @return \Illuminate\Http\Response
     */
    public function edit(SalaryLevel $salaryLevel)
    {
        return view('admin.salary.Level.edit',compact('salaryLevel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SalaryLevel  $salaryLevel
     * @return \Illuminate\Http\Response
     */
    public function update(updateRequest $request, SalaryLevel $salaryLevel)
    {
        $salaryLevel->update($request->validated('level','basic_salary'));
        return redirect()->route('salary_level.index')->with('success','Update success!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SalaryLevel  $salaryLevel
     * @return \Illuminate\Http\Response
     */
    public function destroy(SalaryLevel $salaryLevel)
    {
        $salaryLevel->delete();
        return redirect()->route('salary_level.index')->with('success', 'Delete success!');
    }
}
