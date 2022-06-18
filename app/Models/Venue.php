<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;


class Venue extends Model
{
    use HasFactory;

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function category(): string
    {
        $booking_count = $this->bookings()->count();
        $_category = "";

        if ($booking_count > 15) {
            $_category = "Gold";
        } else if ($booking_count > 10) {
            $_category = "Silver";
        } else if ($booking_count > 5) {
            $_category = "Bronze";
        }
        
        return $_category;
    }
}
