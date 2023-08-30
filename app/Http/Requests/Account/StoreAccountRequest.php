<?php

namespace App\Http\Requests\Account;



class StoreAccountRequest extends AccountRequest
{

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'name'=>'string|between:3,15',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed'
            //
        ];
    }
    //public function
}
