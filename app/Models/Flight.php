<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    use HasFactory;

    protected $fillable = [
        'departure',
        'destination',
        'departure_time',
        'user_id',
        'name',
    ];

    public function clients()
    {
        return $this->belongsToMany(Client::class);
    }
}
