<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengabdian extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function pengabdian_dosen()
    {
        return $this->hasMany(PengabdianDosen::class, 'id_pengabdian', 'id');
    }

    public function pengabdian_mahasiswa()
    {
        return $this->hasMany(PengabdianMahasiswa::class, 'id_pengabdian', 'id');
    }

    public function scopeSearchAll(Builder $query, $search)
    {
        return $query->where(function ($query) use ($search) {
            $query->where('id', 'like', "%{$search}%")
                ->orWhere('judul', 'like', "%{$search}%")
                ->orWhere('tahun', 'like', "%{$search}%");
        });
    }
}
