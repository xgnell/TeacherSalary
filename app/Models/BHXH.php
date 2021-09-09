<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BHXH extends Model
{
    use HasFactory;
    protected $table='bhxh';
    protected $fillable =['teacher_id','total_value','time'];
    protected $primaryKey = 'teacher_id';
    public function teacher(){
        return $this->hasOne(Teacher::class,'id','teacher_id');
    }
    public function scopeSearch($query){
        if($search = request()->search){
            $query = $query->where('thang','like',"%$search%");
            return $query;
        }
    }
}
