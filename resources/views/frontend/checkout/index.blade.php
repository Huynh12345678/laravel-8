@extends('layout.frontend.layout')

@section('title', 'Trang thông tin thanh toán đơn hàng')

@section('linkCSS')
    <link rel="stylesheet" href="{{ url('') }}/css/toastr.min.css">
@endsection

@section('content')
    <section class="section">
        <div class="section__breadcrumbs">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <ul class="d-flex flex-wrap list-unstyled">
                            <li>
                                <a href="{{ url('') }}"> Trang chủ </a>
                            </li>
                            <li>Thông tin thanh toán</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section mt-5">
        <div class="section__checkout">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="section__checkout-title">
                            <h5>Chi tiết đơn hàng</h5>

                            <form action="{{ route('userPostCheckout') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label class="text-capitalize">Họ và tên</label>
                                    <input type="text" class="form-control" readonly value="{{ $row['userFullname'] }}">
                                </div>

                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="text-capitalize">Số điện thoại</label>
                                            <input type="text" class="form-control" readonly
                                                value="{{ $row['userPhone'] }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="text-capitalize">Email</label>
                                            <input type="text" class="form-control" readonly
                                                value="{{ $row['userEmail'] }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="text-capitalize">Thành phố / Tỉnh</label>
                                            <select class="custom-select @error('province') is-invalid @enderror"
                                                name="province" id="province">
                                                <option value="">[--- Chọn Thành phố / Tỉnh ---]</option>
                                                @foreach ($listProvince as $item)
                                                    <option value="{{ $item['id'] }}" {{ old('province') == $item['id'] ? 'selected' : '' }}>{{ $item['name'] }}</option>
                                                @endforeach
                                            </select>

                                            @error('province')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="text-capitalize">Quận / Huyện</label>
                                            <select class="custom-select @error('district') is-invalid @enderror"
                                                name="district" id="district">
                                                <option value="">[--- Chọn Quận / Huyện ---]</option>
                                            </select>

                                            @error('district')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="text-capitalize">Địa chỉ nhận hàng</label>
                                    <textarea class="form-control @error('address') is-invalid @enderror" name="address" cols="30">{{ old('address') }}</textarea>

                                    @error('address')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="text-capitalize">Ghi chú</label>
                                    <textarea class="form-control @error('note') is-invalid @enderror" name="note" cols="30" rows="10">{{ old('note') }}</textarea>

                                    @error('note')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="section__checkout-btn">
                                        Tiếp tục
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="col-md-6 mt-4 mt-md-0">
                        <div class="section__checkout-title">
                            <h5>Đơn hàng của bạn</h5>

                            <div class="table-responsive">
                                <table class="table text-center table-bordered mb-0 table-nowrap">
                                    <thead class="thead-light text-capitalize">
                                        <tr>
                                            <th></th>
                                            <th>Thông tin sản phẩm</th>
                                            <th>Tổng cộng</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-nowrap" id="showCheckoutCart">


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('linkJS')
    <script src="{{ url('') }}/js/toastr.min.js"></script>
@endsection

@section('linkFunctionCallAjax')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function showCartSidebar() {
            $.ajax({
                url: "{{ route('userShowCartSidebar') }}",
                type: "post",
                success: function(data) {
                    $('#cart-data').html(data);
                }
            })
        }

        function showCartQuantity() {
            $.ajax({
                url: "{{ route('userShowCartQuantity') }}",
                type: "post",
                success: function(data) {
                    $('#header__mid-cart-quantity').html(data);
                }
            })
        }

        function showCheckoutCart() {
            $.ajax({
                url: "{{ route('userShowCheckoutCart') }}",
                type: "post",
                success: function(data) {
                    $('#showCheckoutCart').html(data);
                }
            })
        }

        function showCartTotal() {
            $.ajax({
                url: "{{ route('userShowCartTotal') }}",
                type: "post",
                success: function(data) {
                    $('#cart-total').html(data);
                }
            })
        }

        function showToastr() {
            toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-bottom-left",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
        }

        showCartSidebar();
        showCartQuantity();
        showCartTotal();
        showCheckoutCart();

    </script>
@endsection

@section('linkAjax')
    <script>
        $(function() {

            $(document).on('click', '.section__sidebar-content-removeCart', function() {
                Command: toastr["error"](
                    "Trạng thái hiện tại không thể thực hiện thay đổi sản phẩm giỏ hàng! Vui lòng quay lại trang trước."
                    )
                showToastr();
            })

            // Logout
            $(document).on('click', '#postLogout', function(e) {
                e.preventDefault();

                Command: toastr["error"]('Trạng thái hiện tại không thể đăng xuất! Vui lòng thử lại sau.')
                showToastr();
            })

            $('#province').on('click', function() {
                var provinceId = $(this).val();

                $.ajax({
                    url: "{{ route('userShowDistrict') }}",
                    type: "POST",
                    data: {
                        provinceId: provinceId
                    },
                    success: function(data) {
                        $('#district').html(data);
                    }
                })
            })
        })

    </script>
@endsection
