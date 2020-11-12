<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mcoupon;

class CouponController extends Controller
{
    public function index()
    {
        $list = Mcoupon::orderBy('created_at', 'desc')
        ->get();

        $no = 1;

        return view('backend.coupon.index', compact('list', 'no'));
    }

    public function add()
    {
        return view('backend.coupon.add');
    }

    public function postAdd(Request $request)
    {
        $this->validate(
            $request,
            [
                'code' => 'required|min:3|max:30|unique:coupon,code',
                'price_discount' => 'required|integer',
                'code_limit' => 'required|integer',
                'expiration_date' => 'required',
                'price_payment_limit' => 'required|integer',
                'code_description' => 'required'
            ],
            [
                'code.required' => 'Mã code không được bỏ trống.',
                'code.min' => 'Mã code không được ít hơn 3 kí tự.',
                'code.max' => 'Mã code không được vượt quá 30 kí tự.',
                'code.unique' => 'Mã code này đã tồn tại',
                'price_discount.required' => 'Số tiền giảm giá không được bỏ trống.',
                'price_discount.integer' => 'Số tiền giảm giá phải là số nguyên dương.',
                'code_limit.required' => 'Giới hạn nhập không được bỏ trống.',
                'code_limit.integer' => 'Giới hạn nhập phải là số nguyên dương.',
                'expiration_date.required' => 'Ngày hết hạn không được bỏ trống.',
                'price_payment_limit.required' => 'Đơn hàng có thể nhập không được bỏ trống.',
                'price_payment_limit.integer' => 'Đơn hàng có thể nhập phải là số nguyên dương.',
                'code_description.required' => 'Mô tả code không được bỏ trống.',
            ]
        );

        $mcoupon = new Mcoupon;
        $mcoupon->code = $request->code;
        $mcoupon->price_discount = $request->price_discount;
        $mcoupon->code_limit = $request->code_limit;
        $mcoupon->user_used = 0;
        $mcoupon->price_payment_limit = $request->price_payment_limit;
        $mcoupon->expiration_date = $request->expiration_date;
        $mcoupon->code_description = $request->code_description;
        $mcoupon->status = 1;
        $mcoupon->save();
        $request->session()->flash('success', 'Thêm thành công mã giảm giá!');

        return redirect()->route('adminCoupon');
    }

    public function edit($id)
    {
        $mcoupon = new Mcoupon;
        $row = $mcoupon->find($id);
        if (!$row) {
            return view('error');
        }

        return view('backend.coupon.edit', compact('row'));
    }

    public function postEdit(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                'code' => 'required|min:3|max:30',
                'price_discount' => 'required|integer',
                'code_limit' => 'required|integer',
                'expiration_date' => 'required',
                'price_payment_limit' => 'required|integer',
                'code_description' => 'required'
            ],
            [
                'code.required' => 'Mã code không được bỏ trống.',
                'code.min' => 'Mã code không được ít hơn 3 kí tự.',
                'code.max' => 'Mã code không được vượt quá 30 kí tự.',
                'price_discount.required' => 'Số tiền giảm giá không được bỏ trống.',
                'price_discount.integer' => 'Số tiền giảm giá phải là số nguyên dương.',
                'code_limit.required' => 'Giới hạn nhập không được bỏ trống.',
                'code_limit.integer' => 'Giới hạn nhập phải là số nguyên dương.',
                'expiration_date.required' => 'Ngày hết hạn không được bỏ trống.',
                'price_payment_limit.required' => 'Đơn hàng có thể nhập không được bỏ trống.',
                'price_payment_limit.integer' => 'Đơn hàng có thể nhập phải là số nguyên dương.',
                'code_description.required' => 'Mô tả code không được bỏ trống.',
            ]
        );

        $mcoupon = new Mcoupon;
        $mcoupon = $mcoupon->find($id);
        $row =  $mcoupon->find($id);

        $mcoupon->code = $request->code;
        $mcoupon->price_discount = $request->price_discount;
        $mcoupon->code_limit = $request->code_limit;
        $mcoupon->price_payment_limit = $request->price_payment_limit;
        $mcoupon->expiration_date = $request->expiration_date;
        $mcoupon->code_description = $request->code_description;
        $mcoupon->save();
        $request->session()->flash('success', 'Cập nhật thành công mã giảm giá!');

        return redirect()->route('adminCoupon');
    }

    public function status(Request $request, $id) 
    {
        $mcoupon = new Mcoupon;
        $mcoupon = $mcoupon->find($id);
        $row =  $mcoupon->find($id);
        if(!$row) {
            return view('error');
        }
        if($row['status'] == 1) {
            $mcoupon->status = 0;
            $mcoupon->save();
            $request->session()->flash('success', 'Trạng thái của mã giảm giá ' . $row['name'] . ' đã được ẩn.');
        } else {
            $mcoupon->status = 1;
            $mcoupon->save();
            $request->session()->flash('success', 'Trạng thái của mã giảm giá ' . $row['name'] . ' đã được hiển thị.');
        }
        return redirect()->route('adminCoupon');
    }

    public function delete(Request $request, $id)
    {
        $mcoupon = new Mcoupon;
        $mcoupon = $mcoupon->find($id);
        $row =  $mcoupon->find($id);
        if(!$row) {
            return view('error');
        }

        $mcoupon->delete();
        $request->session()->flash('success', 'Mã giảm giá ' . $row['name'] . ' đã được xóa vĩnh viễn.');
        return redirect()->route('adminCoupon');
    }
}
