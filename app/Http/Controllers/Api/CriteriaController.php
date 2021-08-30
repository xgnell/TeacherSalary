<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Criteria;
use Illuminate\Http\Request;
use App\Http\Requests\Criteria\createRequest;
use App\Http\Requests\Criteria\updateRequest;
use Illuminate\Validation\Rule;

class CriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $criteria = Criteria::orderBy('id','ASC')->search()->paginate(5);
        return view('admin.criteria.index',compact('search','criteria'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.criteria.create');
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
        if(Criteria::create($data)){
            return redirect()->route('criteria.index')->with('success','Thêm mới thành công!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Criteria  $criteria
     * @return \Illuminate\Http\Response
     */
    public function show(Criteria $criteria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Criteria  $criteria
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $criteria = Criteria::find($id);
        return view('admin.criteria.edit',compact('criteria'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Criteria  $criteria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $criteria = Criteria::find($id);
        $this->validate($request,[
            'name'=>[
                'required',
                Rule::unique('criteria','name')->ignore($id),
            ],
            'criteria_mark'=>'required',
        ]);
        $criteria->update($request->only('name','criteria_mark'));
        return redirect()->route('criteria.index')->with('success','Cập nhật thành công!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Criteria  $criteria
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $criteria = Criteria::find($id);
        $criteria->delete();
        return redirect()->route('criteria.index')->with('success','Xóa Thành công');
    }
}
