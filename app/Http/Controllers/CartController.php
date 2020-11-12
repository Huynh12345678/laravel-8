<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Mproduct;
use App\Models\Mcoupon;

class CartController extends Controller
{
    public function index()
    {
        return view('frontend.cart.index');
    }

    public function addToCart(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->id;
            if (Session::get('cart')) {
				$cart = Session::get('cart');

                if (array_key_exists($id, $cart)) {
					$cart[$id]++;
				} else {
					$cart[$id] = 1; // Chưa có thì sẽ bắt đầu là 1
				}
			} else {
				$cart[$id] = 1;
			}
			Session::put('cart', $cart);
			echo json_encode($cart);
        }
    }

    public function updateCart(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->id;
            if (Session::get('cart')) {
                $cart = Session::get('cart');
                if (array_key_exists($id, $cart)) {
                    $cart[$id] = (int) ($request->sl);
                }
            }
			Session::put('cart', $cart);
			echo json_encode($cart);
        }
    }

    public function showCartTable(Request $request)
    {
        if ($request->ajax()) {
            $html = '';

            if(Session::get('cart')) {
                $cart = Session::get('cart');

                foreach ($cart as $key => $val) {
                    $item = Mproduct::where('trash', 1)
                    ->where('status', 1)
                    ->find($key);
                    $html .= '<tr>
                    <td>
                        <img src="'.url('uploads/product/'.$item['thumb']).'" alt="'.$item['name'].'" width="100px"
                            height="100px" />
                    </td>
                    <td>
                        <h5 class="mt-0 mb-1 section__cart-name ">
                            <a href="'.route('userProductDetail', $item['slug']).'" class="text-body">'.$item['name'].'</a>
                        </h5>
                    </td>
                    <td> '. number_format($item['price'] - $item['price'] * ($item['sale'] / 100), 0, ',', '.') .' VNĐ</td>
                    <td>
                        <div class="qtyField pr-3 d-flex justify-content-center">
                            <a class="qtyBtn minus border-right-0" href="javascript:void(0);">
                                <i class="fa fa-minus" aria-hidden="true"></i>
                            </a>
                            <input type="text" data-id="'.$item['id'].'" name="quantity" value="'.$val.'"
                                class="form-control border-radius-0 qty border-right-0 border-left-0 editQuantity"
                                readonly="" />
                            <a class="qtyBtn plus border-left-0" href="javascript:void(0);">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                            </a>
                        </div>
                    </td>
                    <td>'. number_format(($item['price'] - $item['price'] * ($item['sale'] / 100)) * $val, 0, ',', '.') .' VNĐ</td>
                    <td>
                        <a href="javascript:void(0);" class="text-body section__sidebar-content-removeCart" data-id="'.$item['id'].'">
                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                        </a>
                    </td>
                </tr>';
                }
            } else {
                $html .= '<tr>
                <td colspan="6" class="text-danger font-weight-bolder text-uppercase">Giỏ hàng trống</td>
                </tr>';
            }

            echo $html;
        }
    }

    public function showCartOrder(Request $request)
    {
        if ($request->ajax()) {
            $html = '';

            if(Session::get('cart')) {
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
                }

                $html .= '<div class="d-flex justify-content-between mb-3">
                    <p class="text-capitalize font-weight-bold">Tổng cộng</p>
                    <p class="text-body">'.number_format($total, '0', ',', '.').' VNĐ</p>
                </div>

                <div class="d-flex justify-content-between pb-3">
                    <p class="text-capitalize font-weight-bold">
                        Phí vận chuyển
                    </p>
                    <p class="text-body">50.000 VNĐ</p>
                </div>

                <div class="d-flex justify-content-between mb-3 border-bottom pb-3">
                    <p class="text-capitalize font-weight-bold">
                        Mã giảm giá
                    </p>
                    <p class="text-body">'.number_format($coupon, '0', ',', '.').' VNĐ</p>
                </div>

                <div class="d-flex justify-content-between pt-3 pb-3">
                    <p class="text-capitalize font-weight-bold">Thành tiền</p>
                    <p class="text-body">'.number_format($subTotal, '0', ',', '.').' VNĐ</p>
                </div>

                <a href="'.route('userCheckout').'" class="section__cart-border-content-btn text-capitalize mb-1">
                    Tiến hành thanh toán
                </a>';
            } else {
                $html .= '<div class="d-flex justify-content-between mb-3">
                <p class="text-capitalize font-weight-bold">Tổng cộng</p>
                <p class="text-body">0 VNĐ</p>
            </div>

            <div class="d-flex justify-content-between pb-3">
                <p class="text-capitalize font-weight-bold">
                    Phí vận chuyển
                </p>
                <p class="text-body">0 VNĐ</p>
            </div>

            <div class="d-flex justify-content-between mb-3 border-bottom pb-3">
                    <p class="text-capitalize font-weight-bold">
                        Mã giảm giá
                    </p>
                    <p class="text-body">0 VNĐ</p>
                </div>

            <div class="d-flex justify-content-between pt-3 pb-3">
                <p class="text-capitalize font-weight-bold">Thành tiền</p>
                <p class="text-body">0 VNĐ</p>
            </div>

            <a href="checkout.html" class="section__cart-border-content-btn text-capitalize mb-1">
                Tiến hành thanh toán
            </a>';
            }

            echo $html;
        }
    }

    public function showCartSidebar(Request $request)
    {
        if ($request->ajax()) {
            $html = '';

            if(Session::get('cart')) {
                $cart = Session::get('cart');

                foreach ($cart as $key => $val) {
                    $item = Mproduct::where('trash', 1)
                    ->where('status', 1)
                    ->find($key);
                    $html .= '<li class="section__sidebar-content-item d-flex">
            <a href="'. route('userProductDetail', $item['slug']).'" class="section__sidebar-content-thumb">
                <img src="'.url('uploads/product/'.$item['thumb']).'" class="img-fluid" alt="'.$item['name'].'" />
            </a>

            <div class="section__sidebar-content-info ml-2">
                <h5>'.$item['name'].'</h5>
                <div class="section__sidebar-content-info-price">
                    '. number_format(($item['price'] - $item['price'] * ($item['sale'] / 100)) * $val, 0, ',', '.') .' VNĐ X '.$val.'
                </div>
                <div class="section__sidebar-content-info-quantity">
                    '. __('home.cart-quantity').': '.$val.'
                </div>
            </div>

            <div class="section__sidebar-content-remove">
                <a href="javascript:void(0)" class="section__sidebar-content-removeCart" data-id="'.$item['id'].'">
                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                </a>
            </div>
        </li>';
                }
            } else {
                $html .= '<li class="section__sidebar-content-item d-flex justify-content-center text-danger text-uppercase">
                '. __('home.cart-empty').'!
                </li>';
            }

            echo $html;
        }
    }

    public function showCartTotal(Request $request)
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
                }

                $html .= '<div class="d-flex justify-content-between">
                <div class="text-uppercase font-weight-bold">'. __('home.cart-total').'</div>
                <div>'.number_format($total, '0', ',', '.').' VNĐ</div>
            </div>
            <div class="d-flex justify-content-between">
                <div class="text-uppercase font-weight-bold">'. __('home.cart-shipping').'</div>
                <div>50.000 VNĐ</div>
            </div>
            <div class="d-flex justify-content-between">
                <div class="text-uppercase font-weight-bold">'. __('home.cart-coupon').'</div>
                <div>'.number_format($coupon, '0', ',', '.').' VNĐ</div>
            </div>
            <div class="d-flex justify-content-between">
                <div class="text-uppercase font-weight-bold">'. __('home.cart-subtotal').'</div>
                <div>'.number_format($subTotal, '0', ',', '.').' VNĐ</div>
            </div>';
            }
            echo $html;
        }
    }

    public function removeCart(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->id;

            if (Session::get('cart')) {
                $cart = Session::get('cart');
                if ($cart[$id]) {
                    unset($cart[$id]);
                }
            }

            Session::put('cart', $cart);
            Session::put('userCoupon');
            echo json_encode($cart);
        }  
    }

    public function showCartQuantity(Request $request)
    {
        if ($request->ajax()) {
            $html = '';

            if (Session::get('cart')) {
                $cart = Session::get('cart');
                $count = count($cart);
                $html .= "$count";
            } else {
                $html .= '0';
            }

            echo $html;
        }  
    }

    public function showCoupon(Request $request)
    {
        if ($request->ajax()) {
            $coupon = $request->coupon;
            $html = '';
            if (Session::has('userCoupon')) {
                $html .= 'Mã giảm giá này đã được sử dụng trước đó rồi.';
            } else {
                if(empty($coupon)) {
                    $html .= 'Mã giảm giá không được bỏ trống.';
                } else {
                    $listCoupon = Mcoupon::where('status', 1)
                    ->where('code', $coupon)
                    ->get()
                    ->toArray();
                    
                    if(Session::get('cart')) {
                        $cart = Session::get('cart');
                        $total = 0;
                        
                        foreach ($cart as $key => $val) {
                            $item = Mproduct::where('trash', 1)
                            ->where('status', 1)
                            ->find($key);

                            $priceProduct = ($item['price'] - $item['price'] * ($item['sale'] / 100)) * $val;
                            $total += $priceProduct;
                            $subTotal = $total + 50000;
                        }
                    }

                    if(empty($listCoupon)) {
                        $html .= 'Mã giảm giá này không tồn tại. Vui lòng thử lại.';
                    } else {
                        foreach ($listCoupon as $item) {
                            $now = strtotime(date('Y-m-d H:i:s'));
                            $getdateCoupon = strtotime($item['expiration_date']);
                            
							if ($item['code_limit'] - $item['user_used'] == 0) {
								$html .= 'Mã giảm giá đã hết lượt sử dụng.';
							} else if ($getdateCoupon <= $now) {
								$html .= 'Mã giảm giá này đã hết hạn từ ngày ' . $item['expiration_date'];
							} else if ($item['price_payment_limit'] >= $subTotal) {
								$html .= 'Mã giảm giá này chỉ áp dụng cho đơn hàng từ ' . number_format($item['price_payment_limit'], 0, ",", ".") . ' VNĐ trở lên.';
							} else {
                                $html .= '<script>
                                showToastr();
                            toastr["success"]("Mã giám giá đã được kích hoạt");
                            </script>
                            ';

								$getData = array(
									'coupon' => $item['price_discount'],
									'couponId' => $item['id']
								);
								Session::put('userCoupon', $getData);
							}
                        }
                    }
                }
            }
            echo json_encode($html);
        }  
    }
}
