<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PengabdianMahasiswaRequest extends FormRequest
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
            'nim_mahasiswa' => 'required|exists:mahasiswas,nim',
            'id_pengabdian' => 'required|exists:pengabdians,id',
            'flag' => 'required|numeric|min:0',
        ];
    }
}
