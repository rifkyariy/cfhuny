<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    public function members()
    {
        return $this->belongsToMany('App\Member')->withPivot('role')->withTimestamps();
    }

    public function submissions() {
        return $this->hasMany('App\Submission');
    }
}
