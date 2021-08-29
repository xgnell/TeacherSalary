<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalaryLevel extends Model
{
    use HasFactory;
    protected $table = 'salary_level';
    protected $fillable = ['name', 'criteria'];
}
