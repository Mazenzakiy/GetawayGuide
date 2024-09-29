<?php

namespace App\Models\City;

use App\Models\Country\Country;
use App\Models\Landmark\Landmark;
use App\Models\TourGuide;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{

    use HasFactory;

    protected $table = "cities";

    protected $fillable = [
        "name",
        "image",
        "price",
        "num_days",
        "video", // إضافة الفيديو


        "country_id",
    ];

    public $timestamps = true;

    // city belogsTo country
    public function country(){
        return $this->belongsTo(Country::class);
    }

    // city hasmany landmarks
    public function landmarks(){
        return $this->hasMany(Landmark::class);
    }

    // city hasmany tourGuides
    public function tourGuides(){
        return $this->hasMany(TourGuide::class);
    }
}
