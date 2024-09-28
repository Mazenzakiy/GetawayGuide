<?php

namespace App\Models;

use App\Models\Landmark\Landmark;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;


    protected $table = "categories";

    protected $guarded = ['id','created_at','updated_at'];

    public $timestamps = true;

    // category belongsToMany landmarks
    public function landmarks()
    {
        return $this->belongsToMany(Landmark::class, 'landmark_category');
    }

    // category hasMany preferenceOptions
    public function preferenceOptions()
    {
        return $this->hasMany(related: PreferenceOption::class);
    }

}
