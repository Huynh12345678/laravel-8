<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Models\Muser;

class LoginController extends Controller
{
    public function postRegister(Request $request)
    {
        if ($request->ajax()) {
            $rules = array(
                'username' => 'required|min:3|max:255|regex:/^[A-Za-z0-9_\.]{3,32}$/|unique:user,username',
                'email' => 'required|regex:/(.+)@(.+)\.(.+)/i|unique:user,email',
                'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|max:11',
                'fullname' => 'required|min:5',
                'password' => 'required|regex:/^([a-zA-Z]){1}([\w_\.!@#$%^&*()]+){3,32}$/'
            );

            $msg = array(
                'username.required' => ''.__('validate.requiredUsername').'',
                'username.min' => ''.__('validate.minUsername').'',
                'username.max' => ''.__('validate.maxUsername').'',
                'username.regex' => ''.__('validate.regexUsername').'',
                'username.unique' => ''.__('validate.uniqueUsername').'',
                'email.required' => ''.__('validate.requiredEmail').'',
                'email.regex' => ''.__('validate.regexEmail').'',
                'email.unique' => ''.__('validate.uniqueEmail').'',
                'phone.required' => ''.__('validate.requiredPhone').'',
                'phone.regex' => ''.__('validate.regexPhone').'',
                'phone.max' => ''.__('validate.maxPhone').'',
                'fullname.required' => ''.__('validate.requiredFullname').'',
                'fullname.min' => ''.__('validate.minFullname').'',
                'password.required' => ''.__('validate.requiredPassword').'',
                'password.regex' => ''.__('validate.regexPassword').''
            );

            $validator = Validator::make($request->all(), $rules, $msg);

            if ($validator->fails()) {
                return response()->json(
                    array (
                        'errors' => $validator->getMessageBag()->toArray()
                    )
                );
            } else {
                $muser = new Muser;
                $muser->username = $request->username;
                $muser->email = $request->email;
                $muser->phone = $request->phone;
                $muser->fullname = $request->fullname;
                $muser->password = md5($request->password);
                $muser->thumb = 'user.png';
                $muser->address = '';
                $muser->gender = 0;
                $muser->status = 1;
                $muser->save();
            }
        }
    }

    public function postLogin(Request $request)
    {
        if ($request->ajax()) {
            $rules = array(
                'usernameLogin' => 'required|min:3|max:255|regex:/^[A-Za-z0-9_\.]{3,32}$/',
                'passwordLogin' => 'required|regex:/^([a-zA-Z]){1}([\w_\.!@#$%^&*()]+){3,32}$/'
            );

            $msg = array(
                'usernameLogin.required' => ''.__('validate.requiredUsername').'',
                'usernameLogin.min' => ''.__('validate.minUsername').'',
                'usernameLogin.max' => ''.__('validate.maxUsername').'',
                'usernameLogin.regex' => ''.__('validate.regexUsername').'',
                'passwordLogin.required' => ''.__('validate.requiredPassword').'',
                'passwordLogin.regex' => ''.__('validate.regexPassword').''
            );

            $validator = Validator::make($request->all(), $rules, $msg);

            if ($validator->fails()) {
                return response()->json(
                    array (
                        'error' => $validator->getMessageBag()->toArray()
                    )
                );
            } else {
                $muser = new Muser;
                $username = $request->usernameLogin;
                $password = $request->passwordLogin;

                if($muser->checkLogin($username, md5($password))) {
                    $row = $muser->checkLogin($username, md5($password));

                    if($row['status'] == 1) {
                        $getData = [
                            'userAll' => $row,
                            'userFullname' => $row['fullname'], 
                            'userPhone' => $row['phone'], 
                            'userThumb' => $row['thumb'], 
                            'userId' => $row['id'],
                            'userEmail' => $row['email'],
                        ];
                        Session::put('userLogin', $getData);

                        return response()->json(
                            array (
                                'success' => 'Đăng nhập thành công!'
                            )
                        );
                    } else {
                        return response()->json(
                            array (
                                'danger' => 'Tài khoản này hiện đã bị khóa. Vui lòng liên hệ với cửa hàng để được hỗ trơ.'
                            )
                        );
                    }
                } else {
                    return response()->json(
                        array (
                            'danger' => 'Thông tin tài khoản hoặc mật khẩu không chính xác.'
                        )
                    );
                }
            }

        }
    }

    public function showLogin(Request $request)
    {
        if($request->ajax()) {
            $html = '';
            
            if(Session::has('userLogin')) {
                $html .= '<li>
                <a href="'.route('userProfile').'" class="dropdown-menu-link">
                '. __('header.infomation') .'
                </a>

                <a href="'.route('userOrderHistory').'" class="dropdown-menu-link">
                '. __('header.orderhistory') .'
                </a>
            </li>

            <li>
                <a href="javascript:void(0)" id="postLogout" class="dropdown-menu-link">
                '. __('header.logout') .'
                </a>
            </li>   ';
            } else {
                $html .= '<li>
                <a href="javascript:void(0)" class="dropdown-menu-link" data-toggle="modal" data-target="#dataLogin">
                    '. __('header.login') .'
                </a>
            </li>

            <li>
                <a href="javascript:void(0)" class="dropdown-menu-link" data-toggle="modal" data-target="#dataRegister">
                    '. __('header.register') .'
                </a>
            </li>';
            }

            echo $html;
        }
    }

    public function showLoginName(Request $request)
    {
        if($request->ajax()) {
            $html = '';
            
            if(Session::has('userLogin')) {
                $getName = Session::get('userLogin.userFullname');
                $getThumb = Session::get('userLogin.userThumb');

                if($getThumb == 'user.png') {
                    $html .= '<img src="'.url('images/user.png').'" class="mr-2" width="30px" height="30px" alt="abc" />' .$getName;
                } else {
                    $html .= '<img src="'.url('uploads/user/'.$getThumb).'" class="mr-2" width="30px" height="30px" alt="abc" />' .$getName;
                }
            } else {
                $html .=  __('header.account') ;
            }

            echo $html;
        }
    }

    public function postLogout(Request $request)
    {
        if($request->ajax()) {
            $getData = [
                'userAll',
                'userFullname', 
                'userPhone', 
                'userThumb', 
                'userId',
                'userEmail',
            ];
            Session::forget('userLogin');
        }
    }
}
