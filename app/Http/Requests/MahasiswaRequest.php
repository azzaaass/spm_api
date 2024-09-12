<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MahasiswaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nim' => 'required|integer|digits_between:1,12|unique:mahasiswas,nim,' . ($this->mahasiswa->id ?? null),
            'name' => 'required|string|max:255',
            'angkatan' => 'required|integer|digits:4',
            'id_prodi' => 'required|exists:prodis,id',
        ];
    }
}
