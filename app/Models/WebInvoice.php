<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebInvoice extends Model
{
    use HasFactory;
    protected $connection = 'mysql2';
    protected $table = 'invoices';

    protected $fillable = [
        'batch_number',
        'sage_customer_id',
        'sage_invoice_number',
        'description',
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
