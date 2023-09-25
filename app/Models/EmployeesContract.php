<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeesContract extends Model
{
    use HasFactory;
    protected $table = 'employees_contracts';
     

    protected $fillable = [
        'user_id',
        'date',        
        'from',
        'to',
        'image',

    ];
}
