<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    protected $fillable =
    [
        'user_id',
        'form_date',
        'to_date',
        'from_time',
        'to_time',
        'off'
    ];
    protected $dates = ['created_on', 'updated_on'];
}
