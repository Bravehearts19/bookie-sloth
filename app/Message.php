<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use SoftDeletes;

    protected $fillable = ["message", "name", "email", "apartment_id"];

    public function apartment()
    {
        return $this->belongsTo("App\Apartment");
    }
}
