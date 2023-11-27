<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class Collector extends Model
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'fullname',
        'username',
        'position',
        'email',
        'email_verified_at',
        'password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'active' => 0,
    ];

    public function properties()
    {
        return $this->belongsToMany(Property::class, 'collector_property', 'collector_id', 'property_id');
    }

    public function payment()
    {
        return $this->hasMany(Payment::class);
    }

    public function accommodation()
    {
        return $this->hasMany(Accommodation::class);
    }

    public function collectorRoles()
    {
        return $this->belongsToMany(CollectorRole::class, 'Collector_role', 'collector_id', 'Collector_role_id');
    }
}
