<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PengabdianDosenResource extends JsonResource
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
            'id_pengabdian' => $this->id_pengabdian,
            'pengabdian' => $this->pengabdian,
            'flag' => $this->flag,
        ];
    }
}
