<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mproducer extends Model
{
    use HasFactory;

    protected $table = 'producer';
    protected $primaryKey = 'id';
}
