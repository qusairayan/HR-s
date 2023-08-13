<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    use HasFactory;
    protected $table = 'salaries';
     

    protected $fillable = [
        'user_id',
        'company_id',        
        'amount',
        'bank',
        'status',
        'IBAN',
        'detail',

    ];
}
