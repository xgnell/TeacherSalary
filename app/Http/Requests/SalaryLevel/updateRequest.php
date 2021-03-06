<?php

namespace App\Http\Requests\SalaryLevel;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
            'level'=>[
                'required',
                Rule::unique('salary_level','level')->ignore($this->salary_level),
            ],
            'basic_salary'=> 'required'
        ];
    }
}
