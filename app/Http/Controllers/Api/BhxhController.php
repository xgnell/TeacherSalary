<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BHXH;
use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Http\Requests\bhxh\createRequest;
use App\Http\Requests\bhxh\updateRequest;

class BhxhController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $bhxh = Bhxh::orderBy('teacher_id','asc')->search()->paginate(5);
        return view('admin.bhxh.index',compact('search','bhxh'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
        $teacher = Teacher::all();
        return view('admin.bhxh.create',compact('teacher'));
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
        if(Bhxh::create($data)){
            return redirect()->route('bhxh.index')->with('success','Thêm Thành công!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BHXH  $bHXH
     * @return \Illuminate\Http\Response
     */
    public function show(BHXH $bHXH)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BHXH  $bHXH
     * @return \Illuminate\Http\Response
     */
    public function edit(BHXH $bHXH)
    {
        return view('admin.bhxh.edit',compact('bHXH'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BHXH  $bHXH
     * @return \Illuminate\Http\Response
     */
    public function update(updateRequest $request, BHXH $bHXH)
    {
        $bHXH->update($request->only('teacher_id','total_value','month','year'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BHXH  $bHXH
     * @return \Illuminate\Http\Response
     */
    public function destroy(BHXH $bHXH)
    {
        if($bHXH->teacher->count() > 0){
            return redirect()->back()->with('error','Đang tồn tại giảng viên sử dụng');
        }else{
            $bHXH->delete();
            return redirect()->back()->with('success','Xóa thành công!');
        }
    }
}
