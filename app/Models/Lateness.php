<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lateness extends Model
{
    use HasFactory;
    protected $table = 'lateness';
     protected $fillable = ["user_id","attendence_id","amount","on"];
}
