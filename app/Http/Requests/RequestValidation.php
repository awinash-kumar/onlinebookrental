<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestValidation extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        // dd('hhh');
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'address' => 'nullable|string|max:255',
            'mobile' => 'required|nullable|string|min:10',
            'password' => 'required|string|min:8',
            'password_confirmation' => 'required|same:password',
        ];
    }
}
