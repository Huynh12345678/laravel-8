<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Morderdetail extends Model
{
    use HasFactory;

    protected $table = 'orderdetail';
    protected $primaryKey = 'id';

    public $timestamps = false;
}
