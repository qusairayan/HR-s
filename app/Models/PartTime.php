<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartTime extends Model
{
    use HasFactory;
    protected $table = 'part_times';
     

    
    protected $fillable = [
        'user_id',
        'from',        
        'to',
        'amount',
    

    ];



}
