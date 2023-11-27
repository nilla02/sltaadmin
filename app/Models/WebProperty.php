<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebProperty extends Model
{
    use HasFactory;
    protected $connection = 'mysql2';
    protected $table = 'properties';

    protected $fillable = [
        'name',
        'sageid',
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
}
