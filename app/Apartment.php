<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Apartment extends Model
{
    use SoftDeletes;

    protected $fillable = [
        "name",
        "n_guests",
        "n_beds",
        "n_rooms",
        "n_bathrooms",
        "size",
        "cover_img",
        "visible",
        "province",
        "address",
        "price",
        'location',
        'cap'
    ];

    public function user()
    {
        return $this->belongsTo("App\User");
    }

    public function sponsors()
    {
        return $this->belongsToMany("App\Sponsor")->withPivot('expires_at');
    }

    public function services()
    {
        return $this->belongsToMany("App\Service");
    }

    public function messages()
    {
        return $this->hasMany("App\Message");
    }

    public function views()
    {
        return $this->hasMany("App\View");
    }

    public function images()
    {
        return $this->hasMany("App\Image");
    }
}
