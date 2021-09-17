<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorySalary extends Model
{
    use HasFactory;

    protected $table = 'history_salary';
    public $timestamps = false;
    protected $primaryKey = 'teacher_id';
    protected $fillable =['teacher_id','time','total_salary','total_teaching_hours','total_ot_hours','status','created_by','bhxh'];
    public function teacher(){
        return $this->hasOne(Teacher::class,'id','teacher_id');
    }
    public function scopeSearch($query){
        if($search = request()->search){
            $query = $query->where('last_name','like',"%$search%");
            return $query;
        }
    }
}
