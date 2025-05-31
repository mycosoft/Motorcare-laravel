<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreBrandRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'logo' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'link' => ['nullable', 'url', 'max:255'],
        ];
    }
}
