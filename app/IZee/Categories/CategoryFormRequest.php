<?php

namespace App\IZee\Categories;


use App\Http\Requests\Request;

class CategoryFormRequest extends Request
{

    public function rules()
    {
        $rules = [
            
        ];
        if ($this->isMethod('PUT')) {
            
        }
        return $rules;
    }

}