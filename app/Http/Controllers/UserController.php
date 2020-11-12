<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Models\Muser;
use App\Models\Morder;
use App\Mail\Forgot;

class UserController extends Controller
{
    public function index()
    {
        if (Session::has('userLogin')) {
            $userId = Session::get('userLogin.userId');
        } else {
            Session::flash('login', 'Bạn phải đăng nhập để sử dụng chức năng này.');
            return redirect()->route('userHome');  
        }

        $row = Muser::where('status', 1)
        ->where('id', $userId)
        ->first();

        $listOrderNotSuccess = Morder::where('status', 1)
        ->where('userid', $userId)
        ->orderBy('orderdate', 'desc')
        ->count();

        $listOrderSuccess = Morder::where('status', '!=', 1)
        ->where('userid', $userId)
        ->orderBy('orderdate', 'desc')
        ->count();

        return view('frontend.user.index', compact('row', 'listOrderNotSuccess', 'listOrderSuccess'));
    }

    public function edit($id)
    {
        if (Session::has('userLogin')) {
            $userId = Session::get('userLogin.userId');
        } else {
            Session::flash('login', 'Bạn phải đăng nhập để sử dụng chức năng này.');
            return redirect()->route('userHome');  
        }

        $row = Muser::find($id);
        return view('frontend.user.edit', compact('row'));
    }

    public function postEdit(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                'fullname' => 'required|min:5',
                'email' => 'required|regex:/(.+)@(.+)\.(.+)/i',
                'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|max:11',
                'address' => 'required',
                'thumb' => 'file|mimes:jpg,jpeg,png,gif',
            ],
            [
                'fullname.required' => ''.__('validate.requiredFullname').'',
                'fullname.min' => ''.__('validate.minFullname').'',
                'email.required' => ''.__('validate.requiredEmail').'',
                'email.regex' => ''.__('validate.regexEmail').'',
                'phone.required' => ''.__('validate.requiredPhone').'',
                'phone.regex' => ''.__('validate.regexPhone').'',
                'phone.max' => ''.__('validate.maxPhone').'',
                'address.required' => 'Nởi ở hiện tại không được bỏ trống.',
                'thumb.mimes' => 'Tệp vừa chọn không phải là hình ảnh.',
            ]
        );
        
        $row = Muser::find($id);

        if ($request->hasFile('thumb')) {
            $destinationPath = 'uploads/user/';
            $profileImage = date('YmdHis') . "." . $request->file('thumb')->getClientOriginalExtension();
            $request->file('thumb')->move($destinationPath, $profileImage);
            if ($row['thumb'] != 'user.png') {
                unlink('uploads/user/' . $request->thumbOld);
            }
        } else {
            $profileImage = $request->thumbOld;
        }

        $muser = new Muser;
        $muser = $muser->find($id);
        $muser->fullname = $request->fullname;
        $muser->email = $request->email;
        $muser->phone = $request->phone;
        $muser->address = $request->address;
        $muser->gender = $request->gender;
        $muser->thumb = $profileImage;
        $muser->save();
        return redirect()->route('userProfile');
    }

    public function reset($id)
    {
        if (Session::has('userLogin')) {
            $userId = Session::get('userLogin.userId');
        } else {
            Session::flash('login', 'Bạn phải đăng nhập để sử dụng chức năng này.');
            return redirect()->route('userHome');  
        }

        $row = Muser::find($id);
        return view('frontend.user.reset', compact('row'));
    }

    public function postReset(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                'passwordOld' => 'required',
                'passwordNew' => 'required',
                'rePasswordNew' => 'required|required_with:passwordNew|same:passwordNew'
            ],
            [
                'passwordOld.required' => 'Mật khẩu không được bỏ trống.',
                'passwordNew.required' => 'Mật khẩu mới không được bỏ trống.',
                'rePasswordNew.required' => 'Xác nhận mật khẩu không được bỏ trống.',
                'rePasswordNew.required_with' => 'Xác nhận mật khẩu không trùng khớp với mật khẩu.',
                'rePasswordNew.same' => 'Xác nhận mật khẩu không trùng khớp với mật khẩu.',
            ]
        );
        
        $row = Muser::find($id);
        $passwordOld = $row['password'];
        $checkPassword = md5($request->passwordOld);
        if($checkPassword == $passwordOld) {
            $muser = new Muser;
            $muser = Muser::find($id);
            $muser->password = md5($request->passwordNew);
            $muser->save();
            $request->session()->flash('success', 'Mật khẩu đã được cập nhật! Bạn có thể đăng xuất để kiểm tra.');
            return redirect()->back();
        } else {
            $request->session()->flash('danger', 'Mật khẩu cũ không trùng khớp. Vui lòng thử lại!');
            return redirect()->back();
        }

    }

    public function forgot()
    {
        return view('frontend.user.forgot');
    }

    public function postForgot(Request $request)
    {
        $this->validate(
            $request,
            [
                'email' => 'required|regex:/(.+)@(.+)\.(.+)/i',
            ],
            [
                'email.required' => 'Email không được bỏ trống.',
                'email.regex' => 'Email không hợp lệ.',
            ]
        );

        $getEmail = $request->email;
        $checkEmail = Muser::where('status', 1)
        ->where('email', $getEmail)
        ->first();
        
        if(isset($checkEmail)) {
            Mail::to($getEmail)->send(new Forgot($checkEmail));
            $request->session()->flash('success', 'Quý khách vui lòng kiểm tra Email vửa nhập và làm theo hướng dẫn để lấy lại mật khẩu!');
            return redirect()->back();
        } else {
            $request->session()->flash('danger', 'Email này không phải là thành viên của cửa hàng. Vui lòng nhập đúng email của cửa hàng!');
            return redirect()->back();
        }
    } 

    public function getForgot($id)
    {
        $row = Muser::find($id);
        return view('frontend.user.getForgot', compact('row'));
    }
    
    public function postForgotPassword(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                'passwordNew' => 'required',
                'rePasswordNew' => 'required|required_with:passwordNew|same:passwordNew'
            ],
            [
                'passwordNew.required' => 'Mật khẩu mới không được bỏ trống.',
                'rePasswordNew.required' => 'Xác nhận mật khẩu không được bỏ trống.',
                'rePasswordNew.required_with' => 'Xác nhận mật khẩu không trùng khớp với mật khẩu.',
                'rePasswordNew.same' => 'Xác nhận mật khẩu không trùng khớp với mật khẩu.',
            ]
        );
        
        $passwordNew = $request->passwordNew;
        $muser = Muser::find($id);
        $muser->password = md5($passwordNew);
        $muser->save();
        $request->session()->flash('success', 'Đặt lại mật khẩu thành công. Bây giờ bạn có thể đăng nhập!');
        return redirect()->back();
    }   
}
