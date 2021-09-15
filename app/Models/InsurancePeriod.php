<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InsurancePeriod extends Model
{
    use HasFactory;

    protected $table = 'insurance_period';

    protected $fillable = [
        'name',
        'period',
    ];

    public function scopeSearch($query){
        if($search = request()->search){
            $query = $query->where('name','like',"%$search%");
            return $query;
        }
    }

}
