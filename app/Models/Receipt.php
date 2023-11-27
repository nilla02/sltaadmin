<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'sage_invoice_number',
        'property_name',
        'title',
        'sage_customer_id',
        'date',
        'reference',
        'amount',
        'currency',
        'payment_type',
        'sage_system_id'
    ];

    public function property()
    {
        return $this->belongsTo(Property::class, 'sageId', 'sage_customer_id');
    }
}
