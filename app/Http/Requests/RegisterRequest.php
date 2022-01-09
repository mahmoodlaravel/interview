<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
        return [
            'email'=>'email|required|unique:users',
            'name' =>'required',
            'password' =>'required|min:8'
        ];
    }

    /**
     * Get the message of every validation.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.required'=>'وارد کردن ایمیل اجباری ست',
            'email.email'=>'فرمت ایمیل اشتباه است',
            'email.unique'=>'این ایمیل قبلا وارد شده است'
        ];
    }
}
