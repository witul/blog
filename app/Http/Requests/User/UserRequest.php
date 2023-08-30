<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        ];
    }
    protected function prepareForValidation(){

        $this->whenMissing('password_force',function(){
            $this->offsetUnset('password');
            $this->offsetUnset('password_confirmation');
            $this->merge(['password_force'=>0]);
        });
    }


}
