<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Criteria;
use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Models\Kpi;

class KpiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function view($id){
        $criteria = Criteria::all();
        $teacher = Teacher::find($id);
        return view('admin.kpi.create',compact('teacher','criteria'));

    }
    public function add(Request $request){
        $data = $request->all();
        if(Kpi::create($data)){
            return redirect()->route('history_salary.create')->with('success','Thêm thành công!');
        }
    }
    public function edit($id){
        $kpi = Kpi::find($id);
        $criteria = Criteria::all();
        return view('admin.kpi.edit',compact('kpi','criteria'));
    }
    public function update(Request $request,$id){
        $kpi = Kpi::find($id);
        $kpi->update($request->only('teacher_id','total_value','time'));
        return redirect()->route('history_salary.create')->with('success','Update Kpi thành công!');
    }
}
