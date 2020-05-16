<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PerguruanTinggi extends Model
{
    protected $table = 'ref_perguruantinggi';
    protected $fillable = [
        'id_npsn',
        'name',
        'lembaga',
        'kabupaten',
        'provinsi',
        'telepon',
        'email'
    ];
}