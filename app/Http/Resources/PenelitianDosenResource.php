<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PenelitianDosenResource extends JsonResource
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
            'nip_dosen' => $this->nip_dosen,
            'dosen' => $this->dosen,
            'id_penelitian' => $this->id_penelitian,
            'penelitian' => $this->penelitian,
            'flag' => $this->flag,
        ];
    }
}