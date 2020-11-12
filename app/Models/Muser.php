<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Muser extends Model
{
    use HasFactory;

    protected $table = 'user';
    protected $primaryKey = 'id';

    public function checkLogin($username, $password)
    {
        $sql = Muser::where('username', $username)
        ->where('password', $password);

        if($sql->count() == 1) {
            return $sql->first();
        } else {
            return false;
        }
    }
}
