<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PengabdianResource extends JsonResource
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
            'no_sk' => $this->no_sk,
            'no_kontrak' => $this->no_kontrak,
            'judul' => $this->judul,
            'skema' => $this->skema,
            'tahun' => $this->tahun,
            'bidang' => $this->bidang,
            'dana' => $this->dana,
            'sumber_dana' => $this->sumber_dana,
            'laporan_akhir' => $this->laporan_akhir,
            'dosen' => $this->penelitian_dosen,
            'mahasiswa' => $this->penelitian_mahasiswa,
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
        ];
    }
}
