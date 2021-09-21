<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Insurance extends Model
{
    use HasFactory;

    protected $table = 'insurance';

    protected $fillable = [
        'type',
        'value',
        'period_id',
        'mandatory',
    ];

    public function period(){
        return $this->hasOne(InsurancePeriod::class,'id','period_id');
    }

    public function scopeSearch($query){
        if($search = request()->search){
            $query = $query->where('type','like',"%$search%");
            return $query;
        }
    }
    public function getNameMandatoryAttribute(){
        if($this->mandatory == 0){
            return "không bắt buộc";
        }else{
            return "bắt buộc";
        }
    }
}
