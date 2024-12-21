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

    public function scopeSearchKetua($query, $table, $operator, $search): mixed
    {
        return $query->where(function ($query) use ($table, $operator, $search) {
            // Cek ketua dari pengabdian_dosen  
            $query
                ->whereHas('pengabdian_dosen', function ($subQuery) use ($table, $operator, $search) {
                    $subQuery
                        ->where('flag', 1)
                        ->whereHas('dosen', function ($dosenQuery) use ($table, $operator, $search) {
                            $dosenQuery->where($table, $operator, $search);
                        });
                })
                // Atau cek ketua dari pengabdian_mahasiswa
                ->orWhereHas('pengabdian_mahasiswa', function ($subQuery) use ($table, $operator, $search) {
                    $subQuery
                        ->where('flag', 1)
                        ->whereHas('mahasiswa', function ($mahasiswaQuery) use ($table, $operator, $search) {
                            $mahasiswaQuery->where($table, $operator, $search);
                        });
                });
        });
    }
}
