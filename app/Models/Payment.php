<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'property_id',
        'declaration_id',
        'payment',
        'payment_type',
        'payment_url',
    ];

    public function collector()
    {
        return $this->belongsTo(Collector::class);
    }

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function declaration()
    {
        return $this->belongsTo(Declaration::class);
    }
}
