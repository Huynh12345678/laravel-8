<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mcomment extends Model
{
    use HasFactory;

    protected $table = 'comment';
    protected $primaryKey = 'id';
}
