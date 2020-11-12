<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mslider;

class SliderController extends Controller
{
    public function index()
    {
        $list = Mslider::orderBy('created_at', 'desc')
        ->get();

        $no = 1;

        return view('backend.slider.index', compact('list', 'no'));
    }

    public function add()
    {
        return view('backend.slider.add');
    }

    public function postAdd(Request $request)
    {
        $this->validate(
            $request,
            [
                'name' => 'required|min:3|max:50|unique:slider,name',
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
            $destinationPath = 'uploads/slider/';
            $profileImage = date('YmdHis') . "." . $request->file('thumb')->getClientOriginalExtension();
            $request->file('thumb')->move($destinationPath, $profileImage);
        } else {
            $profileImage = 'default.jpg';
        }

        $mslider = new Mslider;
        $mslider->name = $request->name;
        $mslider->thumb = $profileImage;
        $mslider->status = 1;
        $mslider->save();
        $request->session()->flash('success', 'Thêm thành công slider!');

        return redirect()->route('adminSlider');
    }

    public function edit($id)
    {
        $mslider = new Mslider;
        $row = $mslider->find($id);
        if (!$row) {
            return view('error');
        }

        return view('backend.slider.edit', compact('row'));
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

        $mslider = new Mslider;
        $mslider = $mslider->find($id);
        $row =  $mslider->find($id);

        if ($request->hasFile('thumb')) {
            $destinationPath = 'uploads/slider/';
            $profileImage = date('YmdHis') . "." . $request->file('thumb')->getClientOriginalExtension();
            $request->file('thumb')->move($destinationPath, $profileImage);
            if ($row['thumb'] != 'default.jpg') {
                unlink('uploads/slider/' . $request->thumbOld);
            }
        } else {
            $profileImage = $request->thumbOld;
        }

        $mslider->name = $request->name;
        $mslider->thumb = $profileImage;
        $mslider->save();
        $request->session()->flash('success', 'Cập nhật thành công slider!');

        return redirect()->route('adminSlider');
    }

    public function status(Request $request, $id) 
    {
        $mslider = new Mslider;
        $mslider = $mslider->find($id);
        $row =  $mslider->find($id);
        if(!$row) {
            return view('error');
        }
        if($row['status'] == 1) {
            $mslider->status = 0;
            $mslider->save();
            $request->session()->flash('success', 'Trạng thái của slider ' . $row['name'] . ' đã được ẩn.');
        } else {
            $mslider->status = 1;
            $mslider->save();
            $request->session()->flash('success', 'Trạng thái của slider ' . $row['name'] . ' đã được hiển thị.');
        }
        return redirect()->route('adminSlider');
    }

    public function delete(Request $request, $id)
    {
        $mslider = new Mslider;
        $mslider = $mslider->find($id);
        $row =  $mslider->find($id);
        if(!$row) {
            return view('error');
        }

        $mslider->delete();
        $request->session()->flash('success', 'Slider ' . $row['name'] . ' đã được xóa vĩnh viễn.');
        if ($row['thumb'] != 'default.jpg') {
            unlink('uploads/slider/' . $row['thumb']);
        }
        return redirect()->route('adminSlider');
    }
}
