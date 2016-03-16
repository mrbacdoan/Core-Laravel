<?php


namespace App\IZee\Users;

use App\Http\Requests\Request;
use Log;

class UserFormRequest extends Request
{
    public function rules()
    {
        $rules = [
            'username'              => 'required|alpha_dash|min:4|max:255|unique:users',
            'email'                 => 'required|email|min:4|max:255|unique:users',
            'password'              => 'required|min:6',
            're_password'           => 'required|same:password',
            'full_name'             => 'required|max:255',
            'phone'                 => 'max:15|min:8',
            'address'               => 'max:255',
            'group_id'              => 'integer',
        ];

        if ($this->isMethod('PUT')) {
            $rules['username'] = 'required|alpha_dash|min:4|max:255|unique:users,username,'.$this->segment(3);
            $rules['email'] = 'required|email|min:4|max:255|unique:users,email,'.$this->segment(3);
            $rules['password'] = 'min:6';
            $rules['re_password'] = 'same:password';
        }

        if ($this->has('id')) {
            unset($rules['username']);
            unset($rules['email']);
        }
        return $rules;
    }


    /**
     * Set custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return trans('form.users');
    }
}