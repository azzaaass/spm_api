<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PenelitianResource extends JsonResource
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
            'judul' => $this->judul,
            'dana' => $this->dana,
            'tahun' => $this->tahun,
            'prodi' => $this->prodi,
            'dosen' => $this->penelitian_dosen,
            'mahasiswa' => $this->penelitian_mahasiswa,
            'publish' => $this->publish,
            'kategori' => $this->kategori,
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
        ];
    }
}
