<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CollectorRole extends Model
{
    use HasFactory;

    public function collectors()
    {
        return $this->belongsToMany(Collector::class, 'collector', 'Collector_role_id', 'collector_id');
    }
}
