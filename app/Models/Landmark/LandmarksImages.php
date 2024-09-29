<?php

namespace App\Models\Landmark;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandmarksImages extends Model
{
    use HasFactory;

    protected $table = "landmarks_images";

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public $timestamps = true;

    // العلاقة مع جدول المعالم (belongsTo)
    public function landmark()
    {
        return $this->belongsTo(Landmark::class, 'landmark_id');
    }
}
