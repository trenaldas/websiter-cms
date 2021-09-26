<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BitThemeIndexRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'tag_id' => 'required|exists:tags,id',
        ];
    }
}
