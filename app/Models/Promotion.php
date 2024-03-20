<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;
    protected $table = 'promotions';
     
    protected $fillable = [
        'user_id',
        'company_id',
        'department_id',
        'type',
        'part_time',
        'salary',        
        'from',
        'to',
        'position',
    ];

}
