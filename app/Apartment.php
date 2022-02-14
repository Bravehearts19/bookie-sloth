<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    protected $fillable = [
        "name",
        "n_guests",
        "n_beds",
        "n_rooms",
        "n_bathrooms",
        "size",
        "x_coordinate",
        "y_coordinate",
        "cover_img",
        "visible",
        "province",
        "address"
    ];

    public function user() {
        return $this->belongsTo("App\User");
    }

    public function sponsors() {
        return $this->belongsToMany("App\Sponsor");
    }

    public function services() {
        return $this->belongsToMany("App\Service");
    }

    public function messages() {
        return $this->hasMany("App\Message");
    }

    public function views() {
        return $this->hasMany("App\View");
    }

    public function images() {
        return $this->hasMany("App\Image");
    }
}
