<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TeacherInsurance extends Model
{
    use HasFactory;

    protected $table = 'teacher_insurance';

    protected $fillable = [
        'insurance_id',
        'teacher_id',
    ];

    public function teacher() {
        return $this->hasOne(Teacher::class, 'id', 'teacher_id');
    }

    public function insurance() {
        return $this->hasOne(Insurance::class, 'id', 'insurance_id');
    }


    // Lấy ra số danh sách giảng viên chưa sử dụng loại bảo hiểm nào
    public static function getNotUseInsuranceTeachers() {
        $teachers = DB::table('teacher')
                        ->leftJoin('teacher_insurance', 'teacher_insurance.teacher_id', '=', 'teacher.id')
                        ->where('teacher_id', null)
                        ->get();
                        
        return $teachers;
    }
}
