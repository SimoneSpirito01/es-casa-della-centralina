<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkGroup extends Model
{
    protected $table = 'work_groups';

    public function users() {
        return $this->belongsToMany("App\User");
    }

    public function categories() {
        return $this->belongsToMany("App\Category");
    }
}
