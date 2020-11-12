<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TypiCMS\NestableTrait;

class Mcatalog extends Model
{
    use HasFactory;
    use NestableTrait;

    protected $table = 'catalog';
    protected $primaryKey = 'id';

    public function catalogTreeList()
    {
        return Mcatalog::orderByRaw('-name ASC')
            ->where('status', 1)
            ->where('trash', 1)
            ->get()
            ->nest()
            ->setIndent('|--- ')
            ->listsFlattened('name');
    }

    public function catalogCatName($id)
    {
        return Mcatalog::where('status', 1)
            ->where('trash', 1)
            ->find($id);
    }

    public function catalogBySubCat($parent_id = 0) 
    {
        return Mcatalog::where('status', 1)
        ->where('trash', 1)
        ->where('parent_id', $parent_id)
        ->orderBy('created_at', 'desc')
        ->select('id')  
        ->get();
    }

    public function catalogByProduct($parent_id)
    {
        $arr = array();
        $list = Mcatalog::catalogBySubCat($parent_id); 
        if (count($list)) {
            foreach ($list as $item) {
                $arr[] = $item['id'];
                $list1 = Mcatalog::catalogBySubCat($item['id']); 
                if (count($list1)) {
                    foreach ($list1 as $item1) {
                        $arr[] = $item1['id'];   
                        $list2 = Mcatalog::catalogBySubCat($item1['id']);                         
                        if (count($list2)) {
                            foreach ($list2 as $item2) {
                                $arr[] = $item2['id'];
                                $list3 = Mcatalog::catalogBySubCat($item2['id']);                                
                                if (count($list3)) {
                                    foreach ($list3 as $item4) {
                                        $arr[] = $item4['id'];
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        return $arr;
    }

    public function catalogAccordion()
    {
        return Mcatalog::orderByRaw('-name ASC')
            ->where('status', 1)
            ->where('trash', 1)
            ->get()
            ->nest();
    }
}
