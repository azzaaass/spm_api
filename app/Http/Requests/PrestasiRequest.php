<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PrestasiRequest extends FormRequest
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
        return [
            'nama_lomba' => 'nullable|string|max:255',
            'juara' => 'nullable|string|max:100',
            'url_foto' => 'nullable|url|max:255',
            'url_sertifikat' => 'nullable|url|max:255',
        ];
    }
}
