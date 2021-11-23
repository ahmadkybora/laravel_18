<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

class AuthRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        switch($this->method()) {
            case 'POST':
                if(Route::currentRouteName() == 'login')
                    return [
                        'username' => ['required', 'string', 'min:2', 'max:25'],
                        'password' => ['required', 'string', 'min:8', 'max:15'],
                    ];
                
                if(Route::currentRouteName() == 'register')
                    return [
                        'first_name' => ['bail', 'required', 'string', 'min:3', 'max:25'],
                        'last_name' => ['bail', 'required', 'string', 'min:3', 'max:25'],
                        'username' => ['bail', 'required', 'string', 'unique:users', 'min:3', 'max:25'],
                        'email' => ['bail', 'required', 'email', 'unique:users'],
                        'password' => ['bail', 'string', 'confirmed', 'min:8', 'max:25'],
                        'mobile' => ['bail', 'string', 'required', 'unique:users', 'digits:11'],
                        'home_phone' => ['bail', 'string', 'required', 'digits:15'],
                        'work_phone' => ['bail', 'string', 'required', 'digits:15'],
                        'work_address' => ['bail', 'string', 'required', 'min:5', 'max:300'],
                        'home_address' => ['bail', 'string', 'required', 'min:5', 'max:300'],
                    ];
            break;
        }
    }

    // public function messages()
    // {
    //     if(Route::currentRouteName() == 'login')
    //         return [
    //             'username.required' => ['your data is incorrect'],
    //             'password.required' => ['your data is incorrect']
    //         ];
    // }
}
