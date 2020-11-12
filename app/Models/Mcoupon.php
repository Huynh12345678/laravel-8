<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mcoupon extends Model
{
    use HasFactory;

    protected $table = 'coupon';
    protected $primaryKey = 'id';
}
