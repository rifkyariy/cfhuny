<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CabangLomba extends Model
{
    protected $table = 'ref_cabanglomba';
    protected $fillable = [
        'id',
        'name',
        'desc',
        'kategori'
    ];
}