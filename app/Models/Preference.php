<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Preference extends Model
{
    use HasFactory;

    protected $table = "preferences";

    protected $guarded = ['id','created_at','updated_at'];

    public $timestamps = true;

    // preference hasmany PreferenceOption
    public function options()
    {
        return $this->hasMany(PreferenceOption::class);
    }
}
