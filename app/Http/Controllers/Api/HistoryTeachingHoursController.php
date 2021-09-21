<?php

namespace App\Http\Controllers\Api;

use App\Constants\HistoryTeachingHourStatus;
use App\Http\Controllers\Controller;
use App\Models\HistoryTeachingHours;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\HistoryTeachingHours\createRequest;
use App\Http\Requests\HistoryTeachingHours\updateRequest;
use App\Models\Teacher;

class HistoryTeachingHoursController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teaching_hours = HistoryTeachingHours::all()->groupBy('time');

        $TeachingHourStatus = HistoryTeachingHourStatus::class;

        return view('admin.history_teaching_hours.index', compact('teaching_hours', 'TeachingHourStatus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Lấy tổng số giảng viên chưa được update giờ dạy tháng hiện tại
        $unupdated_teachers = HistoryTeachingHours::getUnupdatedTeachingHoursOfMonth(date("Y-m-d"));

        return view('admin.history_teaching_hours.create', compact('unupdated_teachers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(createRequest $request)
    {
        // Lấy ra thời gian hiện tại
        $current_time = date('Y-m-01');

        // Lấy ra admin đang đăng nhập hiện tại
        $admin_id = Auth::user()->id;

        // Lấy ra thông tin từ request
        $total_hours = $request->validated();
        
        $total_hours['time'] = $current_time;
        $total_hours['updated_by'] = $admin_id;
        $total_hours['status'] = 1;

        if (HistoryTeachingHours::create($total_hours)) {
            return redirect()->route('history_teaching_hours.show_by_month')->with('success','Add success!');
        } else {
            return redirect()->route('history_teaching_hours.show_by_month')->with('error','Add failed!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HistoryTeachingHours  $historyTeachingHours
     * @return \Illuminate\Http\Response
     */
    public function show_by_month()
    {
        // Lấy tất cả các giảng viên đã update giờ dạy của tháng hiện tại
        $history_teaching_hours = HistoryTeachingHours::getUpdatedTeachingHoursOfMonth(date("Y-m-d"));

        // Lấy tổng số giảng viên chưa được update giờ dạy tháng hiện tại
        $unupdated_teachers = HistoryTeachingHours::getUnupdatedTeachingHoursOfMonth(date("Y-m-d"));
        $count_unupdated = count($unupdated_teachers);

        // Kiểm tra xem đã update hết giờ dạy tháng này cho tất cả giảng viên hay chưa ?
        $is_updated_all = false;
        if ($count_unupdated <= 0) {
            $is_updated_all = true;
        }

        $TeachingHourStatus = HistoryTeachingHourStatus::class;
        return view('admin.history_teaching_hours.show', compact('history_teaching_hours', 'TeachingHourStatus', 'is_updated_all'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HistoryTeachingHours  $historyTeachingHours
     * @return \Illuminate\Http\Response
     */
    public function edit($teacher_id)
    {
        // Lấy ra thời gian hiện tại
        $current_time = date('Y-m-01');

        // Lấy ra giảng viên
        $teacher = Teacher::find($teacher_id);
    
        // Lấy ra giờ dạy của tháng
        $teaching_hours = HistoryTeachingHours::where('time', $current_time)
                                            ->where('teacher_id', $teacher_id)
                                            ->get()
                                            ->first();
        
        return view('admin.history_teaching_hours.edit', compact('teacher', 'teaching_hours'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HistoryTeachingHours  $historyTeachingHours
     * @return \Illuminate\Http\Response
     */
    public function update(updateRequest $request, $teacher_id)
    {
        // Lấy ra thời gian hiện tại
        $current_time = date('Y-m-01');

        // Lấy ra admin đang đăng nhập hiện tại
        $admin_id = Auth::user()->id;

        // Lấy ra thông tin từ request
        $total_hours = $request->validated();

        // Update lịch sử giảng dạy cho giảng viên
        $query = HistoryTeachingHours::where('time', $current_time)
                                    ->where('teacher_id', $total_hours['teacher_id']);
        
        
        $total_hours['time'] = $current_time;
        $total_hours['updated_by'] = $admin_id;
        $total_hours['status'] = 2;

        if ($query->update($total_hours)) {
            return redirect()->route('history_teaching_hours.show_by_month')->with('success','Update success!');
        } else {
            return redirect()->route('history_teaching_hours.show_by_month')->with('error','Update failed!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HistoryTeachingHours  $historyTeachingHours
     * @return \Illuminate\Http\Response
     */
    // public function destroy(HistoryTeachingHours $historyTeachingHours)
    // {
        
    // }
}
