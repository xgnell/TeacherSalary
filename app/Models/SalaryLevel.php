<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalaryLevel extends Model
{
    use HasFactory;
    protected $table = 'salary_level';
    public $primaryKey = 'level';
    protected $fillable = ['level', 'basic_salary'];
}
