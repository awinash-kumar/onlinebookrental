<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestValidations extends FormRequest
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
            'name' => 'required|string|alpha | max:255',
            'email' => 'required|email',
            'address' => 'nullable|string|max:255',
            'mobile' => 'required|nullable|string|between:10,12',
            
        ];
    }
}
