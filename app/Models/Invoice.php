<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'batch_number',
        'description',
        'sage_customer_id',
        'sage_invoice_number',
        'status',
        'amount',
        'date',
        'termcode',
        'shiptoste1',
        'shiptoste2',
        'shiptoste3',
        'shiptoste4',
        'shiptoctac',
    ];
}
