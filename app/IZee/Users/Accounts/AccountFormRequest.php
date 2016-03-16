<?php

namespace App\IZee\Users\Accounts;


use App\Http\Requests\Request;

class AccountFormRequest extends Request
{

    public function rules()
    {
        $rules = [
            'username'              => 'required|alpha_dash|min:4|max:255|unique:admins',
            'email'                 => 'required|email|min:4|max:255|unique:admins',
            'full_name'             => 'required|max:255',
            'phone'                 => 'max:15|min:8',
            'address'               => 'max:255',
            'group_id'              => 'required|integer',
            'department_id'         => 'required|integer',
            'status'                => 'required|integer'
        ];
        if ($this->isMethod('PUT')) {
            unset($rules['username']);
            unset($rules['email']);
        }
        if ($this->has('id')) {
            unset($rules['username']);
            unset($rules['email']);
        }
        return $rules;
    }

}