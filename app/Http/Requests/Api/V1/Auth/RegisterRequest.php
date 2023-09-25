<?php

namespace App\Http\Requests\Api\V1\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function validationData()
    {
        return array_merge($this->all(), [
            'registration_date' => now(),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'login'         => 'required|unique:users,login',
            'password'      => 'required|min:8',
            'name'          => 'required',
            'surname'       => 'required',
            'registration_date'       => 'required',
            'birth_date'    => '',
        ];
    }
}
