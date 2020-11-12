<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\Mproduct;
use App\Models\Mprovince;
use App\Models\Mdistrict;
use App\Models\Morder;
use App\Models\Morderdetail;

class CheckoutController extends Controller
{
    public function index()
    {
        if(Session::has('userLogin')) {
              $row = Session::get('userLogin');
        } else {
            Session::flash('login', 'Bạn phải đăng nhập để sử dụng chức năng này.');
            return redirect()->route('userHome');  
        }

        if(!Session::has('cart')) {
            Session::flash('error', 'Chưa có sản phẩm nào trong giỏ hàng để thanh toán.');
            return redirect()->back();   
        }

        $listProvince = Mprovince::get();
        return view('frontend.checkout.index', compact('row', 'listProvince'));
    }

    public function postCheckout(Request $request)
    {
        $this->validate(
            $request,
            [
                'province' => 'required',
                'address' => 'required',
                'district' => 'required',
                'note' => 'required',
            ],
            [
                'province.required' => 'Tỉnh / Thành phố không được bỏ trống.',
                'address.required' => 'Địa chỉ nhận hàng không được bỏ trống.',
                'district.required' => 'Quận / Huyện không được bỏ trống.',
                'note.required' => 'Ghi chú không được bỏ trống.',
            ]
        );
        
        if (Session::get('cart')) {
            $cart = Session::get('cart');
            $total = 0;

            if (Session::has('userCoupon')) {
                $coupon = Session::get('userCoupon.coupon');
            } else {
                $coupon = 0;
            }

            foreach ($cart as $key => $val) {
                $item = Mproduct::where('trash', 1)
                ->where('status', 1)
                ->find($key);

                $priceProduct = ($item['price'] - $item['price'] * ($item['sale'] / 100)) * $val;
                $total += $priceProduct;
                $subTotal = $total + 50000 - $coupon;
            }  
        }
        
        if (Session::has('userLogin')) {
            $userId = Session::get('userLogin.userId');
        }

        $morder = new Morder;
        $morder->ordercode = Str::random(5);
        $morder->userid = $userId;
        $morder->orderdate = Carbon::now();
        $morder->money = $subTotal;
        $morder->price_ship = 50000;
        $morder->coupon = $coupon;
        $morder->province = $request->province;
        $morder->district = $request->district;
        $morder->address = $request->address;
        $morder->note = $request->note;
        $morder->status = 1;
        $morder->save = 1;

        $morder->save();

        $listOrderDetail = Morder::where('userid', $userId)
        ->orderBy('orderdate', 'desc')
        ->first();

        if (Session::get('cart')) {
            $cart = Session::get('cart');
            
            foreach ($cart as $key => $val) {
                $item = Mproduct::where('trash', 1)
                ->where('status', 1)
                ->find($key);

                $priceProduct = ($item['price'] - $item['price'] * ($item['sale'] / 100));
                $morderdetail = new Morderdetail;
                $morderdetail->orderid = $listOrderDetail['id'];
                $morderdetail->productid = $key;
                $morderdetail->qty = $val;
                $morderdetail->price = $priceProduct;
                $morderdetail->status = 1;
                $morderdetail->save = 1;

                $morderdetail->save();
            }
        }

        Session::forget(['cart', 'userCoupon']);

        return redirect()->route('userThanks');        
    }

    public function showCheckoutCart(Request $request)
    {
        if ($request->ajax()) {
            $html = '';

            if (Session::get('cart')) {
                $cart = Session::get('cart');

                $total = 0;

                if(Session::has('userCoupon')) {
                    $coupon = Session::get('userCoupon.coupon');
                } else {
                    $coupon = 0;
                }

                foreach ($cart as $key => $val) {
                    $item = Mproduct::where('trash', 1)
                    ->where('status', 1)
                    ->find($key);

                    $priceProduct = ($item['price'] - $item['price'] * ($item['sale'] / 100)) * $val;
                    $total += $priceProduct;
                    $subTotal = $total + 50000 - $coupon;

                    $html .= '<tr>
                    <td>
                        <img src="'.url('uploads/product/'. $item['thumb']).'" alt="'.$item['name'].'" width="60px"
                            height="60px">
                    </td>
                    <td>
                        <p class="text-left">'.$item['name'].' X '.$val.'</p>
                    </td>
                    <td>'. number_format($priceProduct, 0, ',', '.') .' VNĐ</td>
                </tr>';
                }

                $html .= ' <tr>
                <td colspan="2" class="text-capitalize">Tổng cộng</td>
                <td>'. number_format($total, 0, ',', '.') .' VNĐ</td>
            </tr>

            <tr>
                <td colspan="2" class="text-capitalize">
                    Phí vận chuyển
                </td>
                <td>50.000 VNĐ</td>
            </tr>

            <tr>
                <td colspan="2" class="text-capitalize">
                    Mã giảm giá
                </td>
                <td>'. number_format($coupon, 0, ',', '.') .' VNĐ</td>
            </tr>

            <tr>
                <td colspan="2" class="text-capitalize">Thành tiền</td>
                <td>'. number_format($subTotal, 0, ',', '.') .' VNĐ</td>
            </tr>';
            }

            echo $html;
        }
    }

    public function showDistrict(Request $request)
    {
        if($request->ajax()) {
            $provinceId = $request->provinceId;
            $html = '';

            $listDistrict = Mdistrict::where('provinceid', $provinceId)
            ->get();

            foreach ($listDistrict as $item) {
                $html .= '<option value="'.$item['id'].'">'.$item['name'].'</option>';   
            }
            echo $html;
        }
    }
}
