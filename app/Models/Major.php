<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Major extends Model
{
    use HasFactory;
    protected $table = 'major';
    protected $fillable = ['name','slug','created_by'];

    public function teacher(){
        return $this->hasMany(Teacher::class,'major_id','id');
    }
    public function scopeSearch($query){
        if($search = request()->search){
            $query = $query->where('name','like',"%$search%");
            return $query;
        }
    }
}
