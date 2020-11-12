@extends('layout.backend.layout')

@section('title', 'Thêm mới sản phẩm')

@section('linkCSS')
    <link href="{{ url('') }}\assets\libs\select2\select2.min.css" rel="stylesheet" type="text/css">
    <link href="{{ url('') }}\assets\libs\dropify\dropify.min.css" rel="stylesheet" type="text/css">
    <!-- dropzone css -->
    <link href="{{ url('') }}\assets\libs\dropzone\dropzone.min.css" rel="stylesheet" type="text/css">
    <!-- Summernote css -->
    <link href="{{ url('') }}\assets\libs\summernote\summernote-bs4.css" rel="stylesheet" type="text/css">
@endsection

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a class="text-capitalize" href="javascript: void(0);">Circle</a></li>
                        <li class="breadcrumb-item"><a class="text-capitalize" href="javascript: void(0);">sản phẩm</a></li>
                        <li class="breadcrumb-item active text-capitalize">Thêm mới</li>
                    </ol>
                </div>
                <h4 class="page-title text-uppercase">Thêm mới sản phẩm</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <a href="{{ route('adminProduct') }}" class="btn btn-danger waves-effect waves-light mb-4"><i
            class="remixicon-delete-back-2-line mr-2"></i> Quay Lại</a>

    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <h4 class="header-title text-capitalize mb-3">Tiêu đề thêm mới</h4>

                <form action="{{ route('adminProductPostAdd') }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="text-capitalize">Tên sản phẩm</label>
                                <input type="text" value="{{ old('name') }}"
                                    class="form-control @error('name') parsley-error @enderror" name="name">

                                @error('name')
                                <ul class="parsley-errors-list filled">
                                    <li class="parsley-required">{{ $message }}</li>
                                </ul>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="control-label text-capitalize">Mã sản phẩm</label>
                                <input type="text" value="{{ old('sku') }}"
                                    class="form-control @error('sku') parsley-error @enderror" name="sku">

                                @error('sku')
                                <ul class="parsley-errors-list filled">
                                    <li class="parsley-required">{{ $message }}</li>
                                </ul>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label class="text-capitalize">Số lượng</label>
                                <input type="text" value="{{ old('quantity') }}"
                                    class="form-control @error('quantity') parsley-error @enderror" name="quantity">

                                @error('quantity')
                                <ul class="parsley-errors-list filled">
                                    <li class="parsley-required">{{ $message }}</li>
                                </ul>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label class="control-label text-capitalize">Giá gốc</label>
                                <input type="text" value="{{ old('price') }}"
                                    class="form-control @error('price') parsley-error @enderror" name="price">

                                @error('price')
                                <ul class="parsley-errors-list filled">
                                    <li class="parsley-required">{{ $message }}</li>
                                </ul>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label class="control-label text-capitalize">Khuyễn mãi (%)</label>
                                <input type="text" value="{{ old('sale') ? old('sale') : 0 }}"
                                    class="form-control @error('sale') parsley-error @enderror" name="sale">

                                @error('sale')
                                <ul class="parsley-errors-list filled">
                                    <li class="parsley-required">{{ $message }}</li>
                                </ul>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label class="text-capitalize">Danh mục</label>
                                <select class="form-control select2" name="catid">
                                    <option value="" selected>[--- Chọn danh mục --- ]</option>
                                    @foreach ($listCatalog as $key => $category)
                                        <option value="{{ $key }}" {{ old('catid') == $key ? 'selected' : '' }}>
                                            {{ $category }} </option>
                                    @endforeach
                                </select>

                                @error('catid')
                                <ul class="parsley-errors-list filled">
                                    <li class="parsley-required">{{ $message }}</li>
                                </ul>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label class="control-label text-capitalize">Thương hiệu</label>
                                <select class="form-control select2" name="brandid">
                                    <option value="" selected>[--- Chọn thương hiệu --- ]</option>
                                    @foreach ($listBrand as $item)
                                        <option value="{{ $item['id'] }}"
                                            {{ old('brandid') == $item['id'] ? 'selected' : '' }}>
                                            {{ $item['name'] }} </option>
                                    @endforeach
                                </select>

                                @error('brandid')
                                <ul class="parsley-errors-list filled">
                                    <li class="parsley-required">{{ $message }}</li>
                                </ul>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label class="control-label text-capitalize">Nhà cung cấp</label>
                                <select class="form-control select2" name="producerid">
                                    <option value="" selected>[--- Chọn nhà cung cấp --- ]</option>
                                    @foreach ($listProducer as $item)
                                        <option value="{{ $item['id'] }}"
                                            {{ old('producerid') == $item['id'] ? 'selected' : '' }}>
                                            {{ $item['name'] }} </option>
                                    @endforeach
                                </select>

                                @error('producerid')
                                <ul class="parsley-errors-list filled">
                                    <li class="parsley-required">{{ $message }}</li>
                                </ul>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label text-capitalize">Ảnh đại diện</label>
                        <input type="file" class="dropify" name="thumb">

                        @error('thumb')
                        <ul class="parsley-errors-list filled">
                            <li class="parsley-required">{{ $message }}</li>
                        </ul>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="control-label text-capitalize">Ảnh kèm theo</label>
                        <div class="input-images-1" style="padding-top: .5rem;"></div>

                        @error('thumb_list')
                        <ul class="list-unstyled mt-1">
                            <li class="parsley-required text-danger"> </li>
                        </ul>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Mô tả ngắn</label>
                        <div>
                            <textarea class="form-control @error('intro_desc') parsley-error @enderror"
                                name="intro_desc" rows="5"> {{ old('intro_desc') }}</textarea>
                        </div>

                        @error('intro_desc')
                        <ul class="parsley-errors-list filled">
                            <li class="parsley-required">{{ $message }}</li>
                        </ul>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Chi tiết sản phẩm</label>
                        <textarea id="summernote-editor" class="@error('detail_desc') parsley-error @enderror" name="detail_desc"
                            rows="5"> {{ old('detail_desc') }}</textarea>

                        @error('detail_desc')
                        <ul class="parsley-errors-list filled">
                            <li class="parsley-required">{{ $message }}</li>
                        </ul>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label class="text-capitalize">Meta Title (SEO)</label>
                        <textarea class="form-control @error('meta_title') parsley-error @enderror" name="meta_title"
                            rows="5">{{ old('meta_title') }}</textarea>
                        @error('meta_title')
                        <ul class="parsley-errors-list filled">
                            <li class="parsley-required">{{ $message }}</li>
                        </ul>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label class="text-capitalize">Meta Keyword (SEO)</label>
                        <textarea class="form-control @error('meta_keyword') parsley-error @enderror" name="meta_keyword"
                            rows="5">{{ old('meta_keyword') }}</textarea>

                        @error('meta_keyword')
                        <ul class="parsley-errors-list filled">
                            <li class="parsley-required">{{ $message }}</li>
                        </ul>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label class="text-capitalize">Meta Description (SEO)</label>
                        <textarea class="form-control @error('meta_desc') parsley-error @enderror"
                            name="meta_desc" rows="5">{{ old('meta_desc') }}</textarea>

                        @error('meta_desc')
                        <ul class="parsley-errors-list filled">
                            <li class="parsley-required">{{ $message }}</li>
                        </ul>
                        @enderror
                    </div>

                    <div class="form-group mb-0">
                        <div>
                            <button type="submit" class="btn btn-primary waves-effect waves-light mr-1 text-capitalize">
                                Thêm mới
                            </button>
                            <button type="reset" class="btn btn-secondary waves-effect">
                                Cancel
                            </button>
                        </div>
                    </div>
                </form>

            </div> <!-- end card-box-->

        </div>
        <!-- end col -->
    </div>
@endsection

@section('linkJS')
    <script src="{{ url('') }}\assets\libs\multiselect\jquery.multi-select.js"></script>
    <script src="{{ url('') }}\assets\libs\select2\select2.min.js"></script>
    <script src="{{ url('') }}\assets\libs\dropify\dropify.min.js"></script>
    <!-- dropzone plugin -->
    <script src="{{ url('') }}\assets\libs\dropzone\dropzone.min.js"></script>
    <!-- Summernote js -->
    <script src="{{ url('') }}\assets\libs\summernote\summernote-bs4.min.js"></script>
    <!-- init js -->
    <script src="{{ url('') }}\assets\js\pages\form-summernote.init.js"></script>
    <script src="{{ url('') }}\assets\js\pages\dropify.init.js"></script>
    <script src="{{ url('') }}\assets\js\pages\form-advanced.init.js"></script>
    <script>
        $('.input-images-1').imageUploader();
    </script>
@endsection
