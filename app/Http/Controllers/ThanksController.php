<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotifyMail;
use App\Models\Morder;
use App\Models\Morderdetail;
use App\Models\Mprovince;
use App\Models\Mdistrict;
use App\Models\Muser;

class ThanksController extends Controller
{
    public function index()
    {
        if (Session::has('userLogin')) {
            $email = Session::get('userLogin.userEmail');
            $id = Session::get('userLogin.userId');
        } else {
            return view('error');
        }

        $order = Morder::where('userid', $id)->orderBy('orderdate', 'desc')->first();

        $userName = Morder::where('order.userid', $id)
        ->join('user', 'user.id', '=', 'order.userid')
        ->orderBy('orderdate', 'desc')
        ->first();

        $listProduct = Morderdetail::where('orderid', $order['id'])
        ->join('product', 'product.id', '=', 'orderdetail.productid')
        ->select('orderdetail.price as orderPrice', 'orderdetail.*', 'product.*')
        ->get();

        Mail::to($email)->send(new NotifyMail($order, $listProduct, $userName));
        
        return view('thanks', compact('email'));
    }
}
