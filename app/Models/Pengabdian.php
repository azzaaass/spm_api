<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengabdian extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // public function penelitian_dosen()
    // {
    //     return $this->hasMany(PenelitianDosen::class, 'id_penelitian', 'id');
    // }

    // public function penelitian_mahasiswa()
    // {
    //     return $this->hasMany(PenelitianMahasiswa::class, 'id_penelitian', 'id');
    // }

    public function scopeSearchAll(Builder $query, $search)
    {
        return $query->where(function ($query) use ($search) {
            $query->where('id', 'like', "%{$search}%")
                ->orWhere('judul', 'like', "%{$search}%")
                ->orWhere('tahun', 'like', "%{$search}%");
        });
    }
}
