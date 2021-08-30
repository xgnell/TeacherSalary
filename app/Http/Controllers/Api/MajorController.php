<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Major\createRequest;
use App\Http\Requests\Major\updateRequest;
use App\Models\Major;
use Illuminate\Http\Request;

class MajorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $major = Major::orderBy('id', 'asc')->search()->paginate(5);
        return view('admin.major.index',compact('major','search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.major.create');
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
        if(Major::create($data)){
            return redirect()->route('major.index')->with('success','Thêm thành công!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Major  $major
     * @return \Illuminate\Http\Response
     */
    public function show(Major $major)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Major  $major
     * @return \Illuminate\Http\Response
     */
    public function edit(Major $major)
    {
        
        return view('admin.major.edit',compact('major'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Major  $major
     * @return \Illuminate\Http\Response
     */
    public function update(updateRequest $request, Major $major)
    {
        $major->update($request->validated());
        return redirect()->route('major.index')->with('success','Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Major  $major
     * @return \Illuminate\Http\Response
     */
    public function destroy(Major $major)
    {
        if($major->teacher->count()>0){
            return redirect()->back()->with('error','Ngành này đang tồn tại giảng viên!');
        }else{
            $major->delete();
            return redirect()->back()->with('success','Xóa thành công!');

        }
    }
}
