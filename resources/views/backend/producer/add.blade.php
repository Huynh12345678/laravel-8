@extends('layout.backend.layout')

@section('title', 'Thêm mới nhà cung cấp')

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
                        <li class="breadcrumb-item"><a class="text-capitalize" href="javascript: void(0);">nhà cung cấp</a></li>
                        <li class="breadcrumb-item active text-capitalize">Thêm mới</li>
                    </ol>
                </div>
                <h4 class="page-title text-uppercase">Thêm mới nhà cung cấp</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <a href="{{ route('adminProducer') }}" class="btn btn-danger waves-effect waves-light mb-4"><i
            class="remixicon-delete-back-2-line mr-2"></i> Quay Lại</a>

    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <h4 class="header-title text-capitalize mb-3">Tiêu đề thêm mới</h4>

                <form action="{{ route('adminProducerPostAdd') }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="text-capitalize">Tên nhà cung cấp</label>
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
                                <label class="text-capitalize">Số điện thoại</label>
                                <input type="text" value="{{ old('phone') }}"
                                    class="form-control @error('phone') parsley-error @enderror" name="phone">

                                @error('phone')
                                <ul class="parsley-errors-list filled">
                                    <li class="parsley-required">{{ $message }}</li>
                                </ul>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="text-capitalize">Email</label>
                                <input type="text" value="{{ old('email') }}"
                                    class="form-control @error('email') parsley-error @enderror" name="email">

                                @error('email')
                                <ul class="parsley-errors-list filled">
                                    <li class="parsley-required">{{ $message }}</li>
                                </ul>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="text-capitalize">Website</label>
                                <input type="text" value="{{ old('website') }}"
                                    class="form-control @error('website') parsley-error @enderror" name="website">

                                @error('website')
                                <ul class="parsley-errors-list filled">
                                    <li class="parsley-required">{{ $message }}</li>
                                </ul>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Địa chỉ</label>
                        <div>
                            <textarea class="form-control @error('address') parsley-error @enderror"
                                name="address" rows="5"> {{ old('address') }} </textarea>
                        </div>

                        @error('address')
                        <ul class="parsley-errors-list filled">
                            <li class="parsley-required">{{ $message }}</li>
                        </ul>
                        @enderror
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
    <script src="{{ url('') }}\assets\libs\dropify\dropify.min.js"></script>

    <!-- init js -->
    <script src="{{ url('') }}\assets\js\pages\dropify.init.js"></script>
@endsection
