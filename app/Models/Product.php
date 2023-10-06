<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name',
        'product_desc',
        'created_at',
        'updated_at',
    ];

    protected $primaryKey = 'product_id';
    protected $table = 'tbl_product';
}
