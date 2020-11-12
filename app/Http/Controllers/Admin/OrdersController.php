<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Morder;
use App\Models\Morderdetail;
use App\Models\Mproduct;

class OrdersController extends Controller
{
    public function index()
    {
        $list = Morder::where('save', 1)
        ->join('user', 'user.id', '=', 'order.userid')
        ->orderBy('orderdate', 'desc')
        ->select('order.status as orderStatus', 'order.address as orderAddress', 'order.id as orderId', 'order.*', 'user.*')
        ->get();

        $no = 1;

        return view('backend.orders.index', compact('list', 'no'));
    }

    public function save()
    {
        $list = Morder::where('save', 0)
        ->join('user', 'user.id', '=', 'order.userid')
        ->orderBy('orderdate', 'desc')
        ->select('order.status as orderStatus', 'order.address as orderAddress', 'order.id as orderId', 'order.*', 'user.*')
        ->get();

        $no = 1;

        return view('backend.orders.save', compact('list', 'no'));
    }

    public function status(Request $request, $id)
    {
        $morder = new Morder;
        $morder = $morder->find($id);
        $row =  $morder->find($id);
        if(!$row) {
            return view('error');
        }
        if($row['status'] == 1) {
            $morder->status = 2;
            $morder->save();
            $request->session()->flash('success', 'Đơn hàng #' .$row['ordercode'] . ' đã duyệt và đang bắt đầu giao hàng.');
        } else if ($row['status'] == 2) {
            $listOrder = Morderdetail::where(['orderid' => $id])->get();

            foreach ($listOrder as $item) {
                $qty = $item['qty']; 
                $product = Mproduct::where('id', $item['productid'])->first();
                $total = $qty + $product['number_buy'];
                $mproduct = new Mproduct;
                $mproduct = $mproduct->find($item['productid']);
                $mproduct->number_buy = $total;
                $mproduct->save();
            }

            $morder->status = 3;
            $morder->save();
            $request->session()->flash('success', 'Đơn hàng #' .$row['ordercode'] . ' đã giao hàng và thanh toán thành công.');
        }
        return redirect()->route('adminOrders');
    }

    public function cancel(Request $request, $id)
    {
        $morder = new Morder;
        $morder = $morder->find($id);
        $row =  $morder->find($id);
        if(!$row) {
            return view('error');
        }
        if($row['status'] == 1) {
            $morder->status = 5;
            $morder->save();
            $request->session()->flash('success', 'Đơn hàng #' .$row['ordercode'] . ' đã hủy.');
        } else if ($row['status'] == 2) {
            $morder->status = 5;
            $morder->save();
            $request->session()->flash('success', 'Đơn hàng #' .$row['ordercode'] . ' đã hủy.');
        }
        return redirect()->route('adminOrders');
    }

    public function detail($id)
    {
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

        return view('backend.orders.detail', compact('row', 'listProduct', 'no', 'total'));
    }

    public function changeSave(Request $request, $id)
    {
        $morder = new Morder;
        $morder = $morder->find($id);
        $row =  $morder->find($id);
        if(!$row) {
            return view('error');
        }
        if($row['save'] == 1) {
            $morder->save = 0;
            $morder->save();
            $request->session()->flash('success', 'Lưu thành công đơn hàng #' .$row['ordercode'] . '.');
        } 
        return redirect()->route('adminOrders');
    }
    
    public function changeRestore(Request $request, $id)
    {
        $morder = new Morder;
        $morder = $morder->find($id);
        $row =  $morder->find($id);
        if(!$row) {
            return view('error');
        }
        if($row['save'] == 0) {
            $morder->save = 1;
            $morder->save();
            $request->session()->flash('success', 'Hủy lưu thành công đơn hàng #' .$row['ordercode'] . '.');
        } 
        return redirect()->route('adminOrdersSave');
    }

    public function delete(Request $request, $id)
    {
        $morder = new Morder;
        $morder = $morder->find($id);
        $row =  $morder->find($id);
        if(!$row) {
            return view('error');
        }

        $morder->delete();
        $request->session()->flash('success', 'Đơn hàng #' . $row['ordercode'] . ' đã được xóa vĩnh viễn.');
        return redirect()->route('adminOrdersSave');
    }
}
