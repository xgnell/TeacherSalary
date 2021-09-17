<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Insurance;
use App\Models\Teacher;
use App\Models\TeacherInsurance;
use Illuminate\Http\Request;

class TeacherInsuranceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $insurance_by_teacher = TeacherInsurance::all()->groupBy('teacher_id');
        return view('admin.insurance.teacher.index', compact('search', 'insurance_by_teacher'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Get teachers that already have insurances
        // $teachers = Teacher::where()->get();
        // $insurances = Insurance::all();
        // return view('admin.insurance.teacher.create', compact('teachers', 'insurances'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TeacherInsurance  $teacherInsurance
     * @return \Illuminate\Http\Response
     */
    public function show(TeacherInsurance $teacherInsurance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TeacherInsurance  $teacherInsurance
     * @return \Illuminate\Http\Response
     */
    public function edit(TeacherInsurance $teacherInsurance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TeacherInsurance  $teacherInsurance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TeacherInsurance $teacherInsurance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TeacherInsurance  $teacherInsurance
     * @return \Illuminate\Http\Response
     */
    public function destroy(TeacherInsurance $teacherInsurance)
    {
        // Delete insurance when it is not mandatory
    }
}
