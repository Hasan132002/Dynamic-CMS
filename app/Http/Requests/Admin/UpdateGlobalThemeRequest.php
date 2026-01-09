<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGlobalThemeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // you can add auth later
    }

    public function rules(): array
    {
        return [
            // JSON blocks come in as strings (we’ll decode in controller)
            'colors_json' => ['nullable', 'string'],
            'fonts_json'  => ['nullable', 'string'],
            'logos_json'  => ['nullable', 'string'],
            'images_json' => ['nullable', 'string'],
            'text_json'   => ['nullable', 'string'],

            // uploads (optional)
            'logo_files.*'  => ['nullable', 'file', 'mimes:svg,png,jpg,jpeg,webp', 'max:5120'],
            'image_files.*' => ['nullable', 'file', 'mimes:svg,png,jpg,jpeg,webp', 'max:5120'],
        ];
    }
}
