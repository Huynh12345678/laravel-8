<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Morder;
use App\Models\Muser;
use App\Models\Morderdetail;

class NotifyMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $user;
    public $orderdetail;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Morder $order, $orderdetail, $user)
    {
        $this->morder = $order;
        $this->muser = $user;
        $this->morderdetail = $orderdetail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Circle Shop')
        ->from('emarketstore2020@gmail.com')
        ->view('frontend.email.index')
        ->with([
            'ordercode' => $this->morder->ordercode,
            'orderdate' => $this->morder->orderdate,
            'ordercoupon' => $this->morder->coupon,
            'userName' => Morder::where('userid', $this->muser->id)
            ->join('user', 'user.id', '=', 'order.userid')
            ->join('province', 'province.id', '=', 'order.province')
            ->join('district', 'district.id', '=', 'order.district')
            ->select('province.name as provinceName', 'district.name as districtName', 'user.*', 'order.*')
            ->orderBy('orderdate', 'desc')
            ->first(),
            'listProduct' => Morderdetail::where('orderid', $this->morder->id)
            ->join('product', 'product.id', '=', 'orderdetail.productid')
            ->select('orderdetail.price as orderPrice', 'orderdetail.*', 'product.*')
            ->get()
        ]);
    }
}
