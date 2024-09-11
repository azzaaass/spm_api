<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenelitianMahasiswa extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $hidden = ['id_penelitian', 'created_at', 'updated_at'];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'nim_mahasiswa', 'nim');
    }

    public function penelitian()
    {
        return $this->belongsTo(Penelitian::class, 'id_penelitian', 'id');
    }
}
