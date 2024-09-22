<?php

namespace App\Models\Country;

use App\Models\City\City;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $table = "countries";

    protected $fillable = [

        "name",
        "population",
        "territory",
        "avg_price",
        "description",
        "image",
        "continent",

    ];

    public $timestamps = true;

    // country hasMany cities
    public function cities(){
        return $this->hasMany(City::class);
    }

}
