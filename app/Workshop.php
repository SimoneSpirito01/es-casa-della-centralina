<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Workshop extends Model
{
    public function users() {
        return $this->hasMany("App\User");
    }

    public function interventions() {
        return $this->hasMany("App\Intervention");
    }

    
}
