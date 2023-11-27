<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialSecurity extends Model
{
    use HasFactory;
    protected $table = 'social_security';
     

    protected $fillable = [
        'user_id',
        'date',        
        'onEmployee',
        'onCompany',
        "salary",
        "net_salary"
    ];
}