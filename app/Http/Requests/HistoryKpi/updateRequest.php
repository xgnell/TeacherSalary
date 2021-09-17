<?php

namespace App\Http\Requests\HistoryKpi;

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
            'time' => 'required|date',
            'teacher_id' => 'required|integer',
            'criteria_id' => 'required|integer',
            'point' => 'required|integer',
        ];
    }
}
