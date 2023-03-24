<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class emailVerification extends Model
{
    use HasFactory;

     /**
     *  variable for define table
     * */ 
    protected $table="email_verification";

     /**
     * variable array for table columns
     */
    protected $fillable = [
        'user_id',
        'is_verify',
        'token',
        'created_at',
        'updated_at',
    ];
}
