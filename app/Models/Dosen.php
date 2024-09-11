<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    protected $guarded = [];

    protected $hidden = ['created_at', 'updated_at'];

    protected $primaryKey = 'nip';
    public $incrementing = false;
    protected $keyType = 'int';

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'id_prodi', 'id');
    }

    public function history_jabatan()
    {
        return $this->hasMany(HistoryJabatan::class, 'nip_dosen', 'nip');
    }
}