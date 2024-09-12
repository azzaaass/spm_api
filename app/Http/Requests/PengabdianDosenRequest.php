<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PengabdianDosenRequest extends FormRequest
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
            'nip_dosen' => 'required|exists:dosens,nip',
            'id_pengabdian' => 'required|exists:pengabdians,id',
            'flag' => 'required|numeric|min:0',
        ];
    }
}
