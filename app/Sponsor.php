<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
    protected $fillable = ["level", "price", "duration", "badge"];

    public function apartments() {
        return $this->belongsToMany("App\Apartment")->withPivot('expires_at');
    }
}
