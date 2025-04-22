<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegistrationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'regex:/^[a-zA-Z\s]+$/', 'max:255'],
            'email' => [
                'required', 
                'string', 
                'email', 
                'max:255', 
                'unique:users,email'
            ],
            'contact_number' => ['required', 'string', 'regex:/^[0-9+\-\s]+$/', 'max:20'],
            'gender' => ['required', Rule::in(['male', 'female', 'other'])],
            'year' => ['required', 'integer', 'min:1', 'max:7'],
            'department_id' => ['required', 'exists:departments,id'],
            'college_id' => ['required', 'exists:colleges,id'],
            'country_id' => ['required', 'exists:countries,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.regex' => 'The name field can only contain letters and spaces.',
            'contact_number.regex' => 'The contact number can only contain numbers, plus sign, hyphens, and spaces.',
            'department_id.exists' => 'Please select a valid department.',
            'college_id.exists' => 'Please select a valid college.',
            'country_id.exists' => 'Please select a valid country.',
        ];
    }
}