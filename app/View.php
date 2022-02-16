<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class View extends Model
{
    protected $fillable = ["ip"];

    public function apartment() {
        return $this->belongsTo("App\Apartment");
    }
}
