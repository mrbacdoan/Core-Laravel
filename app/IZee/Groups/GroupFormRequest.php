<?php

namespace App\IZee\Groups;


use App\Http\Requests\Request;

class GroupFormRequest extends Request
{

    public function rules()
    {
        $rules = ['name' => 'required|max:255|unique:groups'];

        if ($this->isMethod('PUT')) {
            $rules = ['name' => 'required|max:255|unique:groups,id,' . $this->input('group_id')];
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
        return trans('form.groups');
    }

}