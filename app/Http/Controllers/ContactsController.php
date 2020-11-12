<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mcontact;

class ContactsController extends Controller
{
    public function index()
    {
        return view('frontend.contact.index');
    }

    public function postContact(Request $request)
    {
        $this->validate(
            $request,
            [
                'name' => 'required|min:3|max:255',
                'email' => 'required|regex:/(.+)@(.+)\.(.+)/i',
                'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|max:11',
                'body' => 'required',
                'title' => 'required',
            ],
            [
                'name.required' => 'Họ và tên không được bỏ trống.',
                'name.min' => 'Họ và tên không được ít hơn 3 kí tự.',
                'name.max' => 'Họ và tên không được vượt quá 50 kí tự.',
                'email.required' => 'Email không được bỏ trống.',
                'email.regex' => 'Email không hợp lệ.',
                'phone.required' => 'Số điện thoại không được bỏ trống.',
                'phone.regex' => 'Số điện thoại không hợp lệ.',
                'phone.max' => 'Số điện thoại không được vượt quá 11 ký tự.',
                'body.required' => 'Nội dung không được bỏ trống.',
                'title.required' => 'Tiêu đề không được bỏ trống.',
            ]
        );

        $mcontact = new Mcontact;
        $mcontact->name = $request->name;
        $mcontact->email = $request->email;
        $mcontact->phone = $request->phone;
        $mcontact->title = $request->title;
        $mcontact->body = $request->body;
        $mcontact->save();
        $request->session()->flash('success', 'Quý khách đã gửi thành công liên hệ. Chúng tôi sẽ liên hệ với quý khách sớm nhất để hỗ trợ!');

        return redirect()->route('userContact');        
    }
}
