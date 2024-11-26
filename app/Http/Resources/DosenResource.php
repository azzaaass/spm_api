<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DosenResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'nip' => $this->nip,
            'nidn' => $this->nidn,
            'name' => $this->name,
            'status' => $this->status,
            'gelar_depan' => $this->gelar_depan,
            'gelar_belakang' => $this->gelar_belakang,
            'pendidikan' => $this->pendidikan,
            'kode_dosen' => $this->kode_dosen,
            'id_prodi' => $this->id_prodi,
            'prodi' => $this->prodi,
            'history_jabatan' => $this->history_jabatan,
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
        ];
    }
}
