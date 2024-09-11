<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DosenRequest extends FormRequest
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
            'nip' => 'required|integer|digits_between:1,12|unique:dosens,nip',
            'nidn' => 'required|string|unique:dosens,nidn|max:255',
            'name' => 'required|string|max:255',
            'gelar_depan' => 'nullable|string|max:50',
            'gelar_belakang' => 'nullable|string|max:50',
            'pendidikan' => 'nullable|string|max:100',
            'kode_dosen' => 'nullable|string|max:10|unique:dosens,kode_dosen',
            'id_prodi' => 'required|exists:prodis,id',
        ];
    }
}
