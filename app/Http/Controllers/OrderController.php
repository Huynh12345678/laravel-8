<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Morder;
use App\Models\Morderdetail;

class OrderController extends Controller
{
    public function index()
    {
        return view('frontend.order.index');
    }

    public function history()
    {
        if (Session::has('userLogin')) {
            $userId = Session::get('userLogin.userId');
        } else {
            Session::flash('login', 'Bạn phải đăng nhập để sử dụng chức năng này.');
            return redirect()->route('userHome');  
        }

        $listOrderSuccess = Morder::where('status', 1)
        ->where('userid', $userId)
        ->orderBy('orderdate', 'desc')
        ->get();

        $listOrderNotSuccess = Morder::where('status', '!=', 1)
        ->where('userid', $userId)
        ->orderBy('orderdate', 'desc')
        ->get();

        return view('frontend.order.history', compact('listOrderSuccess', 'listOrderNotSuccess'));
    }

    public function detail($id) 
    {

        if (Session::has('userLogin')) {
            $userId = Session::get('userLogin.userId');
        } else {
            Session::flash('login', 'Bạn phải đăng nhập để sử dụng chức năng này.');
            return redirect()->route('userHome');  
        }

        $row = Morder::join('user', 'user.id', '=', 'order.userid')
        ->join('province', 'province.id', '=', 'order.province')
        ->join('district', 'district.id', '=', 'order.district')
        ->select('order.address as orderAddress', 'order.status as orderStatus', 'province.name as provinceName', 'district.name as districtName', 'order.*', 'user.*')
        ->find($id);

        $listProduct = Morderdetail::where('orderid', $id)
        ->join('product', 'product.id', '=', 'orderdetail.productid')
        ->select('orderdetail.price as orderPrice', 'orderdetail.*', 'product.*')
        ->get();

        $no = 1;
        $total = 0;

        foreach ($listProduct as $item) {
            $total += ($item['qty'] * $item['orderPrice']);
        }

        return view('frontend.order.detail', compact('row', 'listProduct', 'no', 'total'));
    }

    public function remove(Request $request, $id)
    {
        $row = Morder::find($id);
        $morder = new Morder;
        if($row['status'] == 1) {
            $morder = Morder::find($id);
            $morder->status = 4;
            $morder->save();
        }

        $request->session()->flash('success', 'Quý khách đã hủy thành công đơn hàng #'.$row['ordercode'].'!');
        return redirect()->route('userOrderHistory');
    }
}
