<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Muser;

class UsersController extends Controller
{
    public function index()
    {
        $list = Muser::orderBy('created_at', 'desc')
        ->get();

        $no = 1;

        return view('backend.user.index', compact('list', 'no'));
    }

    public function status(Request $request, $id) 
    {
        $muser = new Muser;
        $muser = $muser->find($id);
        $row =  $muser->find($id);
        if(!$row) {
            return view('error');
        }
        if($row['status'] == 1) {
            $muser->status = 0;
            $muser->save();
            $request->session()->flash('success', 'Khóa tài khoản của khách hàng ' . $row['fullname'] . ' thành công.');
        } else {
            $muser->status = 1;
            $muser->save();
            $request->session()->flash('success', 'Khách hàng ' . $row['fullname'] . ' đã được hoạt động bình thường.');
        }
        return redirect()->route('adminUser');
    }

    public function delete(Request $request, $id)
    {
        $muser = new Muser;
        $muser = $muser->find($id);
        $row =  $muser->find($id);
        if(!$row) {
            return view('error');
        }

        $muser->delete();
        $request->session()->flash('success', 'Khách hàng ' . $row['fullname'] . ' đã được xóa vĩnh viễn.');
        return redirect()->route('adminUser');
    }
}
