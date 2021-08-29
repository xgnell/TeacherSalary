<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    use HasFactory;
    protected $table ='salary';
    protected $fillable = ['salary_level_id','salary_basic','salary_per_hour','salary_ot_per_hour'];

    public function teacher(){
        return $this->hasMany(Teacher::class,'salary_id','id');
    }
    public function salary_level(){
        return $this->hasOne(SalaryLevel::class,'id','salary_level_id');
    }
}
