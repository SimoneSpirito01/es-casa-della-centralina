<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function interventions() {
        return $this->hasMany("App\Intervention");
    }

    public function workGroups() {
        return $this->hasMany("App\WorkGroup");
    }
}
