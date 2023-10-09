<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrafficViolations extends Model
{
    use HasFactory;
    protected $table = 'traffic_violations';
     

    
    protected $fillable = [
        'user_id',
        'name',        
        'date',
        'time',
        

    ];



}
