<?php

namespace App\Http\Requests\Teacher;

use Illuminate\Foundation\Http\FormRequest;
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
            'name'=>'required',
            'birthday'=>'required',
            'gender'=>'required',
            'address'=>'required|max:255|min:1',
            'phone'=>'required|min:8|max:13',
            'status'=>'required',
            'phone'=>[
                'required',
                'max:50',
                Rule::unique('teacher','phone')->ignore($this->phone),
            ],
        ];
    }
}
