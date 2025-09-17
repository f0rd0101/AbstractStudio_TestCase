<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
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
            'name' => ['string','required','max:50'],
            'email'=>['string','required','max:30','unique:users,email','email'],
            'password'=>['string','required','min:8','max:20'],
        ];
    }
    public function messages(): array
    {
      return [
           'name.required' => 'Name is required',
           'email.required' => 'Email is required',
           'password.required' => 'Password is required',
            'email.unique' => 'This email is already in use',
            'email.email' => 'Please enter a valid email address',
            'password.min'=> 'Password must be at least 8 characters',
      ];
    }
}
