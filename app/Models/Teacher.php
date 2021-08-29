<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    protected $table = 'teacher';
    protected $fillable = ['first_name','last_name','address','phone','birthday','gender','teaching_formality','major_id','salary_id','status','image'];

    public function getNameTeacherAttribute(){
        return $this->first_name + ' ' + $this->last_name;
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
            $query = $query->where('name','like',"%$search%");
            return $query;
        }
    }
    
}
