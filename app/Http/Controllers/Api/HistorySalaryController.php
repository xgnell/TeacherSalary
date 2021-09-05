<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HistorySalary;
use App\Models\Major;
use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Models\BHXH;
use App\Models\Kpi;


class HistorySalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $history = HistorySalary::orderBy('month', 'ASC')->get();
        dd($history);
        
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
        $teacher = Teacher::orderBy('created_at', 'ASC')->search()->paginate(5);
        return view('admin.history.create',compact('search','major','teacher'));
    }
    public function add($id){
        $teacher = Teacher::join('salary','salary.id','=','teacher.salary_id')->where('teacher.id',$id)->first();
        $bhxh = Teacher::join('bhxh','bhxh.teacher_id','=','teacher.id')->where('teacher.id',$id)->first();
        $kpi = Teacher::join('kpi','kpi.teacher_id','=','teacher.id')->where('teacher.id',$id)->first();
        return response()->json([
            "teacher"=>$teacher,
            "bhxh"=>$bhxh,
            "kpi"=>$kpi,
        ]);

    }
    public function filter(Request $request,$slug){
        $search = $request->get('search');
        $major = Major::all();
        $teacher = Teacher::join('major', 'major.id', '=', 'teacher.major_id')->where('slug',$slug)->search()->paginate(5);
        // dd($teacher);
        return view('admin.history.create',compact('major','teacher','search'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        if(HistorySalary::create($data)){
            return redirect()->route('history_salary.index');
        }
    }

    
}