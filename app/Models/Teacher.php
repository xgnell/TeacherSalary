<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    protected $table = 'teacher';
    protected $fillable = ['first_name','last_name','email','password','address','phone','birthday','gender','teaching_formality','major_id','salary_id','status','image'];

    public function major(){
        return $this->hasOne(Major::class,'id','major_id');
    }
    public function salary(){
        return $this->hasOne(Salary::class,'id','salary_id');
    }
    public function bhxh(){
        return $this->hasOne(BHXH::class,'teacher_id','id');
    }
    public function kpi(){
        return $this->hasOne(Kpi::class,'teacher_id','id');
    }

    public function getGenderNameAttribute(){
        if($this->gender==1){
            return "male";
        }else{
            return "female";
        }
    }
    public function scopeSearch($query){
        if($search = request()->search){
            $query = $query->where('last_name','like',"%$search%");
            return $query;
        }
    }
    
}
