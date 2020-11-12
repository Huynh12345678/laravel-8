@extends('layout.backend.layout')

@section('title', 'Thêm mới danh mục sản phẩm')

@section('linkCSS')
    <link href="{{ url('') }}\assets\libs\select2\select2.min.css" rel="stylesheet" type="text/css">
    <link href="{{ url('') }}\assets\libs\dropify\dropify.min.css" rel="stylesheet" type="text/css">
@endsection

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a class="text-capitalize" href="javascript: void(0);">Circle</a></li>
                        <li class="breadcrumb-item"><a class="text-capitalize" href="javascript: void(0);">Danh mục sản
                                phẩm</a></li>
                        <li class="breadcrumb-item active text-capitalize">Thêm mới</li>
                    </ol>
                </div>
                <h4 class="page-title text-uppercase">Thêm mới danh mục</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <a href="{{ route('adminCatalog') }}" class="btn btn-danger waves-effect waves-light mb-4"><i
            class="remixicon-delete-back-2-line mr-2"></i> Quay Lại</a>

    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <h4 class="header-title text-capitalize mb-3">Tiêu đề thêm mới</h4>

                <form action="{{ route('adminCatalogPostAdd') }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="text-capitalize">Tên danh mục sản phẩm</label>
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
                                <label class="text-capitalize">Danh mục cha</label>
                                <select class="form-control select2" name="parent_id">
                                    <option value="">[--- Chọn danh mục cha ---]</option>
                                    <option value="0" {{ old('parent_id') == 0 ? 'selected' : '' }}>
                                        Là danh mục cha
                                    </option>
                                    @foreach ($listCat as $key => $category)
                                        <option value="{{ $key }}" {{ old('parent_id') == $key ? 'selected' : '' }}>
                                            {{ $category }} </option>
                                    @endforeach
                                </select>

                                @error('parent_id')
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
                        <textarea class="form-control @error('meta_description') parsley-error @enderror"
                            name="meta_description" rows="5">{{ old('meta_description') }}</textarea>

                        @error('meta_description')
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

    <!-- init js -->
    <script src="{{ url('') }}\assets\js\pages\dropify.init.js"></script>
    <script src="{{ url('') }}\assets\js\pages\form-advanced.init.js"></script>
@endsection
