<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Prestasi extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function prestasi_mahasiswa(){
        return $this->hasMany(PrestasiMahasiswa::class, 'id_prestasi', 'id');
    }

    public function scopeSearchAll(Builder $query, $search)
    {
        return $query->where(function ($query) use ($search) {
            $query->where('id', 'like', "%{$search}%")
                ->orWhere('nama_lomba', 'like', "%{$search}%")
                ->orWhere('juara', 'like', "%{$search}%");
        });
    }
}
