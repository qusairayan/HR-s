<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Allownce extends Model
{
    use HasFactory;
    protected $table = 'allownces';
     

    protected $fillable = [
        'user_id',
        'date',        
        'type',
        'amount',
        'status',
        'overtime',
        'details',

    ];
}
