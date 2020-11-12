<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mproduct extends Model
{
    use HasFactory;

    protected $table = 'product';
    protected $primaryKey = 'id';

    public function productByCat($listCatid)
    {  
        return Mproduct::where('status', 1)
        ->where('trash', 1)
        ->whereIn('catid', $listCatid)
        ->orderBy('created_at', 'desc')
        ->take(10)
        ->get();
    }

    public function productByCatalog($listCatid, $value, $order)
    {  
        return Mproduct::where('status', 1)
        ->where('trash', 1)
        ->whereIn('catid', $listCatid)
        ->orderBy($value, $order)
        ->paginate('12');
    }

    public function productByCatalogCount($listCatid, $value, $order)
    {  
        return Mproduct::where('status', 1)
        ->where('trash', 1)
        ->whereIn('catid', $listCatid)
        ->orderBy($value, $order)
        ->count();
    }
}
