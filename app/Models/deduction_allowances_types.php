<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class deduction_allowances_types extends Model
{
    use HasFactory;
    protected $fillable = ["name","type"];
}
