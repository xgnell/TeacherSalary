<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kpi extends Model
{
    use HasFactory;

    protected $table = 'kpi';
    
    protected $fillable = [
        'criteria',
        'max_point',
    ];

    public function scopeSearch($query){
        if($search = request()->search){
            $query = $query->where('criteria','like',"%$search%");
            return $query;
        }
    }
}
