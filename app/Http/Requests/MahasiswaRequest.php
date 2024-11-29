<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MahasiswaRequest extends FormRequest
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
        if ($this->method() === 'POST') {
            return [
                'nim' => 'required|integer|digits_between:1,12|unique:mahasiswas,nim',
                'name' => 'required|string|max:255',
                'angkatan' => 'required|integer|digits:4',
                'id_prodi' => 'required|exists:prodis,id',
            ];
        } else {
            $mahasiswaNim = $this->mahasiswa->nim ?? null;
            return [
                'nim' => [
                    'required',
                    'integer',
                    'digits_between:1,12',
                    Rule::unique('mahasiswas', 'nim')->ignore($mahasiswaNim, 'nim')
                ],
                'name' => 'required|string|max:255',
                'angkatan' => 'required|integer|digits:4',
                'id_prodi' => 'required|exists:prodis,id',
            ];

        }
    }
}
