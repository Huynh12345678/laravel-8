<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Morder extends Model
{
    use HasFactory;

    protected $table = 'order';
    protected $primaryKey = 'id';

    public $timestamps = false;
}
