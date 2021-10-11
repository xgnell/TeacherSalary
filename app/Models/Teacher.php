<?php

namespace App\Models;

use DateTime;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

class Teacher extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'teacher';

    protected $fillable = [
        'image',
        'name',
        'email',
        'phone',
        'password',
        'address',
        'birthday',
        'gender',
        'major_id',
        'status',
    ];

    public function major(){
        return $this->hasOne(Major::class,'id','major_id');
    }
    public function salary(){
        return $this->hasOne(Salary::class,'teacher_id','id');
    }
    public function history_teaching_hours(){
        return $this->hasOne(HistoryTeachingHours::class,'teacher_id','id');
    }
    public function history_salary(){
        return $this->hasOne(HistorySalary::class,'teacher_id','id');
    }
    public function history_kpi(){
        return $this->hasMany(HistoryKpi::class,'teacher_id','id');
    }

    public function scopeSearch($query){
        if($search = request()->search){
            $query = $query->where('name','like',"%$search%");
            return $query;
        }
    }
    public function getGenderNameAttribute(){
        if($this->gender == 1){
            return "male";
        }else{
            return "female";
        }
    }

    public static function getUnupdatedHistorySalary($time) {
        $formated_time = (new DateTime($time))->format("Y-m-01");

        $updated_history_salaries = DB::table('history_salary')
                            ->where('time', $formated_time);

        $unupdated_history_salaries = DB::table('teacher')
                            ->leftJoinSub($updated_history_salaries, 'updated_teacher', function($join) {
                                $join->on('teacher.id', '=', 'updated_teacher.teacher_id');
                            })
                            ->where('teacher_id', null);

        return $unupdated_history_salaries;
    }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
}
