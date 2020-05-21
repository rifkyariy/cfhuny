<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    public function teams() {
        return $this->belongsTo('App\Team');
    }
}
