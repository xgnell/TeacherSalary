<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HistoryKpi;
use Illuminate\Http\Request;
use App\Constants\HistoryKPIStatus;
use App\Models\Kpi;

class HistoryKpiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $history_kpis = HistoryKpi::all()->groupBy(['time', 'teacher_id']);

        $HistoryKpiStatus = HistoryKPIStatus::class;
        return view('admin.kpi.history.index',compact('search','history_kpis', 'HistoryKpiStatus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Lấy tổng số giảng viên chưa được update kpi tháng hiện tại
        $unupdated_teachers = HistoryKpi::getUnupdatedKpisOfMonth(date("Y-m-d"));

        // Lấy ra các tiêu chí đánh giá KPI
        $kpi_criterias = Kpi::all();

        return view('admin.kpi.history.create', compact('unupdated_teachers', 'kpi_criterias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($teacher_id, Kpi $kpi)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HistoryKpi  $historyKpi
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        // Lấy tất cả các giảng viên đã update kpi của tháng hiện tại
        $history_kpis = HistoryKpi::getUpdatedKpisOfMonth(date("Y-m-d"));

        // Lấy tổng số giảng viên chưa được update kpi tháng hiện tại
        $unupdated_teachers = HistoryKpi::getUnupdatedKpisOfMonth(date("Y-m-d"));
        $count_unupdated = count($unupdated_teachers);

        // Kiểm tra xem đã update hết kpi tháng này cho tất cả giảng viên hay chưa ?
        $is_updated_all = false;
        if ($count_unupdated <= 0) {
            $is_updated_all = true;
        }

        $HistoryKpiStatus =HistoryKPIStatus::class;
        return view('admin.kpi.history.show', compact('history_kpis', 'HistoryKpiStatus', 'is_updated_all'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HistoryKpi  $historyKpi
     * @return \Illuminate\Http\Response
     */
    public function edit(HistoryKpi $historyKpi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HistoryKpi  $historyKpi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HistoryKpi $historyKpi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HistoryKpi  $historyKpi
     * @return \Illuminate\Http\Response
     */
    // public function destroy(HistoryKpi $historyKpi)
    // {
    //     //
    // }
}
