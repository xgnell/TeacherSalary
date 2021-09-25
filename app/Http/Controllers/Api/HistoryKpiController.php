<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HistoryKpi;
use Illuminate\Http\Request;
use App\Constants\HistoryKPIStatus;
use App\Models\Kpi;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
    public function store(Request $request)
    {
        // Lấy ra thời gian hiện tại
        $current_time = date('Y-m-01');

        // Lấy ra mã giảng viên
        $teacher_id = $request->teacher_id;

        // Lấy ra admin đang đăng nhập hiện tại
        $admin_id = Auth::user()->id;

        // Lấy ra danh sách điểm các tiêu chí kpi
        $kpi_criterias = Kpi::all();
        $criteria_points = [];
        foreach ($kpi_criterias as $criteria) {
            $key = 'criteria_' . $criteria->id;
            if ($request->get($key) !== null) {
                $criteria_points[$criteria->id] = $request->get($key);
            }
        }

        // Update lịch sử kpi tháng cho giảng viên
        $success = true;
        foreach ($criteria_points as $criteria_id => $criteria_point) {
            $criteria = [
                'time' => $current_time,
                'teacher_id' => $teacher_id,
                'criteria_id' => $criteria_id,
                'point' => $criteria_point,
                'status' => 1,
                'updated_by' => $admin_id,
            ];
            if (!HistoryKpi::create($criteria)) {
                $success = false;
            }
        }
        
        if ($success) {
            return redirect()->route('history_kpi.index')->with('success','Add success!');
        } else {
            return redirect()->route('history_kpi.index')->with('error','Add failed!');
        }
    }

    public function show()
    {
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HistoryKpi  $historyKpi
     * @return \Illuminate\Http\Response
     */
    public function show_by_month()
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

        $HistoryKpiStatus = HistoryKPIStatus::class;
        return view('admin.kpi.history.show', compact('history_kpis', 'HistoryKpiStatus', 'is_updated_all'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HistoryKpi  $historyKpi
     * @return \Illuminate\Http\Response
     */
    public function edit($teacher_id)
    {
        // Lấy ra thời gian hiện tại
        $current_time = date('Y-m-01');
        
        // Lấy ra thông tin giảng viên
        $teacher = Teacher::find($teacher_id);

        // Lấy ra các tiêu chí đánh giá KPI của giảng viên
        $kpi_criterias = DB::table('kpi')
                            ->join('history_kpi', 'kpi.id', '=', 'history_kpi.criteria_id')
                            ->where('teacher_id', $teacher_id)
                            ->get();

        // dd($kpi_criterias);

        return view('admin.kpi.history.edit', compact('teacher', 'kpi_criterias'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HistoryKpi  $historyKpi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $teacher_id)
    {
        // Lấy ra thời gian hiện tại
        $current_time = date('Y-m-01');

        // Lấy ra admin đang đăng nhập hiện tại
        $admin_id = Auth::user()->id;

        // Lấy ra danh sách điểm các tiêu chí kpi
        $kpi_criterias = Kpi::all();
        $criteria_points = [];
        foreach ($kpi_criterias as $criteria) {
            $key = 'criteria_' . $criteria->id;
            if ($request->get($key) !== null) {
                $criteria_points[$criteria->id] = $request->get($key);
            }
        }

        // Query lịch sử kpi tháng của giảng viên
        $query = DB::table('history_kpi')
                            ->where('teacher_id', $teacher_id)
                            ->where('time', $current_time);

        // Lấy ra lịch sử lương tháng của tất cả tiêu chí KPI
        $history_kpi_criterias = $query->get();

        // Update lịch sử kpi tháng cho giảng viên đối với từng tiêu chí
        foreach ($history_kpi_criterias as $history_kpi_criteria) {
            // Build query cho 1 tiêu chí KPI
            $query_criteria = clone $query;
            $query_criteria->where('criteria_id', $history_kpi_criteria->criteria_id);
            
            // Thông tin cần update
            $criteria = [
                'time' => $current_time,
                'teacher_id' => $teacher_id,
                'criteria_id' => $history_kpi_criteria->criteria_id,
                'point' => $criteria_points[$history_kpi_criteria->criteria_id] ?? 0,
                'status' => 2,
                'updated_by' => $admin_id,
            ];

            // Update thông tin cho tiêu chí cụ thể
            $query_criteria->update($criteria);
        }

        // dd('stop jere');

        return redirect()->route('history_kpi.show_by_month')->with('success','Update success!');
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
