<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penelitian extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function penelitian_dosen()
    {
        return $this->hasMany(PenelitianDosen::class, 'id_penelitian', 'id');
    }

    public function penelitian_mahasiswa()
    {
        return $this->hasMany(PenelitianMahasiswa::class, 'id_penelitian', 'id');
    }

    public function scopeSearchAll(Builder $query, $search)
    {
        return $query->where(function ($query) use ($search) {
            $query->where('id', 'like', "%{$search}%")
                ->orWhere('judul', 'like', "%{$search}%")
                ->orWhere('tahun', 'like', "%{$search}%");
        });
    }

    // public function getKetua()
    // {
    //     if ($this->penelitian_dosen()->where('flag', '1')->exists()) {
    //         $penelitianDosen = $this->penelitian_dosen()->where('flag', '1')->first();
    //         return [
    //             "role" => "Dosen",
    //             "name" => $penelitianDosen->dosen->name,
    //             "prodi" => $penelitianDosen->dosen->prodi->name,
    //         ];
    //     }

    //     $penelitianMahasiswa = $this->penelitian_mahasiswa()->where('flag', '1')->with('mahasiswa')->first();
    //     return [
    //         "role" => "Dosen",
    //         "name" => $penelitianMahasiswa->mahasiswa->name,
    //         "prodi" => $penelitianMahasiswa->mahasiswa->prodi->name,
    //     ];
    // }

    public function scopeSearchKetua($query, $table, $operator, $search): mixed
    {
        return $query->where(function ($query) use ($table, $operator, $search) {
            // Cek ketua dari penelitian_dosen  
            $query
                ->whereHas('penelitian_dosen', function ($subQuery) use ($table, $operator, $search) {
                    $subQuery
                        ->where('flag', 1)
                        ->whereHas('dosen', function ($dosenQuery) use ($table, $operator, $search) {
                            $dosenQuery->where($table, $operator, $search);
                        });
                })
                // Atau cek ketua dari penelitian_mahasiswa
                ->orWhereHas('penelitian_mahasiswa', function ($subQuery) use ($table, $operator, $search) {
                    $subQuery
                        ->where('flag', 1)
                        ->whereHas('mahasiswa', function ($mahasiswaQuery) use ($table, $operator, $search) {
                            $mahasiswaQuery->where($table, $operator, $search);
                        });
                });
        });
    }
}
