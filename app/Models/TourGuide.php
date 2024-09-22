<?php

namespace App\Models;

use App\Models\City\City;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourGuide extends Model
{
    use HasFactory;

    protected $table = "tour_guides";

    protected $guarded = ['id','created_at','updated_at'];

    public $timestamps = true;

    // tour guid belongsTo city
    public function city(){
        return $this->belongsTo(City::class);
    }
}
