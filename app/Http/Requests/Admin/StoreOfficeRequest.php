<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreOfficeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->can('offices.create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'type' => 'required|in:branch,service_center,parts_center',
            'address' => 'required|string',
            'city' => 'required|string|max:255',
            'region' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'services' => 'nullable|array',
            'services.*' => 'string|max:255',
            'monday_friday' => 'nullable|string|max:255',
            'saturday' => 'nullable|string|max:255',
            'sunday' => 'nullable|string|max:255',
            'manager_name' => 'nullable|string|max:255',
            'manager_phone' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean'
        ];
    }

    /**
     * Get custom attributes for validator errors.
     */
    public function attributes(): array
    {
        return [
            'name' => 'office name',
            'type' => 'office type',
            'address' => 'address',
            'city' => 'city',
            'region' => 'region',
            'phone' => 'phone number',
            'email' => 'email address',
            'latitude' => 'latitude',
            'longitude' => 'longitude',
            'services' => 'services',
            'monday_friday' => 'Monday-Friday hours',
            'saturday' => 'Saturday hours',
            'sunday' => 'Sunday hours',
            'manager_name' => 'manager name',
            'manager_phone' => 'manager phone',
            'description' => 'description',
            'is_active' => 'status'
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'type.in' => 'The office type must be either Branch, Service Center, or Parts Center.',
            'latitude.between' => 'The latitude must be between -90 and 90 degrees.',
            'longitude.between' => 'The longitude must be between -180 and 180 degrees.',
        ];
    }
}
