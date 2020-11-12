<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Mcatalog;
use App\Models\Mproduct;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $mcatalog = new Mcatalog;
        $catalogAccordion = $mcatalog->catalogAccordion();

        $keyword = $request->s;

        $filter = $request->filter;
        $select = '';
        if (isset($filter)) {
            $where = $request->filter;
            $result = explode('-', $where);
            $value = $result[0];
            $order = $result[1];
            $getData = array(
                '0' => $value,
                '1' => $order
            );
            Session::put('productFilterSearch', $getData);
        } else {
            if (Session::get('productFilterSearch')) {
                $getData = Session::get('productFilterSearch');
                $value = $getData[0];
                $order = $getData[1];
                $option = $value . '-' . $order;
                if ($option == 'created_at-desc') {
                    $select .= ' <option value="created_at-desc" selected>Mặc định</option>';
                } else {
                    $select .= ' <option value="created_at-desc">Mặc định</option>';
                }

                if ($option == 'created_at-asc') {
                    $select .= '  <option value="created_at-asc" selected>Sản phẩm cũ nhất</option>';
                } else {
                    $select .= '  <option value="created_at-asc">Sản phẩm cũ nhất</option>';
                }

                if ($option == 'name-asc') {
                    $select .= '<option value="name-asc" selected>Tên (A - Z)</option>';
                } else {
                    $select .= '  <option value="name-asc">Tên (A - Z)</option>';
                }

                if ($option == 'name-desc') {
                    $select .= '<option value="name-desc" selected>Tên (Z - A)</option>';
                } else {
                    $select .= '  <option value="name-desc">Tên (Z - A)</option>';
                }

                if ($option == 'price-asc') {
                    $select .= '<option value="price-asc" selected>Giá (Thấp -> Cao)</option>';
                } else {
                    $select .= '  <option value="price-asc">Giá (Thấp -> Cao)</option>';
                }

                if ($option == 'price-desc') {
                    $select .= '<option value="price-desc" selected>Giá (Cao -> Thấp)</option>';
                } else {
                    $select .= '  <option value="price-desc">Giá (Cao -> Thấp)</option>';
                }

                if ($option == 'view-desc') {
                    $select .= '<option value="view-desc" selected>Lượt xem (Thấp -> Cao)</option>';
                } else {
                    $select .= '  <option value="view-desc">Lượt xem (Thấp -> Cao)</option>';
                }

                if ($option == 'view-asc') {
                    $select .= '<option value="view-asc" selected>Lượt xem (Cao -> Thấp)</option>';
                } else {
                    $select .= '  <option value="view-asc">Lượt xem (Cao -> Thấp)</option>';
                }
            } else {
                $value = 'created_at';
                $order = 'desc';

                $select .= '<option value="created_at-desc" selected>Mặc định</option>
                <option value="created_at-asc">Sản phẩm cũ nhất</option>
                <option value="name-asc">Tên (A - Z)</option>
                <option value="name-desc">Tên (Z - A)</option>
                <option value="price-asc">Giá (Thấp -> Cao)</option>
                <option value="price-desc">Giá (Cao -> Thấp)</option>
                <option value="view-asc">Lượt xem (Thấp -> Cao)</option>
                <option value="view-desc">Lượt xem (Cao -> Thấp)</option>';
            }
        }

        if($keyword) {
            $listSearch = Mproduct::where('status', 1)
            ->where('trash', 1)
            ->where('name', 'LIKE', "%{$keyword}%")
            ->orWhere('sku', 'LIKE', "%{$keyword}%")
            ->orderBy($value, $order)
            ->select('name', 'thumb', 'view', 'price', 'sale', 'slug', 'id', 'sku')
            ->paginate(12);

            $listSearchCount = Mproduct::where('status', 1)
            ->where('trash', 1)
            ->where('name', 'LIKE', "%{$keyword}%")
            ->orWhere('sku', 'LIKE', "%{$keyword}%")
            ->orderBy($value, $order)
            ->select('name', 'thumb', 'view', 'price', 'sale', 'slug', 'id', 'sku')
            ->count();

            $listSearch->appends(['s' => $keyword]);

        } else {
            $listSearch = Mproduct::where('status', 1)
            ->where('trash', 1)
            ->orderBy($value, $order)
            ->select('name', 'thumb', 'view', 'price', 'sale', 'slug', 'id', 'sku')
            ->paginate(12);

            $listSearchCount = Mproduct::where('status', 1)
            ->where('trash', 1)
            ->orderBy($value, $order)
            ->select('name', 'thumb', 'view', 'price', 'sale', 'slug', 'id', 'sku')
            ->count();
        }
        
        $filerKeyword = "s=$keyword";

        if(isset($filter)) {
            return view('frontend.search.indexFilter', compact('catalogAccordion', 'listSearch', 'select', 'filerKeyword', 'listSearchCount', 'keyword'));
        } else {
            return view('frontend.search.index', compact('catalogAccordion', 'listSearch', 'select', 'filerKeyword', 'listSearchCount', 'keyword'));
        }
    }
}
