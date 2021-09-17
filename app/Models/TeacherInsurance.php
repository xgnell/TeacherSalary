<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
