@extends('layout.backend.layout')

@section('title', 'Thêm mới coupon')

@section('linkCSS')
    <link href="{{ url('') }}\assets\libs\bootstrap-datepicker\bootstrap-datepicker.min.css" rel="stylesheet" type="text/css">
@endsection

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a class="text-capitalize" href="javascript: void(0);">Circle</a></li>
                        <li class="breadcrumb-item"><a class="text-capitalize" href="javascript: void(0);">Coupon</a></li>
                        <li class="breadcrumb-item active text-capitalize">Thêm mới</li>
                    </ol>
                </div>
                <h4 class="page-title text-uppercase">Thêm mới Coupon</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <a href="{{ route('adminCoupon') }}" class="btn btn-danger waves-effect waves-light mb-4"><i
            class="remixicon-delete-back-2-line mr-2"></i> Quay Lại</a>

    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <h4 class="header-title text-capitalize mb-3">Tiêu đề thêm mới</h4>

                <form action="{{ route('adminCouponPostAdd') }}" method="POST">
                    @csrf
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="text-capitalize">Mã code</label>
                                <input type="text" value="{{ old('code') }}"
                                    class="form-control @error('code') parsley-error @enderror" name="code">

                                @error('code')
                                <ul class="parsley-errors-list filled">
                                    <li class="parsley-required">{{ $message }}</li>
                                </ul>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="text-capitalize">Số tiền giảm giá</label>
                                <input type="text" value="{{ old('price_discount') }}"
                                    class="form-control @error('price_discount') parsley-error @enderror" name="price_discount">

                                @error('price_discount')
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
                                <label class="text-capitalize">Giới hạn số lượng nhập</label>
                                <input type="text" value="{{ old('code_limit') }}"
                                    class="form-control @error('code_limit') parsley-error @enderror" name="code_limit">

                                @error('code_limit')
                                <ul class="parsley-errors-list filled">
                                    <li class="parsley-required">{{ $message }}</li>
                                </ul>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="text-capitalize">Ngày hết hạn</label>
                                <input type="text" value="{{ old('expiration_date') }}"
                                data-provide="datepicker" data-date-autoclose="true" class="form-control datepicker @error('expiration_date') parsley-error @enderror" name="expiration_date">

                                @error('expiration_date')
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
                                <label class="text-capitalize">Đơn hàng có thể nhập code</label>
                                <input type="text" value="{{ old('price_payment_limit') }}"
                                    class="form-control @error('price_payment_limit') parsley-error @enderror" name="price_payment_limit">

                                @error('price_payment_limit')
                                <ul class="parsley-errors-list filled">
                                    <li class="parsley-required">{{ $message }}</li>
                                </ul>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="text-capitalize">Mô tả code</label>
                                <input type="text" value="{{ old('code_description') }}"
                                    class="form-control @error('code_description') parsley-error @enderror" name="code_description">

                                @error('code_description')
                                <ul class="parsley-errors-list filled">
                                    <li class="parsley-required">{{ $message }}</li>
                                </ul>
                                @enderror
                            </div>
                        </div>
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
    <script src="{{ url('') }}\assets\libs\bootstrap-datepicker\bootstrap-datepicker.min.js"></script>
    <script src="{{ url('') }}\assets\js\pages\form-pickers.init.js"></script>
    <script>
        $(".datepicker").datepicker({ 
            format: 'yyyy-mm-dd'
        });
    </script>
@endsection

