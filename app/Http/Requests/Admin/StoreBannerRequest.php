<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreBannerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'page' => ['required', 'in:home,testimonial'],
            'title' => ['nullable', 'string', 'max:255'],
            'subtitle' => ['nullable', 'string', 'max:1000'],
            'background_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,avif,webp', 'max:5120'],
            'button_text' => ['nullable', 'string', 'max:100'],
            'button_url' => ['nullable', 'url:http,https', 'max:500'],
        ];
    }

    public function messages(): array
    {
        return [
            'background_image.image' => 'File harus berupa gambar.',
            'background_image.mimes' => 'Format gambar harus jpeg, png, jpg, avif, atau webp.',
            'background_image.max' => 'Ukuran gambar maksimal 5MB.',
        ];
    }
}