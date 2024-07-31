<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    // Specify the table name if it differs from the default
    protected $table = 'locations';

    // Define which attributes are mass assignable
    protected $fillable = ['name', 'code', 'type'];

    // Optionally, you can add casting for specific attributes if needed
    protected $casts = [
        'type' => 'string',
    ];

    // Example of defining relationships if applicable
    // public function flights()
    // {
    //     return $this->hasMany(Flight::class);
    // }
}
