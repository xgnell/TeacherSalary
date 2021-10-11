<?php

namespace App\Http\Controllers\Api;

use App\Constants\HistorySalaryStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\HistorySalary\createRequest;
use App\Models\HistoryKpi;
use App\Models\HistorySalary;
use App\Models\HistoryTeachingHours;
use App\Models\Major;
use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Models\Kpi;
use DateTime;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class HistorySalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      
        $history_salaries = HistorySalary::all()->where('status', 3)->groupBy('time');
        $HistorySalaryStatus = HistorySalaryStatus::class;
        return view('admin.history_salary.index', compact( 'history_salaries', 'HistorySalaryStatus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $search = $request->get('search');
        $major = Major::all();
        $current_time = date('Y-m-01');
        $formated_time = (new DateTime($current_time))->format("Y-m-01");

        $updated_history_salaries = DB::table('history_salary')
                            ->where('time', $formated_time);

        $teachers = array();
        $history_teaching_hours = HistoryTeachingHours::all();
        if ($history_teaching_hours) {
            foreach ($history_teaching_hours as $each) {
                $teacher = Teacher::leftJoinSub($updated_history_salaries, 'updated_teacher', function($join) {
                    $join->on('teacher.id', '=', 'updated_teacher.teacher_id');
                })->join('history_teaching_hours','history_teaching_hours.teacher_id','=','teacher.id')
                ->where('updated_teacher.teacher_id', null)
                ->where('history_teaching_hours.teacher_id', $each->teacher_id)
                ->where('history_teaching_hours.time',$current_time)
                    ->get();

                array_push($teachers,$teacher);
            }
        }
        // dd($teachers);
        $HistorySalaryStatus = HistorySalaryStatus::class;
        return view('admin.history_salary.create', compact('search', 'major', 'teachers', 'HistorySalaryStatus'));
    }
    public function add(Request $request)
    {
        $current_time = date('Y-m-01');
        $teacher_id = $request->teacher_id;
        $teacher = DB::select(DB::raw("select teacher.id, teacher.name,history_teaching_hours.total_hours,history_teaching_hours.total_overtime_hours,
                history_teaching_hours.status,history_teaching_hours.time,salary.salary_per_hour, salary.salary_overtime_per_hour,SUM(history_kpi.point) as total_kpi,
                (select SUM(insurance.value) from teacher_insurance join insurance
                on teacher_insurance.insurance_id = insurance.id WHERE teacher_insurance.teacher_id='$teacher_id')  as total_insurance,
                (select SUM(kpi.max_point)  from kpi) as total_point,
                (select salary_level.basic_salary from salary join salary_level on salary_level.level = salary.salary_level
                where salary.teacher_id = '$teacher_id') as salary_basic
                 from teacher 
                left join history_teaching_hours on history_teaching_hours.teacher_id = teacher.id
                left join salary on salary.teacher_id = teacher.id
                left join history_kpi on history_kpi.teacher_id = teacher.id
                where teacher.id ='$teacher_id' and history_teaching_hours.time = '$current_time' and history_kpi.time = '$current_time'
                group By teacher.id, teacher.name, history_teaching_hours.total_hours,history_teaching_hours.total_overtime_hours,
                history_teaching_hours.status,salary.salary_per_hour, salary.salary_overtime_per_hour,history_teaching_hours.time
                "));

        $timePaySalary = HistorySalary::select('time')->where('teacher_id',$teacher_id)->get();
        $historyKpi = HistoryKpi::select(DB::raw('DISTINCT(time)'))->where('teacher_id',$teacher_id)->get();

        $HistorySalaryStatus = HistorySalaryStatus::class;
        return response()->json([
            'teacher' => $teacher,
            'HistorySalaryStatus' => $HistorySalaryStatus,
            'timePaySalary'=>$timePaySalary,
            'historyKpi'=> $historyKpi,
        ]);
    }
    public function edit(Request $request)
    {
        $time = new DateTime($request->time);
         $t = $time->format('Y-m-01');
         $teacher_id= $request->teacher_id;
         $history_salaries = DB::select(DB::raw("
            select teacher.name,teacher.id,history_teaching_hours.*,history_salary.*,
            salary.*,(select SUM(insurance.value) from teacher_insurance join insurance
            on teacher_insurance.insurance_id = insurance.id WHERE teacher_insurance.teacher_id='$teacher_id')  as insurance
            from teacher join history_teaching_hours on history_teaching_hours.teacher_id = teacher.id
            join history_salary on history_salary.teacher_id = teacher.id
            join salary on salary.teacher_id = teacher.id 
            where history_salary.time = '$t' and history_salary.teacher_id = '$teacher_id';
         "));
        // $history_salaries = Teacher::
        // join('history_teaching_hours','history_teaching_hours.teacher_id','=','teacher.id')
        // ->join('history_salary','history_salary.teacher_id','=','teacher.id')
        // ->join('salary','salary.teacher_id','=','teacher.id')
        // ->where('history_salary.time', $t)->where('history_salary.teacher_id', $teacher_id)->first();
    
        return response()->json([
            'history_salaries' => $history_salaries,
        ]);
    }
    public function update(Request $request){
        $total_salary = $request->total_salary;
        $total_insurance= $request->total_insurance;
        $teacher_id = $request->teacher_id;
        $total_hours = $request->total_hours;
        $total_overtime_hours = $request->total_overtime_hours;
        $time = new DateTime($request->time);
       $t = $time->format('Y-m-01');
       try{
            DB::update('update history_teaching_hours set status = 2, total_hours = ?,total_overtime_hours=?
         where teacher_id = ? and time = ?', [$total_hours,$total_overtime_hours,$teacher_id,$t]);

        DB::update('update history_salary set status = 3, total_insurance = ?,total_salary=?
         where teacher_id = ? and time = ?', [$total_insurance,$total_salary,$teacher_id,$t]);
         return response()->json([
             'success' =>'Update SUCCESS!',
         ]);
       }catch(QueryException $e) {
        return response()->json([
            'error' =>'Update failed!',
        ]);
       }
      
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(createRequest $request)
    {
       $time = new DateTime($request->time);
       $t = $time->format('Y-m-01');
     
        $status = 3;
        
      
        $request->merge(['status' => $status,'time' => $t]);
        $data = $request->all();
        try{     
            HistorySalary::create($data);
            return response()->json([
                'success' => 'Trả Lương Tháng này thành công ',
            ]);
        
        }catch(QueryException $exception){
            return response()->json([
                'error' => 'Tháng này đã được thanh toán',
            ]);
        
        }
            
            

        
            
    }

    public function show_by_month(Request $request)
    {
        $history_salaries = HistorySalary::all()->where('status', 2)->groupBy('time');
        $HistorySalaryStatus = HistorySalaryStatus::class;

        return view('admin.history_salary.show', compact('history_salaries', 'HistorySalaryStatus'));
    }
    public function paid(Request $request){
        $teacher_id = $request->teacher_id;
        $time = new DateTime($request->time);
       $t = $time->format('Y-m-01');
       try{     
        DB::update('update history_salary set status = 4
        where teacher_id = ? and time = ?', [$teacher_id,$t]);
        return response()->json([
            'success' => 'PAYMENT SUCCESS',
        ]);
    
    }catch(QueryException $exception){
        return response()->json([
            'error' => 'PAYMENT FAILD',
        ]);
    
    }
    
    }
    public function showPaid(){
        $history_salaries = HistorySalary::all()->where('status', 4)->groupBy('time');
        $HistorySalaryStatus = HistorySalaryStatus::class;
        return view('admin.history_salary.showPaid', compact( 'history_salaries', 'HistorySalaryStatus'));
    }
}
// SELECT teacher.id, teacher.name,history_teaching_hours.total_hours,history_teaching_hours.total_overtime_hours,
// history_teaching_hours.status,salary.salary_per_hour, salary.salary_overtime_per_hour,SUM(history_kpi.point),
// (SELECT SUM(insurance.value) FROM teacher_insurance JOIN insurance
// ON teacher_insurance.insurance_id = insurance.id WHERE teacher_insurance.teacher_id=2) as total_insurance
//  FROM teacher 
// LEFT JOIN history_teaching_hours ON history_teaching_hours.teacher_id = teacher.id
// LEFT JOIN salary ON salary.teacher_id = teacher.id
// LEFT JOIN history_kpi on history_kpi.teacher_id = teacher.id
// WHERE teacher.id =2 AND MONTH(history_teaching_hours.time) =11;