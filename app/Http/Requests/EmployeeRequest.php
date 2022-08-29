<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
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
     * @return array<string, mixed> Request $request
     */
    public function rules()
    {

        return [
            'email' => 'required|email|max:255',
            'name' => 'required|string|max:255',
            'age' => 'required|numeric|integer|min:14|max:150',
            'work_experience' => 'required|numeric|integer|max:150',
            'photo' => 'nullable|string|max:255',
            'average_salary' => 'required|numeric|integer|max_digits:9'
        ];
    }
}
