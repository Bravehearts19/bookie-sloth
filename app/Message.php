<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ["message","name","email","apartment_id"];

    public function apartment() {
        return $this->belongsTo("App\Apartment");
    }
}
