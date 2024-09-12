<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PengabdianRequest extends FormRequest
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
            'no_sk' => 'required|string|max:255|unique:pengabdians,no_sk,' . ($this->pengabdian->id ?? null),
            'no_kontrak' => 'required|string|max:255|unique:pengabdians,no_kontrak,' . ($this->pengabdian->id ?? null),
            'judul' => 'required|string|max:255',
            'skema' => 'nullable|string|max:255',
            'tahun' => 'nullable|integer|digits:4|min:1900|max:' . date('Y'),
            'bidang' => 'nullable|string|max:255',
            'dana' => 'nullable|numeric|min:0',
            'sumber_dana' => 'nullable|in:Internal,Eksternal',
            'laporan_akhir' => 'nullable|string|max:255',
        ];
    }
}
