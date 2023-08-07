<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deductions extends Model
{
    use HasFactory;
    protected $table = 'deductions';
     

    
    protected $fillable = [
        'user_id',
        'date',        
        'type',
        'amount',
        'status',
        'lateness',
        'details',

    ];



}
