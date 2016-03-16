<?php

/**
 * Created by Hoangnham
 * Date: 9/28/2015 3:06 PM
 */
namespace App\IZee\Users\Accounts;

use App\Http\Requests\Request;

class LoginFormRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email_or_username' => 'required',
            'password'          => 'required|min:6',
        ];
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