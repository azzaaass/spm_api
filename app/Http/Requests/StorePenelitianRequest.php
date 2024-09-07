<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePenelitianRequest extends FormRequest
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
            'judul' => 'required|string|max:255',
            'dana' => 'required|numeric|min:0',
            'tahun' => 'required|integer|digits:4|min:1900|max:' . date('Y'),
            'id_prodi' => 'required|exists:prodis,id',
            'publish' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
        ];
    }
}
