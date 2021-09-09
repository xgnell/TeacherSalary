<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kpi extends Model
{
    use HasFactory;
    protected $table = 'kpi';
    protected $fillable =['time','teacher_id','total_value'];
    protected $primaryKey = 'teacher_id';
    public $timestamps = false;
    public function teacher(){
        return $this->hasOne(Teacher::class,'id','teacher_id');
    }
    public function criteria(){
        return $this->hasMany(Criteria::class,'id','criteria_id');
    }
    
}
