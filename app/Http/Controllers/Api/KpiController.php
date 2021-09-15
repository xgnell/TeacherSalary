<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kpi;
use Illuminate\Http\Request;
use App\Http\Requests\Kpi\createRequest;
use App\Http\Requests\Kpi\updateRequest;
use Illuminate\Validation\Rule;

class KpiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $criterias = Kpi::paginate(5);
        return view('admin.kpi.criteria.index',compact('search','criterias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.kpi.criteria.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(createRequest $request)
    {
        $criterias = $request->validated();

        if(Kpi::create($criterias)){
            return redirect()->route('kpi.index')->with('success', 'Create success!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kpi  $criteria
     * @return \Illuminate\Http\Response
     */
    public function show(Kpi $criteria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kpi  $criteria
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $criteria = Kpi::find($id);
        return view('admin.kpi.criteria.edit',compact('criteria'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kpi  $criteria
     * @return \Illuminate\Http\Response
     */
    public function update(updateRequest $request, $id)
    {
        $data = $request->validated();

        $criteria = Kpi::find($id);
        $criteria->update($data);

        return redirect()->route('kpi.index')->with('success', 'Update success!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kpi  $criteria
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {
    //     $criteria = Kpi::find($id);
    //     $criteria->delete();
    //     return redirect()->route('kpi.index')->with('success', 'Delete success');
    // }
}
