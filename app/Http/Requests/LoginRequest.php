<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'email'=>'exists:users|required|email',
            'password' => 'required'
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
            'email.exists'=>'این ایمیل قبلا ثبت نشده است',
            'email.required'=>'وارد کردن ایمیل اجباری ست',
            'email.email'=>'فرمت ایمیل اشتباه است',
            'password' =>'وارد کردن رمز عبور اجباری است',
        ];
    }
}
