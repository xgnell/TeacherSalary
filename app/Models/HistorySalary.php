<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorySalary extends Model
{
    use HasFactory;

    protected $table = 'history_salary';
    
    protected $fillable = [
        'time',
        'teacher_id',
        'basic_salary',
        'salary_per_hour',
        'salary_overtime_per_hour',
        'total_insurance',
        'total_kpi',
        'total_salary',
        'status'
    ];
    
    public function teacher(){
        return $this->hasOne(Teacher::class,'id','teacher_id');
    }

    public function scopeSearch($query){
        if($search = request()->search){
            $query = $query->where('name','like',"%$search%");
            return $query;
        }
    }


}
