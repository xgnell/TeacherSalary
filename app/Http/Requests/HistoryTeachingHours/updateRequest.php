<?php

namespace App\Http\Requests\HistoryTeachingHours;

use Illuminate\Foundation\Http\FormRequest;

class updateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'teacher_id' => 'required|integer',
            'total_hours' => 'required|numeric',
            'total_overtime_hours' => 'required|numeric',
        ];
    }
}
