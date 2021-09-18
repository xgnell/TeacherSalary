<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\salary\createRequest;
use App\Http\Requests\salary\updateRequest;
use App\Models\Salary;
use App\Models\Teacher;
use App\Models\Major;
use App\Models\SalaryLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $salaryLevel =SalaryLevel::all();
        $salary = Salary::join('salary_level','salary_level.level','=','salary.salary_level')->search()->paginate(5);
        return view('admin.salary.salarytea.index',compact('salary','salaryLevel','search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {   
        $search = $request->get('search');
        $major = Major::all();
        $salaryLevel =SalaryLevel::all();
        $teacher =Teacher::orderBy('id','ASC')->search()->paginate(5);
        return view('admin.salary.salarytea.create',compact('salaryLevel','major','search','teacher'));
    }

    public function add(Request $request)
    {   
        $id = $request->id;
        $level = $request->level;
        $salary_level = SalaryLevel::where('level',$level)->first();
        $teacher =Teacher::where('id',$id)->first();
        $salary = Salary::join('salary_level','salary_level.level','=','salary.salary_level')->where('teacher_id',$id)->first();
        return response()->json([
            "teacher"=>$teacher,  
            "salary_level"=>$salary_level,
            "salary"=>$salary,
        ]);
    }
    public function filter(Request $request,$slug)
    {   
        $search = $request->get('search');
        $major = Major::all();
        $salaryLevel =SalaryLevel::all();
        $teacher =Teacher::join('major','major.id','=','teacher.major_id')->where('slug',$slug)->search()->paginate(5);
        return view('admin.salary.salarytea.create',compact('major','salaryLevel','search','teacher'));
    }
    // CREATE VIEW list_salary_level as SELECT salary.*,salary_level.level,salary_level.basic_salary FROM salary INNER JOIN salary_level ON salary_level.level = salary.salary_level
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(createRequest $request)
    {
        $data = $request->all();
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
    public function editt(Request $request)
    {
        $id = $request->id;
        $level = $request->level;
        $salary_level = SalaryLevel::where('level',$level)->first();
        $salary = Salary::join('salary_level','salary_level.level','=','salary.salary_level')->join('teacher','teacher.id','=','salary.teacher_id')->where('salary.teacher_id',$id)->first();
        return response()->json([
            "salary_level"=>$salary_level,
            "salary"=>$salary,  
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function updated(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'salary_per_hour' => 'required',
            'salary_overtime_per_hour'=>'required',
            'salary_level'=>'required',
        ]);
        if ($validator->fails()){
            $errors = $validator->errors(); 
            return response()->json([
                'error' => $errors,
               
            ]);
        }
        $id= $request->id;   
        $updated_by = $request->updated_by;
        $salary_level= $request->salary_level;
        $salary_per_hour = $request->salary_per_hour;
        $salary_overtime_per_hour = $request->salary_overtime_per_hour;
        $data = array(
            'salary_level' => $salary_level,
            'salary_per_hour' => $salary_per_hour,
            'updated_by'=>$updated_by,
            'salary_overtime_per_hour' =>$salary_overtime_per_hour,
        ); 
        $salary = Salary::find($id);
        if($salary->update($data)){
            return response()->json([
            'success' => "update success",
        ]);
        }
        
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
