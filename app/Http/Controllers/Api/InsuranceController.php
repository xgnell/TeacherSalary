<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Insurance;
use Illuminate\Http\Request;
use App\Http\Requests\Insurance\createRequest;
use App\Http\Requests\Insurance\updateRequest;
use App\Models\InsurancePeriod;

class InsuranceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $insurances = Insurance::paginate(5);
        return view('admin.insurance.type.index',compact('search','insurances'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
        $periods = InsurancePeriod::all();
        return view('admin.insurance.type.create',compact('periods'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(createRequest $request)
    {
        $insurance = $request->validated();
        if ($request->mandatory) {
            $insurance['mandatory'] = true;
        } else {
            $insurance['mandatory'] = false;
        }

        if(Insurance::create($insurance)){
            return redirect()->route('insurance.index')->with('success','Add success!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Insurance  $insurance
     * @return \Illuminate\Http\Response
     */
    public function show(Insurance $insurance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Insurance  $Insurance
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $insurance = Insurance::find($id);
        $periods = InsurancePeriod::all();
        return view('admin.insurance.type.edit',compact('insurance','periods'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Insurance  $insurance
     * @return \Illuminate\Http\Response
     */
    public function update(updateRequest $request, $id)
    {
        $data = $request->validated();

        if ($request->mandatory) {
            $data['mandatory'] = true;
        } else {
            $data['mandatory'] = false;
        }

        $insurance = Insurance::find($id);
        $insurance->update($data);

        return redirect()->route('insurance.index')->with('success', 'Update success!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Insurance  $insurance
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {
    //     $insurance = Insurance::find($id);
    //     if($insurance->teacher->count() > 0){
    //         return redirect()->back()->with('error','Đang tồn tại giảng viên sử dụng BHXH');
    //     }else{
    //         $bHXH->delete();
    //         return redirect()->back()->with('success', 'Delete success!');
    //     }
    // }
}
