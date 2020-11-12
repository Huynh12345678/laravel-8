<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mbrand extends Model
{
    use HasFactory;
    
    protected $table = 'brand';
    protected $primaryKey = 'id';
}
