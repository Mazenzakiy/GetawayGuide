<?php

namespace App\Models\Reservation;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $table = "reservations";

    protected $fillable = [

        "name",
        "phone_number",
        "num_guests",
        "check_in_date",
        "destination",
        "price",
        "user_id",
        "status",
        "days",
        "tourGuied_name",
        "status",
        "tourGuied_name",
        "tourGuied_id",
        "tourGuied_status",

    ];

    public $timestamps = true;

    // reservation belongsTo user
    public function user(){
        return $this->belongsTo(User::class);
    }

}
