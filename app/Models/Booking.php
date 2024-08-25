<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    // Specify the table if it's different from the default naming convention
    protected $table = 'bookings';

    // Define fillable attributes
    protected $fillable = ['token', 'flight_id', 'user_id'];

    // Specify if timestamps are used
    public $timestamps = true;

    // Define relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function flight()
    {
        return $this->belongsTo(Flight::class);
    }

    // Example of an accessor
    public function getTokenAttribute($value)
    {
        return strtoupper($value);
    }
}
