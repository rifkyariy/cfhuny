<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
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

    public function teams() {
        return $this->belongsToMany('App\Team')->withPivot('role')->withTimestamps();
    }
}
