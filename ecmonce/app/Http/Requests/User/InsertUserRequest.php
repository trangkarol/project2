<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class InsertUserRequest extends FormRequest
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
            'name' => 'required|max:255|min:6',
            'email' => 'required|email|unique:users',
            'birthday' => 'required',
            'address' => 'max:255|min:6',
            'phone_number' => 'max:12|min:12',
        ];
    }

    /**
     * messages
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => trans('user.msg.name-required'),
            'name.max' => trans('user.msg.name-max'),
            'name.min' => trans('user.msg.name-min'),
            'email.required' => trans('user.msg.email-required'),
            'email.unique' => trans('user.msg.email-unique'),
            'email.email' => trans('user.msg.email-email'),
            'birthday.required' => trans('user.msg.birthday-required'),
            'address.max' => trans('user.msg.address-max'),
            'address.min' => trans('user.msg.address-min'),
            'phone_number.max' => trans('user.msg.phone_number-max'),
            'phone_number.min' => trans('user.msg.phone_number-min'),
            // 'phone_number.integer' => trans('user.msg.name-integer'),
        ];
    }
}
