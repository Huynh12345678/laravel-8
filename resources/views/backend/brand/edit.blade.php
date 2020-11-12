@extends('layout.backend.layout')

@section('title', 'Cập nhật thương hiệu')

@section('linkCSS')
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
                        <li class="breadcrumb-item"><a class="text-capitalize" href="javascript: void(0);">thương hiệu</a></li>
                        <li class="breadcrumb-item active text-capitalize">Cập nhật</li>
                    </ol>
                </div>
                <h4 class="page-title text-uppercase">Cập nhật thương hiệu</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <a href="{{ route('adminBrand') }}" class="btn btn-danger waves-effect waves-light mb-4"><i
            class="remixicon-delete-back-2-line mr-2"></i> Quay Lại</a>

    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <h4 class="header-title text-capitalize mb-3">Tiêu đề Cập nhật</h4>

                <form action="{{ route('adminBrandPostEdit', $row['id']) }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <input type="hidden" name="thumbOld" value="{{ $row['thumb'] }} ">
                    <div class="form-row">
                        <div class="col-12">
                            <div class="form-group mb-3">
                                <label class="text-capitalize">Tên thương hiệu</label>
                                <input type="text" value="{{ old('name') ? old('name') : $row['name'] }}"
                                    class="form-control @error('name') parsley-error @enderror" name="name">

                                @error('name')
                                <ul class="parsley-errors-list filled">
                                    <li class="parsley-required">{{ $message }}</li>
                                </ul>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label text-capitalize">Ảnh đại diện</label>
                        <input type="file" class="dropify" name="thumb" data-default-file="<?= $row['thumb'] == 'default.jpg' ? url('uploads/' . $row['thumb']) : url('uploads/brand/'.$row['thumb']) ?>">
                        
                        @error('thumb')
                            <ul class="parsley-errors-list filled">
                                <li class="parsley-required">{{ $message }}</li>
                            </ul>
                        @enderror
                    </div>

                    <div class="form-group mb-0">
                        <div>
                            <button type="submit" class="btn btn-primary waves-effect waves-light mr-1 text-capitalize">
                                Cập nhật
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
    <script src="{{ url('') }}\assets\libs\dropify\dropify.min.js"></script>

    <!-- init js -->
    <script src="{{ url('') }}\assets\js\pages\dropify.init.js"></script>
@endsection
