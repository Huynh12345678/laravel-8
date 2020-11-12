<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mproducer;

class ProducerController extends Controller
{
    public function index()
    {
        $list = Mproducer::orderBy('created_at', 'desc')
        ->get();

        $no = 1;

        return view('backend.producer.index', compact('list', 'no'));
    }

    public function add()
    {
        return view('backend.producer.add');
    }

    public function postAdd(Request $request)
    {
        $this->validate(
            $request,
            [
                'name' => 'required|min:3|max:255|unique:producer,name',
                'email' => 'required|regex:/(.+)@(.+)\.(.+)/i',
                'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|max:11',
                'website' => 'required|url',
                'address' => 'required',
                'thumb' => 'file|mimes:jpg,jpeg,png,gif',
            ],
            [
                'name.required' => 'Tên nhà cung cấp không được bỏ trống.',
                'name.min' => 'Tên nhà cung cấp không được ít hơn 3 kí tự.',
                'name.max' => 'Tên nhà cung cấp không được vượt quá 255 kí tự.',
                'email.required' => 'Email không được bỏ trống.',
                'email.regex' => 'Email không hợp lệ.',
                'phone.required' => 'Số điện thoại không được bỏ trống.',
                'phone.regex' => 'Số điện thoại không hợp lệ.',
                'phone.max' => 'Số điện thoại không được vượt quá 11 ký tự.',
                'website.required' => 'Website không được bỏ trống.',
                'address.required' => 'Địa chỉ không được bỏ trống.',
                'website.url' => 'Website phải là một đường dẫn hợp lệ',
                'name.unique' => 'Tên nhà cung cấp này đã tồn tại',
                'thumb.mimes' => 'Tệp vừa chọn không phải là hình ảnh.',
            ]
        );

        if ($request->hasFile('thumb')) {
            $destinationPath = 'uploads/producer/';
            $profileImage = date('YmdHis') . "." . $request->file('thumb')->getClientOriginalExtension();
            $request->file('thumb')->move($destinationPath, $profileImage);
        } else {
            $profileImage = 'default.jpg';
        }

        $mproducer = new Mproducer;
        $mproducer->name = $request->name;
        $mproducer->address = $request->address;
        $mproducer->phone = $request->phone;
        $mproducer->email = $request->email;
        $mproducer->website = $request->website;
        $mproducer->thumb = $profileImage;
        $mproducer->status = 1;
        $mproducer->save();
        $request->session()->flash('success', 'Thêm thành công nhà cung cấp!');

        return redirect()->route('adminProducer');
    }

    public function edit($id)
    {
        $mproducer = new Mproducer;
        $row = $mproducer->find($id);
        if (!$row) {
            return view('error');
        }

        return view('backend.producer.edit', compact('row'));
    }

    public function postEdit(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                'name' => 'required|min:3|max:255',
                'email' => 'required|regex:/(.+)@(.+)\.(.+)/i',
                'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|max:11',
                'website' => 'required|url',
                'address' => 'required',
                'thumb' => 'file|mimes:jpg,jpeg,png,gif',
            ],
            [
                'name.required' => 'Tên nhà cung cấp không được bỏ trống.',
                'name.min' => 'Tên nhà cung cấp không được ít hơn 3 kí tự.',
                'name.max' => 'Tên nhà cung cấp không được vượt quá 255 kí tự.',
                'email.required' => 'Email không được bỏ trống.',
                'email.regex' => 'Email không hợp lệ.',
                'phone.required' => 'Số điện thoại không được bỏ trống.',
                'phone.regex' => 'Số điện thoại không hợp lệ.',
                'phone.max' => 'Số điện thoại không được vượt quá 11 ký tự.',
                'website.required' => 'Website không được bỏ trống.',
                'address.required' => 'Địa chỉ không được bỏ trống.',
                'website.url' => 'Website phải là một đường dẫn hợp lệ',
                'thumb.mimes' => 'Tệp vừa chọn không phải là hình ảnh.',
            ]
        );

        $mproducer = new Mproducer;
        $mproducer = $mproducer->find($id);
        $row =  $mproducer->find($id);

        if ($request->hasFile('thumb')) {
            $destinationPath = 'uploads/producer/';
            $profileImage = date('YmdHis') . "." . $request->file('thumb')->getClientOriginalExtension();
            $request->file('thumb')->move($destinationPath, $profileImage);
            if ($row['thumb'] != 'default.jpg') {
                unlink('uploads/producer/' . $request->thumbOld);
            }
        } else {
            $profileImage = $request->thumbOld;
        }

        $mproducer->name = $request->name;
        $mproducer->address = $request->address;
        $mproducer->phone = $request->phone;
        $mproducer->email = $request->email;
        $mproducer->website = $request->website;
        $mproducer->thumb = $profileImage;
        $mproducer->save();
        $request->session()->flash('success', 'Cập nhật thành công nhà cung cấp!');

        return redirect()->route('adminProducer');
    }

    public function status(Request $request, $id) 
    {
        $mproducer = new Mproducer;
        $mproducer = $mproducer->find($id);
        $row =  $mproducer->find($id);
        if(!$row) {
            return view('error');
        }
        if($row['status'] == 1) {
            $mproducer->status = 0;
            $mproducer->save();
            $request->session()->flash('success', 'Trạng thái của danh mục ' . $row['name'] . ' đã được ẩn.');
        } else {
            $mproducer->status = 1;
            $mproducer->save();
            $request->session()->flash('success', 'Trạng thái của danh mục ' . $row['name'] . ' đã được hiển thị.');
        }
        return redirect()->route('adminProducer');
    }

    public function delete(Request $request, $id)
    {
        $mproducer = new Mproducer;
        $mproducer = $mproducer->find($id);
        $row =  $mproducer->find($id);
        if(!$row) {
            return view('error');
        }

        $mproducer->delete();
        $request->session()->flash('success', 'Danh mục ' . $row['name'] . ' đã được xóa vĩnh viễn.');
        if ($row['thumb'] != 'default.jpg') {
            unlink('uploads/producer/' . $row['thumb']);
        }
        return redirect()->route('adminProducer');
    }
}
