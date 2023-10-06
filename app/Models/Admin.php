<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'admin_password',
        'admin_phone',
        'admin_email',
        'admin_name',
    ];

    protected $primaryKey = 'admin_id';

    protected $table = 'tbl_admin';

}
