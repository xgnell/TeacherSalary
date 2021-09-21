<?php

namespace App\Http\Controllers\Api;

use App\Exports\Teacher\TeacherExcelExport;
use App\Http\Controllers\Controller;
use App\Models\Insurance;
use App\Models\Teacher;
use App\Models\TeacherInsurance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        // Lấy ra số lượng giảng viên chưa sử dụng loại bảo hiểm nào
        $count_teachers = count(TeacherInsurance::getNotUseInsuranceTeachers());
        $is_used_all = false;
        if ($count_teachers <= 0) {
            $is_used_all = true;
        }

        return view('admin.insurance.teacher.index', compact('search', 'insurance_by_teacher', 'is_used_all'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Lấy ra danh sách giảng viên chưa sử dụng loại bảo hiểm nào
        $teachers = TeacherInsurance::getNotUseInsuranceTeachers();

        // Lấy ra tất cả các loại bảo hiểm
        $insurances = Insurance::all();

        return view('admin.insurance.teacher.create', compact('teachers', 'insurances'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Lấy ra id giảng viên
        $teacher_id = $request->teacher_id;

        // Lấy ra danh sách loại bảo hiểm mà giảng viên sử dụng
        $all_insurances = Insurance::all();
        $insurance_types = [];
        foreach ($all_insurances as $insurance) {
            if ($request->get('insurance_' . $insurance->id) !== NULL || $insurance->mandatory) {
                array_push($insurance_types, $insurance->id);
            }
        }

        // Thêm vào db
        $success = true;
        foreach ($insurance_types as $insurance_id) {
            if (!TeacherInsurance::create([
                'teacher_id' => $teacher_id,
                'insurance_id' => $insurance_id,
            ])) {
                $success = false;
            }
        }

        if ($success) {
            return redirect()->route('teacher_insurance.index')->with('success','Add success!');
        } else {
            return redirect()->route('teacher_insurance.index')->with('error','Add failed!');
        }
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
    public function edit(Request $request, $teacher_id)
    {
        $teacher = Teacher::find($teacher_id);

        $insurances = DB::table('insurance')
                        ->leftJoinSub(
                            DB::table('teacher_insurance')
                            ->where('teacher_id', $teacher_id),
                            
                            'teacher_insurance_used',
                            
                            function($join) {
                                $join->on('teacher_insurance_used.insurance_id', '=', 'insurance.id');
                            }
                        )
                        ->get();
        
        return view('admin.insurance.teacher.edit', compact('teacher', 'insurances'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TeacherInsurance  $teacherInsurance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $teacher_id)
    {
        // Lấy ra danh sách loại bảo hiểm cần update
        $all_insurances = Insurance::all();
        $insurance_types = [];
        foreach ($all_insurances as $insurance) {
            if ($request->get('insurance_' . $insurance->id) !== NULL || $insurance->mandatory) {
                $insurance_types[$insurance->id] = true;
            } else {
                $insurance_types[$insurance->id] = false;
            }
        }

        // Lấy ra danh sách loại bảo hiểm mà giảng viên sử dụng
        $query = TeacherInsurance::where('teacher_id', $teacher_id);
        $used_insurances = $query->get();
        $used_insurance_types = [];
        foreach ($used_insurances as $used_insurance) {
            array_push($used_insurance_types, $used_insurance->insurance_id);
        }

        // Update vào db
        $success = true;
        foreach ($insurance_types as $insurance_type_id => $insurance_type_option) {
            if ($insurance_type_option === true
                && !in_array($insurance_type_id, $used_insurance_types)
            ) {
                // Add
                if (!TeacherInsurance::create([
                    'teacher_id' => $teacher_id,
                    'insurance_id' => $insurance_type_id,
                ])) {
                    $success = false;
                }
            } else if (
                $insurance_type_option === false
                && in_array($insurance_type_id, $used_insurance_types)
            ) {
                // Delete
                if (!$query->where('insurance_id', $insurance_type_id)->delete()) {
                    $success = false;
                }
            }
        }
        

        if ($success) {
            return redirect()->route('teacher_insurance.index')->with('success','Update success!');
        } else {
            return redirect()->route('teacher_insurance.index')->with('error','Update failed!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TeacherInsurance  $teacherInsurance
     * @return \Illuminate\Http\Response
     */
    // public function destroy(TeacherInsurance $teacherInsurance)
    // {
    //     // Delete insurance when it is not mandatory
    // }
    
}
