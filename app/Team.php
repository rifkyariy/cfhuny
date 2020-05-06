<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    public function users()
    {
        return $this->belongsToMany('App\User')->withPivot('role','status')->withTimestamps();
    }

    public function proposals() {
        return $this->hasMany('App\Proposal');
    }
}
