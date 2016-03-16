<?php
/**
 * Created by Hoangnham
 * Date: 10/1/2015 4:40 PM
 */

namespace App\IZee\Users\Accounts;

use App\Http\Requests\Request;

class ChangePasswordFormRequest extends Request
{
    public function rules()
    {
        $rules = [
            'old_password'          => 'required',
            'new_password'          => 'required|min:6',
            'password_confirmation' => 'required|same:new_password',
        ];
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