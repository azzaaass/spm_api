<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrestasiMahasiswa extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $hidden = ['id_penelitian', 'created_at', 'updated_at'];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'nim_mahasiswa', 'nim');
    }

    public function prestasi()
    {
        return $this->belongsTo(Prestasi::class, 'id_prestasi', 'id');
    }
}
