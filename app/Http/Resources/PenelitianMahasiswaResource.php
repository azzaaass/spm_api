<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PenelitianMahasiswaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nim_mahasiswa' => $this->nim_mahasiswa,
            'mahasiswa' => $this->mahasiswa,
            'id_penelitian' => $this->id_penelitian,
            'penelitian' => $this->penelitian,
            'flag' => $this->flag,
        ];
    }
}