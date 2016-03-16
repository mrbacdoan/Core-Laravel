<?php
/**
 * Created by Hoangnham
 * Date: 10/1/2015 4:39 PM
 */

namespace App\IZee\Users\Accounts;

use App\Http\Requests\Request;

class ProfileFormRequest extends Request
{
    public function rules()
    {
        $rules = [
            'full_name' => 'required|max:255',
            'phone'     => 'required|max:15|min:8',
            'address'   => 'required|max:255',
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