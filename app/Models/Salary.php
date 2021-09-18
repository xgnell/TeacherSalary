<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    use HasFactory;
    protected $table ='salary';
    public $primaryKey = 'teacher_id';
    protected $fillable = ['teacher_id','salary_level','salary_per_hour','salary_overtime_per_hour','updated_by'];

    public function teacher(){
        return $this->hasOne(Teacher::class,'id','teacher_id');
    }
    public function salary_level(){
        return $this->hasOne(SalaryLevel::class,'level','salary_level');
    }
    public function admin(){
        return $this->hasOne(Admin::class,'id','updated_by');
    }
    public function scopeSearch($query){
        if($search = request()->search){
            $query = $query->join('teacher','teacher.id','=','salary.teacher_id')->where('name','like',"%$search%");
            return $query;
        }
    }
}
