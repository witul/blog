<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
        return [
            'name' => 'string|between:3,15',
            'email' => 'required|email|unique:users',
            'password' => 'required_if:password_force,1|min:8|confirmed',
            'password_force' => 'boolean'
        ];
    }

    protected function prepareForValidation()
    {

        $this->whenMissing('password_force', function () {
            $this->offsetUnset('password');
            $this->offsetUnset('password_confirmation');
            $this->merge(['password_force' => 0]);
        });
    }

}
