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
        "mainImage",  // تأكد من إضافة mainImage إلى الحقول القابلة للتعبئة إذا كنت تريد استخدامه
    ];

    public $timestamps = true;

    // العلاقة مع جدول المدن
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    // العلاقة مع جدول الصور (hasMany)
    public function images()
    {
        return $this->hasMany(LandmarksImages::class, 'landmark_id');
    }

    // العلاقة مع جدول الفئات (belongsToMany)
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'landmark_category', 'landmark_id', 'category_id');
    }


    protected static function booted()
    {
        static::saved(function ($landmark) {
            if (!$landmark->mainImage) {
                $firstImage = $landmark->images()->first();
                if ($firstImage) {
                    $landmark->mainImage = $firstImage->name;
                    $landmark->save();
                }
            }
        });
    }
}
