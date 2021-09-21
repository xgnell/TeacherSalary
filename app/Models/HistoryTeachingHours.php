<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class HistoryTeachingHours extends Model
{
    use HasFactory;

    protected $table = 'history_teaching_hours';

    protected $fillable = [
        'time',
        'teacher_id',
        'total_hours',
        'total_overtime_hours',
        'status',
        'updated_by',
    ];

    public function teacher() {
        return $this->hasOne(Teacher::class, 'id', 'teacher_id');
    }

    public function updated_admin() {
        return $this->hasOne(Admin::class, 'id', 'updated_by');
    }



    // Lấy ra danh sách tất cả giảng viên đã được update giờ dạy của 1 tháng
    public static function getUpdatedTeachingHoursOfMonth($time) {
        $formated_time = (new DateTime($time))->format("Y-m-01");

        $history_teaching_hours = HistoryTeachingHours::where('time', $formated_time)->get();
        return $history_teaching_hours;
    }

    // Lấy ra số danh sách giảng viên chưa được update giờ dạy của 1 tháng
    public static function getUnupdatedTeachingHoursOfMonth($time) {
        $formated_time = (new DateTime($time))->format("Y-m-01");

        $updated_teaching_hours_query = DB::table('history_teaching_hours')
                            ->where('time', $formated_time);

        $unupdated_teaching_hours_query = DB::table('teacher')
                            ->leftJoinSub($updated_teaching_hours_query, 'updated_teacher', function($join) {
                                $join->on('teacher.id', '=', 'updated_teacher.teacher_id');
                            })
                            ->where('teacher_id', null);

        return $unupdated_teaching_hours_query->get();
    }
}
