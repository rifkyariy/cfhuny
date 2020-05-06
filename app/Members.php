<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Members extends Model
{
    protected $table = 'members';
    protected $fillable = [
        'name',
        'nim',
        'role',
        'ktm',
        'universitas',
        'prodi',
        'avatar',
        'email',
        'phone'
    ];
}
