<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminQueryStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name'    => 'required|string|min:3|max:25',
            'email'   => 'required|string|min:3|max:50',
            'message' => 'required|string|min:10|max:500',
        ];
    }
}
