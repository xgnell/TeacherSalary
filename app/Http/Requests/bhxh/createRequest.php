<?php

namespace App\Http\Requests\bhxh;

use Illuminate\Foundation\Http\FormRequest;

class createRequest extends FormRequest
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
            'teacher_id' => 'required|unique:bhxh',
            'total_value' => 'required|integer',
            'time' => 'required',
            
        ];
    }
}
