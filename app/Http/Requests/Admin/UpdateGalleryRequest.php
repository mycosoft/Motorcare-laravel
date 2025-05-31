<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGalleryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $id = $this->gallery->id ?? $this->route('gallery');
        return [
            'category_id' => 'required|exists:gallery_categories,id',
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:galleries,slug,' . $id,
            'description' => 'nullable|string',
            'images.*' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
        ];
    }
}
