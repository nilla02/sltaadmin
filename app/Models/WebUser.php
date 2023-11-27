<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebUser extends Model
{
    use HasFactory;
    protected $connection = 'mysql2';
    protected $table = 'users';

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
        'username',
        'email',
        'email_verified_at',
        'password',
        'applicableClassAndRate',
        'vat',
        'coicogs',
        'business',
        'government_id',
        'signed',
        'message',
    ];
}
