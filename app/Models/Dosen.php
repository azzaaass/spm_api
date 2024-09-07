<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    protected $guarded = [];

    protected $primaryKey = 'nip';
    public $incrementing = false;
    protected $keyType = 'int';
}