<?php

namespace App\Exports\Teacher;

use App\Models\Teacher;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class TeacherExcelExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function collection()
    {
        return Teacher::select('teacher.id','teacher.name','teacher.email','teacher.phone','teacher.birthday','teacher.address','major.name as nameMajor')
        ->join('major', 'major.id', '=', 'teacher.major_id')->orderBy('major.name', 'asc')->get();
    }
    public function headings(): array
    {
        return [
            'teacher id',
            'name',
            'email',
            'phone',
            'birthday',
            'address',
            'nameMajor'
        ];
    }
}
