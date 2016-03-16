<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;

abstract class Request extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function response(array $errors)
    {
        if ($this->ajax() || $this->wantsJson() || $this->is(API_PREFIX . '/*')) {
            return new JsonResponse($errors, 422);
        }
        return $this->redirector->to($this->getRedirectUrl())
            ->withInput($this->except($this->dontFlash))
            ->withErrors($errors, $this->errorBag);
    }

}
