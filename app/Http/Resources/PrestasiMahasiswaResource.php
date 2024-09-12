<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PrestasiMahasiswaResource extends JsonResource
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
            'id_prestasi' => $this->id_prestasi,
            'prestasi' => $this->prestasi,
            'flag' => $this->flag,
        ];
    }
}
