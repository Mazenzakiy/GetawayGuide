<?php

namespace App\Models\Landmark;

use App\Models\Category;
use App\Models\City\City;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Landmark extends Model
{
    use HasFactory;

    protected $table = "landmarks";

    protected $fillable = [
        "city_id",
        "name",
        "desc",
        "video",
        "address",
    ];
    public $timestamps = true;


    // landmark belongsto city
    public function city(){
        return $this->belongsTo(City::class);
    }

    // landmark hasmany landmarkImages
    public function landmarkImages(){
        return $this->hasMany(LandmarksImages::class);
    }

    // landmark belongsToMany categories
    public function categories(){
        return $this->belongsToMany(Category::class,'landmark_category');
    }
}
