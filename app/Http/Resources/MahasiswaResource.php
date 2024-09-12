<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MahasiswaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'nim' => $this->nim,
            'name' => $this->name,
            'angkatan' => $this->angkatan,
            'id_prodi' => $this->id_prodi,
            'prodi' => $this->prodi,
        ];
    }
}
