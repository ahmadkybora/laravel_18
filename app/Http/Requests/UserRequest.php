<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        switch($this->method())
        {
           // case 'GET':
             //   return [
             //       'id' => ['bail', 'required', 'exists:users'],
             //   ];
            //break;

            case 'POST':
                return [
                    'first_name' => ['bail', 'required', 'string', 'min:3', 'max:25'],
                    'last_name' => ['bail', 'required', 'string', 'min:3', 'max:25'],
                    'username' => ['bail', 'required', 'string', 'unique:users', 'min:3', 'max:25'],
                    'email' => ['bail', 'required', 'email', 'unique:users'],
                    'password' => ['bail', 'string', 'confirmed', 'min:8', 'max:25'],
                    'mobile' => ['bail', 'string', 'required', 'unique:users', 'digits:11'],
                    'home_phone' => ['bail', 'string', 'required', 'min:11', 'max:15'],
                    'work_phone' => ['bail', 'string', 'required', 'min:11', 'max:15'],
                    'work_address' => ['bail', 'string', 'required', 'min:5', 'max:300'],
                    'home_address' => ['bail', 'string', 'required', 'min:5', 'max:300'],
                    //'image' => ['bail', 'string'],
                ];
            break;

            case 'PATCH':
                //dd($this->request->all());
                return [
                    'first_name' => ['bail', 'required', 'string', 'min:3', 'max:25'],
                    'last_name' => ['bail', 'required', 'string', 'min:3', 'max:25'],
                    'home_phone' => ['bail', 'nullable', 'string', 'min:11', 'max:15'],
                    'work_phone' => ['bail', 'nullable', 'string', 'min:11', 'max:15'],
                    'work_address' => ['bail', 'nullable', 'string', 'min:5', 'max:300'],
                    'home_address' => ['bail', 'nullable', 'string', 'min:5', 'max:300'],
                    //'image' => ['bail', 'string'],
                ];
            break;
        }
    }
}
