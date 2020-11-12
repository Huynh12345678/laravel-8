<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Mproduct;
use App\Models\Mcatalog;
use App\Models\Mbrand;
use App\Models\Mproducer;

class ProductController extends Controller
{
    public function index()
    {
        $no = 1;
        $list= Mproduct::where('trash', 1)->orderBy('created_at', 'desc')->get();
        $listRecycleCount = Mproduct::where('trash', 0)->count();
        return view('backend.product.index', compact('list', 'listRecycleCount', 'no'));
    }

    public function recycle()
    {
        $no = 1;
        $list= Mproduct::where('trash', 0)->orderBy('created_at', 'desc')->get();
        return view('backend.product.recycle', compact('list', 'no'));
    }

    public function add()
    {
        $mcatalog = new Mcatalog;
        $listCatalog =  $mcatalog->catalogTreeList();
        $listBrand = Mbrand::select('name', 'id')->where('status', 1)->get();
        $listProducer = Mproducer::select('name', 'id')->where('status', 1)->get();
        return view('backend.product.add', compact('listBrand', 'listProducer', 'listCatalog'));
    }

    public function postAdd(Request $request)
    {
        $this->validate(
            $request,
            [
                'name' => 'required|min:3|max:255',
                'sku' => 'required|min:2|max:10',
                'quantity' => 'required|integer',
                'price' => 'required|integer',
                'sale' => 'required|numeric',
                'catid' => 'required',
                'producerid' => 'required',
                'intro_desc' => 'required|max:255',
                'detail_desc' => 'required',
                'thumb' => 'file|mimes:jpg,jpeg,png,gif',
                'meta_title' => 'required|max:150',
                'meta_keyword' => 'required|max:150',
                'meta_desc' => 'required'
            ],
            [
                'name.required' => 'Tên sản phẩm không được bỏ trống.',
                'name.min' => 'Tên sản phẩm không được ít hơn 3 kí tự.',
                'name.max' => 'Tên sản phẩm không được vượt quá 255 kí tự.',
                'sku.required' => 'Mã sản phẩm không được bỏ trống.',
                'sku.min' => 'Mã sản phẩm không được ít hơn 2 kí tự.',
                'sku.max' => 'Mã sản phẩm không được vượt quá 10 kí tự.',
                'quantity.required' => 'Số lượng không được bỏ trống.',
                'quantity.integer' => 'Số lượng phải là một số nguyên dương.',
                'price.required' => 'Giá gốc không được bỏ trống.',
                'price.integer' => 'Gía gốc phải là một số nguyên dương.',
                'sale.required' => 'Khuyễn mãi không được bỏ trống.',
                'sale.integer' => 'Khuyễn mãi là một số (1 - 99).',
                'catid.required' => 'Danh mục không được bỏ trống.',
                'producerid.required' => 'Nhà cung cấp không được bỏ trống.',
                'intro_desc.required' => 'Mô tả ngắn không được bỏ trống.',
                'intro_desc.max' => 'Mô tả ngắn không được vượt quá 255 ký tự.',
                'detail_desc.required' => 'Chi tiết sản phẩm không được bỏ trống.',
                'thumb.mimes' => 'Tệp vừa chọn không phải là hình ảnh.',
                'meta_title.required' => 'Meta Title (SEO) không được bỏ trống.',
                'meta_title.max' => 'Meta Title (SEO) không được vượt quá 150 kí tự.',
                'meta_keyword.required' => 'Meta Keyword (SEO) không được bỏ trống.',
                'meta_keyword.max' => 'Meta Keyword (SEO) không được vượt quá 150 kí tự.',
                'meta_desc.required' => 'Meta Description (SEO) không được bỏ trống.',
            ]
        );

        if ($request->hasFile('thumb')) {
            $destinationPath = 'uploads/product/';
            $profileImage = date('YmdHis') . "." . $request->file('thumb')->getClientOriginalExtension();
            $request->file('thumb')->move($destinationPath, $profileImage);
        } else {
            $profileImage = 'default.jpg';
        }

        if (isset($request->brandid)) {
            $brandid = $request->brandid;
        } else {
            $brandid = 10;
        }

        $imagesMultiple = array();
        $i = 0;
        if ($files = $request->file('images')) {
            foreach ($files as $file) {
                $name = date('YmdHis') . $i . "." . $file->getClientOriginalExtension();
                $file->move('uploads/product', $name);
                $imagesMultiple[] = $name;
                $i++;
            }
        } else {
            $imagesMultiple = [];
        }

        $mproduct = new Mproduct;
        $checkSlug = $mproduct->where('slug', Str::slug($request->name, '-'))->count();
        if ($checkSlug > 0) {
            $request->session()->flash('error', 'Sản phẩm này đã tồn tại!');
        } else {
            $mproduct->name = $request->name;
            $mproduct->sku = $request->sku;
            $mproduct->slug = Str::slug($request->name, '-');
            $mproduct->thumb = $profileImage;
            $mproduct->thumb_list = implode(",", $imagesMultiple);
            $mproduct->price = $request->price;
            $mproduct->sale = $request->sale;
            $mproduct->quantity = $request->quantity;
            $mproduct->number_buy = 0;
            $mproduct->catid = $request->catid;
            $mproduct->brandid = $brandid;
            $mproduct->producerid = $request->producerid;
            $mproduct->view = 0;
            $mproduct->featured = 0;
            $mproduct->status = 1;
            $mproduct->trash = 1;
            $mproduct->intro_desc = $request->intro_desc;
            $mproduct->detail_desc = $request->detail_desc;
            $mproduct->meta_title = $request->meta_title;
            $mproduct->meta_keyword = $request->meta_keyword;
            $mproduct->meta_desc = $request->meta_desc;
            $mproduct->save();
            $request->session()->flash('success', 'Thêm thành công sản phẩm!');
        }
        return redirect()->route('adminProduct');
    }

    public function edit($id)
    {
        $mcatalog = new Mcatalog;
        $row = Mproduct::find($id);
        if (!$row) {
            return view('error');
        }

        $listCatalog =  $mcatalog->catalogTreeList();
        $listBrand = Mbrand::select('name', 'id')->where('status', 1)->get();
        $listProducer = Mproducer::select('name', 'id')->where('status', 1)->get();
        return view('backend.product.edit', compact('listBrand', 'listProducer', 'listCatalog', 'row'));
    }

    public function postEdit(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                'name' => 'required|min:3|max:255',
                'sku' => 'required|min:2|max:10',
                'quantity' => 'required|integer',
                'price' => 'required|integer',
                'sale' => 'required|numeric',
                'catid' => 'required',
                'producerid' => 'required',
                'intro_desc' => 'required|max:255',
                'detail_desc' => 'required',
                'thumb' => 'file|mimes:jpg,jpeg,png,gif',
                'meta_title' => 'required|max:150',
                'meta_keyword' => 'required|max:150',
                'meta_desc' => 'required'
            ],
            [
                'name.required' => 'Tên sản phẩm không được bỏ trống.',
                'name.min' => 'Tên sản phẩm không được ít hơn 3 kí tự.',
                'name.max' => 'Tên sản phẩm không được vượt quá 255 kí tự.',
                'sku.required' => 'Mã sản phẩm không được bỏ trống.',
                'sku.min' => 'Mã sản phẩm không được ít hơn 2 kí tự.',
                'sku.max' => 'Mã sản phẩm không được vượt quá 10 kí tự.',
                'quantity.required' => 'Số lượng không được bỏ trống.',
                'quantity.integer' => 'Số lượng phải là một số nguyên dương.',
                'price.required' => 'Giá gốc không được bỏ trống.',
                'price.integer' => 'Gía gốc phải là một số nguyên dương.',
                'sale.required' => 'Khuyễn mãi không được bỏ trống.',
                'sale.integer' => 'Khuyễn mãi là một số (1 - 99).',
                'catid.required' => 'Danh mục không được bỏ trống.',
                'producerid.required' => 'Nhà cung cấp không được bỏ trống.',
                'intro_desc.required' => 'Mô tả ngắn không được bỏ trống.',
                'intro_desc.max' => 'Mô tả ngắn không được vượt quá 255 ký tự.',
                'detail_desc.required' => 'Chi tiết sản phẩm không được bỏ trống.',
                'thumb.mimes' => 'Tệp vừa chọn không phải là hình ảnh.',
                'meta_title.required' => 'Meta Title (SEO) không được bỏ trống.',
                'meta_title.max' => 'Meta Title (SEO) không được vượt quá 150 kí tự.',
                'meta_keyword.required' => 'Meta Keyword (SEO) không được bỏ trống.',
                'meta_keyword.max' => 'Meta Keyword (SEO) không được vượt quá 150 kí tự.',
                'meta_desc.required' => 'Meta Description (SEO) không được bỏ trống.',
            ]
        );

        $mproduct = new Mproduct;
        $mproduct = $mproduct->find($id);
        $row =  $mproduct->find($id);

        if ($request->hasFile('thumb')) {
            $destinationPath = 'uploads/product/';
            $profileImage = date('YmdHis') . "." . $request->file('thumb')->getClientOriginalExtension();
            $request->file('thumb')->move($destinationPath, $profileImage);
            if ($row['thumb'] != 'default.jpg') {
                unlink('uploads/product/' . $request->thumbOld);
            }
        } else {
            $profileImage = $request->thumbOld;
        }

        $imagesMultiple = array();
        $i = 0;
        if ($request->hasFile('images')) {
            if ($files = $request->file('images')) {
                foreach ($files as $file) {
                    $name = date('YmdHis') . $i . "." . $file->getClientOriginalExtension();
                    $file->move('uploads/product', $name);
                    $imagesMultiple[] = $name;
                    $i++;
                }

                $thumb_list = explode(',', $row['thumb_list']);
                foreach ($thumb_list as $img) {
                    unlink('uploads/product/' . $img);
                }
            }
        } else {
            $imagesMultiple = $request->imagesUploads;
        }

        if (isset($request->brandid)) {
            $brandid = $request->brandid;
        } else {
            $brandid = 0;
        }

        $mproduct->name = $request->name;
        $mproduct->sku = $request->sku;
        $mproduct->slug = Str::slug($request->name, '-');
        $mproduct->thumb = $profileImage;
        $mproduct->thumb_list = implode(",", $imagesMultiple);
        $mproduct->price = $request->price;
        $mproduct->sale = $request->sale;
        $mproduct->quantity = $request->quantity;
        $mproduct->catid = $request->catid;
        $mproduct->brandid = $brandid;
        $mproduct->producerid = $request->producerid;
        $mproduct->intro_desc = $request->intro_desc;
        $mproduct->detail_desc = $request->detail_desc;
        $mproduct->meta_title = $request->meta_title;
        $mproduct->meta_keyword = $request->meta_keyword;
        $mproduct->meta_desc = $request->meta_desc;
        $mproduct->save();
        $request->session()->flash('success', 'Cập nhật thành công sản phẩm!');
        return redirect()->route('adminProduct');
    }

    public function status(Request $request, $id)
    {
        $mproduct = new Mproduct;
        $mproduct = $mproduct->find($id);
        $row =  Mproduct::find($id);
        if (!$row) {
            return view('error');
        }
        if ($row['status'] == 1) {
            $mproduct->status = 0;
            $mproduct->save();
            $request->session()->flash('success', 'Trạng thái của sản phẩm ' . $row['name'] . ' đã được ẩn.');
        } else {
            $mproduct->status = 1;
            $mproduct->save();
            $request->session()->flash('success', 'Trạng thái của sản phẩm ' . $row['name'] . ' đã được hiển thị.');
        }
        return redirect()->route('adminProduct');
    }

    public function restore(Request $request, $id)
    {
        $mproduct = new Mproduct;
        $mproduct = $mproduct->find($id);
        $row =  $mproduct->find($id);
        if (!$row) {
            return view('error');
        }
        if ($row['trash'] == 0) {
            $mproduct->trash = 1;
            $mproduct->save();
            $request->session()->flash('success', 'Sản phẩm ' . $row['name'] . ' đã được khôi phục.');
        }
        return redirect()->route('adminProductRecycle');
    }

    public function trash(Request $request, $id)
    {
        $mproduct = new Mproduct;
        $mproduct = $mproduct->find($id);
        $row =  $mproduct->find($id);
        if (!$row) {
            return view('error');
        }

        if ($row['trash'] == 1) {
            $mproduct->trash = 0;
            $mproduct->save();
            $request->session()->flash('success', 'Sản phẩm ' . $row['name'] . ' đã được đưa vào thùng rác.');
        }
        return redirect()->route('adminProduct');
    }

    public function featured(Request $request, $id)
    {
        $mproduct = new Mproduct;
        $mproduct = $mproduct->find($id);
        $row =  Mproduct::find($id);
        if (!$row) {
            return view('error');
        }
        if ($row['featured'] == 1) {
            $mproduct->featured = 0;
            $mproduct->save();
            $request->session()->flash('success', 'Trạng thái của sản phẩm ' . $row['name'] . ' đã được tắt nổi bật.');
        } else {
            $mproduct->featured = 1;
            $mproduct->save();
            $request->session()->flash('success', 'Trạng thái của sản phẩm ' . $row['name'] . ' đã được hiển thị nổi bật.');
        }
        return redirect()->route('adminProduct');
    }

    public function delete(Request $request, $id)
    {
        $mproduct = new Mproduct;
        $mproduct = $mproduct->find($id);
        $row =  $mproduct->find($id);
        if (!$row) {
            return view('error');
        }
        $mproduct->delete();
        $request->session()->flash('success', 'Sản phẩm ' . $row['name'] . ' đã được xóa vĩnh viễn.');
        if ($row['thumb'] != 'default.jpg') {
            unlink('uploads/product/' . $row['thumb']);
        }

        $thumb_list = explode(',', $row['thumb_list']);
        foreach ($thumb_list as $img) {
            unlink('uploads/product/' . $img);
        }
        return redirect()->route('adminProductRecycle');
    }
}
