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
            'no_sk' => 'required|string|max:255',
            'no_kontrak' => 'required|string|max:255',
            'judul' => 'required|string|max:255',
            'skema' => 'required|string|max:255',
            'tahun' => 'required|integer|digits:4|min:1900|max:' . date('Y'),
            'bidang' => 'required|string|max:255',
            'dana' => 'required|numeric|min:0',
            'sumber_dana' => 'required|in:Internal,Eksternal',
        ];
    }
}