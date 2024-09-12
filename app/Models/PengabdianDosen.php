<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengabdianDosen extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $hidden = ['id_penelitian', 'created_at', 'updated_at'];

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'nip_dosen', 'nip');
    }

    public function pengabdian ()
    {
        return $this->belongsTo(Pengabdian::class, 'id_pengabdian', 'id');
    }
}
