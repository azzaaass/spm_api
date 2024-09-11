<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $guarded = [''];

    protected $hidden = ['created_at', 'updated_at'];

    protected $primaryKey = 'nim';
    public $incrementing = false;
    protected $keyType = 'int';
    
    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'id_prodi', 'id');
    }
}
