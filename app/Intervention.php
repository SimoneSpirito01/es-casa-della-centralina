<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Intervention extends Model
{
    public function user() {
        return $this->belongsTo("App\User");
    }

    public function category() {
        return $this->belongsTo("App\Category");
    }

    public function workshop() {
        return $this->belongsTo("App\Workshop");
    }
}
