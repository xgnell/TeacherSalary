<?php

namespace App\Http\Requests\Major;

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
            // 'name'=>'required|max:50|unique:major,name,'.request()->major,
            
            'name'=>[
                'required',
                'max:50',
                Rule::unique('major','name')->ignore($this->major),
            ],
            'slug'=>'required',
        ];
    }
}
