<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class HistoryKpi extends Model
{
    use HasFactory;

    protected $table = 'history_kpi';

    protected $fillable = [
        'time',
        'teacher_id',
        'criteria_id',
        'point',
    ];

    public function teacher() {
        return $this->hasOne(Teacher::class, 'id', 'teacher_id');
    }

    public function criteria() {
        return $this->hasOne(Kpi::class, 'id', 'criteria_id');
    }

    public function updated_admin() {
        return $this->hasOne(Admin::class, 'id', 'updated_by');
    }




    // Lấy ra danh sách tất cả giảng viên đã được update kpi của 1 tháng
    public static function getUpdatedKpisOfMonth($time) {
        $formated_time = (new DateTime($time))->format("Y-m-01");

        $history_kpis = HistoryKpi::where('time', $formated_time)->get()->groupBy('teacher_id');
        return $history_kpis;
    }

    // Lấy ra số danh sách giảng viên chưa được update kpi của 1 tháng
    public static function getUnupdatedKpisOfMonth($time) {
        $formated_time = (new DateTime($time))->format("Y-m-01");

        $updated_kpis_query = DB::table('history_kpi')
                            ->where('time', $formated_time);

        $unupdated_kpis_query = DB::table('teacher')
                            ->leftJoinSub($updated_kpis_query, 'updated_teacher', function($join) {
                                $join->on('teacher.id', '=', 'updated_teacher.teacher_id');
                            })
                            ->where('teacher_id', null);

        return $unupdated_kpis_query->get();
    }
}
