<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'tradeName',
        'vatTaxpayerAccount',
        'Location',
        'mailingAddress',
        'noOfRooms',
        'typeOfProperty',
        'ownerName',
        'ownerPosition',
        'ownerEmail',
        'managerName',
        'managerPosition',
        'managerEmail',
        'accountantName',
        'accountantPosition',
        'accountantEmail',
        'primaryContactName',
        'primaryContactPosition',
        'primaryContactEmail',
        'applicableClassAndRate',
        'vat',
        'coicogs',
        'business',
        'government_id',
        'signed',
        'message',
        'pendingDocuments',
        'accepted',
    ];

    public function collectors()
    {
        return $this->belongsToMany(Collector::class, 'collector_property', 'property_id', 'collector_id');
    }

    public function recepit()
    {
        return $this->hasMany(Property::class, 'sage_customer_id', 'sageId');
    }
}
