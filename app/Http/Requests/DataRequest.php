<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DataRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'=>['string','required','max:255'],
            'email'=>['string','required','email']
        ];
    }
    public function messages(): array
    {
          return[
             'name.required'=> 'Name is required',
             'email.required'=> 'Email is required',
             'email.email' => 'Please enter a valid email address',
          ];
    }
}
