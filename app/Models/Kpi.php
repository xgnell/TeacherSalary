<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kpi extends Model
{
    use HasFactory;
    protected $table = 'kpi';
    protected $fillable =['month','teacher_id','criteria_id'];
    public function teacher(){
        return $this->hasMany(Teacher::class,'id','teacher_id');
    }
    public function criteria(){
        return $this->hasMany(Criteria::class,'id','criteria_id');
    }
    
}
