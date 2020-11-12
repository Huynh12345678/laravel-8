<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mbrand;

class BrandController extends Controller
{
    public function index()
    {
        $list = Mbrand::orderBy('created_at', 'desc')
        ->get();

        $no = 1;

        return view('backend.brand.index', compact('list', 'no'));
    }

    public function add()
    {
        return view('backend.brand.add');
    }

    public function postAdd(Request $request)
    {
        $this->validate(
            $request,
            [
                'name' => 'required|min:3|max:50|unique:brand,name',
                'thumb' => 'file|mimes:jpg,jpeg,png,gif',
            ],
            [
                'name.required' => 'Tên thương hiệu không được bỏ trống.',
                'name.min' => 'Tên thương hiệu không được ít hơn 3 kí tự.',
                'name.max' => 'Tên thương hiệu không được vượt quá 50 kí tự.',
                'name.unique' => 'Tên thương hiệu này đã tồn tại',
                'thumb.mimes' => 'Tệp vừa chọn không phải là hình ảnh.',
            ]
        );

        if ($request->hasFile('thumb')) {
            $destinationPath = 'uploads/brand/';
            $profileImage = date('YmdHis') . "." . $request->file('thumb')->getClientOriginalExtension();
            $request->file('thumb')->move($destinationPath, $profileImage);
        } else {
            $profileImage = 'default.jpg';
        }

        $mbrand = new Mbrand;
        $mbrand->name = $request->name;
        $mbrand->thumb = $profileImage;
        $mbrand->status = 1;
        $mbrand->save();
        $request->session()->flash('success', 'Thêm thành công thương hiệu sản phẩm!');

        return redirect()->route('adminBrand');
    }

    public function edit($id)
    {
        $mbrand = new Mbrand;
        $row = $mbrand->find($id);
        if (!$row) {
            return view('error');
        }

        return view('backend.brand.edit', compact('row'));
    }

    public function postEdit(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                'name' => 'required|min:3|max:50',
                'thumb' => 'file|mimes:jpg,jpeg,png,gif',
            ],
            [
                'name.required' => 'Tên thương hiệu không được bỏ trống.',
                'name.min' => 'Tên thương hiệu không được ít hơn 3 kí tự.',
                'name.max' => 'Tên thương hiệu không được vượt quá 50 kí tự.',
                'thumb.mimes' => 'Tệp vừa chọn không phải là hình ảnh.',
            ]
        );

        $mbrand = new Mbrand;
        $mbrand = $mbrand->find($id);
        $row =  $mbrand->find($id);

        if ($request->hasFile('thumb')) {
            $destinationPath = 'uploads/brand/';
            $profileImage = date('YmdHis') . "." . $request->file('thumb')->getClientOriginalExtension();
            $request->file('thumb')->move($destinationPath, $profileImage);
            if ($row['thumb'] != 'default.jpg') {
                unlink('uploads/brand/' . $request->thumbOld);
            }
        } else {
            $profileImage = $request->thumbOld;
        }

        $mbrand->name = $request->name;
        $mbrand->thumb = $profileImage;
        $mbrand->save();
        $request->session()->flash('success', 'Cập nhật thành công thương hiệu sản phẩm!');

        return redirect()->route('adminBrand');
    }

    public function status(Request $request, $id) 
    {
        $mbrand = new Mbrand;
        $mbrand = $mbrand->find($id);
        $row =  $mbrand->find($id);
        if(!$row) {
            return view('error');
        }
        if($row['status'] == 1) {
            $mbrand->status = 0;
            $mbrand->save();
            $request->session()->flash('success', 'Trạng thái của thương hiệu ' . $row['name'] . ' đã được ẩn.');
        } else {
            $mbrand->status = 1;
            $mbrand->save();
            $request->session()->flash('success', 'Trạng thái của thương hiệu ' . $row['name'] . ' đã được hiển thị.');
        }
        return redirect()->route('adminBrand');
    }

    public function delete(Request $request, $id)
    {
        $mbrand = new Mbrand;
        $mbrand = $mbrand->find($id);
        $row =  $mbrand->find($id);
        if(!$row) {
            return view('error');
        }

        $mbrand->delete();
        $request->session()->flash('success', 'Thương hiệu ' . $row['name'] . ' đã được xóa vĩnh viễn.');
        if ($row['thumb'] != 'default.jpg') {
            unlink('uploads/brand/' . $row['thumb']);
        }
        return redirect()->route('adminBrand');
    }
}
