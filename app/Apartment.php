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

    
}
