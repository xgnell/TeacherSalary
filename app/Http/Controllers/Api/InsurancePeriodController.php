<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\InsurancePeriod;
use Illuminate\Http\Request;
use App\Http\Requests\InsurancePeriod\createRequest;
use App\Http\Requests\InsurancePeriod\updateRequest;

class InsurancePeriodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $periods = InsurancePeriod::paginate(5);
        return view('admin.insurance.period.index', compact('search', 'periods'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.insurance.period.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(createRequest $request)
    {
        $period = $request->validated();
        if (InsurancePeriod::create($period)) {
            return redirect()->route('insurance_period.index')->with('success', 'Add success!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\InsurancePeriod  $insurancePeriod
     * @return \Illuminate\Http\Response
     */
    public function show(InsurancePeriod $insurancePeriod)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\InsurancePeriod  $insurancePeriod
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $period = InsurancePeriod::find($id);
        return view('admin.insurance.period.edit', compact('period'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\InsurancePeriod  $insurancePeriod
     * @return \Illuminate\Http\Response
     */
    public function update(updateRequest $request, $id)
    {
        $data = $request->validated();
        $period = InsurancePeriod::find($id);
        $period->update($data);

        return redirect()->route('insurance_period.index')->with('success', 'Update success!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\InsurancePeriod  $insurancePeriod
     * @return \Illuminate\Http\Response
     */
    // public function destroy(InsurancePeriod $insurancePeriod)
    // {
    //     //
    // }
}
