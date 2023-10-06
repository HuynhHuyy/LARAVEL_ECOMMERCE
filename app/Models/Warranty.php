<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warranty extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_name',
        'customer_phone',
        'customer_email',
        'customer_address',
        'warranty_status',
        'product_name',
        'warranty_date',
        'return_date',
    ];

    protected $primaryKey = 'warranty_id';
    protected $table = 'tbl_warranty';
}
