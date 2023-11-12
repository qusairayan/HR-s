<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublicBank extends Model
{
    use HasFactory;
    protected $fillable =["bankName"];
}
