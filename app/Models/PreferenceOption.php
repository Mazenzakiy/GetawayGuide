<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreferenceOption extends Model
{
    use HasFactory;

    protected $table = "preference_options";

    protected $guarded = ['id','created_at','updated_at'];

    public $timestamps = true;

    // PreferenceOption belongsto Preference
    public function preference()
    {
        return $this->belongsTo(Preference::class);
    }

    // PreferenceOption belongsto Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
