<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_name',
        'customer_phone',
        'customer_email',
        'customer_address',
        'customer_note',
        'receipt_product',
        'receipt_status',
        'shipping_method',
        'payment_method',
        'total_money',
        'created_at',
        'updated_at',
    ];

    protected $primaryKey = 'receipt_id';
    protected $table = 'tbl_receipt';
}
