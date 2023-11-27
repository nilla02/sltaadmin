<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accommodation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'arrivalDate',
        'roomNumber',
        'ageOfGuest',
        'guestExempted',
        'firstName',
        'lastName',
        'numberOfNights',
        'color',
    ];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}
