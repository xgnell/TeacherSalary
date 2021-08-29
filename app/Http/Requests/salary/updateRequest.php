<?php

namespace App\Http\Requests\salary;

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
            'salary_basic'=>'required|integer',
            'salary_per_hour'=>'required|integer',
            'salary_ot_per_hour'=>'required|integer',
            'salary_level_id'=>'required',
        ];
    }
}
