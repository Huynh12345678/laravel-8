@extends('layout.frontend.layout')

@section('title')
    {{ $row['name'] }} - {{ $row['sku'] }}
@endsection

@section('linkCSS')
    <link rel="stylesheet" href="{{ url('') }}/css/toastr.min.css">
@endsection

@section('metaSeo')
    <meta name="title" content="{{ $row['meta_title'] }}" />
    <meta name="keywords" content="{{ $row['meta_keyword'] }}" />
    <meta name="description" content="{{ $row['meta_desc'] }}" />
    <meta name="url" content="{{ route('userProductDetail', $row['slug']) }}">
    <meta name="og:title" content="{{ $row['meta_title'] }}" />
    <meta name="og:url" content="{{ route('userProductDetail', $row['slug']) }}" />
    <meta name="og:keywords" content="{{ $row['meta_keyword'] }}" />
    <meta name="og:description" content="{{ $row['meta_desc'] }}" />
@endsection

@section('content')

    <section class="section">
        <div class="section__breadcrumbs">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <ul class="d-flex flex-wrap list-unstyled">
                            <li>
                                <a href="{{ url('') }}">
                                    Trang chủ
                                </a>
                            </li>

                            @if ($catBreadCrumb2 != null)
                                <li>
                                    <a href="{{ route('userProductCatalog', $catBreadCrumb2['slug']) }}">
                                        {{ $catBreadCrumb2['name'] }}
                                    </a>
                                </li>
                            @endif

                            @if ($catBreadCrumb1 != null)
                                <li>
                                    <a href="{{ route('userProductCatalog', $catBreadCrumb1['slug']) }}">
                                        {{ $catBreadCrumb1['name'] }}
                                    </a>
                                </li>
                            @endif

                            @if ($catBreadCrumb != null)
                                <li>
                                    <a href="{{ route('userProductCatalog', $catBreadCrumb['slug']) }}">
                                        {{ $catBreadCrumb['name'] }}
                                    </a>
                                </li>
                            @endif

                            @if ($catName != null)
                                <li>
                                    <a href="{{ route('userProductCatalog', $catName['slug']) }}">
                                        {{ $catName['name'] }}
                                    </a>
                                </li>
                            @endif

                            <li>
                                {{ $row['name'] }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- detail -->
    <section class="section">
        <div class="section__detail">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5">
                        <!-- Swiper -->
                        <div class="swiper-container detail-gallery-top mb-3">
                            <div class="swiper-wrapper text-center">
                                <div class="swiper-slide">
                                    <img src="{{ url('uploads/product/' . $row['thumb']) }}" class="img-fluid venobox"
                                        alt="{{ $row['name'] }}" data-gall="gall1" title="{{ $row['name'] }}"
                                        href="{{ url('uploads/product/' . $row['thumb']) }}" />
                                </div>
                                @foreach ($thumbList as $img)
                                    <div class="swiper-slide">
                                        <img src="{{ url('uploads/product/' . $img) }}" class="img-fluid venobox"
                                            alt="{{ $row['name'] }}" data-gall="gall1" title="{{ $row['name'] }}"
                                            href="{{ url('uploads/product/' . $img) }}" />
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="swiper-container detail-gallery-thumbs">
                            <div class="swiper-wrapper">

                                <div class="swiper-slide border">
                                    <img src="{{ url('uploads/product/' . $row['thumb']) }}" class="img-fluid"
                                        alt="{{ $row['name'] }}" />
                                </div>

                                @foreach ($thumbList as $img)
                                    <div class="swiper-slide">
                                        <img src="{{ url('uploads/product/' . $img) }}" class="img-fluid"
                                            alt="{{ $row['name'] }}" />
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-7">
                        <h5 class="section__detail-name mt-4 mt-lg-0">
                            {{ $row['name'] }} - {{ $row['sku'] }}
                        </h5>

                        <div class="section__detail-star">
                            <div class="text-warning">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                            </div>
                        </div>

                        <div class="section__detail-price d-flex flex-wrap">
                            <div class="section__detail-price-buy">
                                {{ number_format($row['price'] - $row['price'] * ($row['sale'] / 100), 0, ',', '.') }} VNĐ
                            </div>
                            @if ($row['sale'] > 0)
                                <div class="section__detail-price-root">{{ number_format($row['price'], 0, ',', '.') }} VNĐ
                                </div>
                            @else
                                <div class="section__detail-price-root d-none">
                                    {{ number_format($row['price'], 0, ',', '.') }} VNĐ</div>
                            @endif
                        </div>

                        @if ($row['sale'] > 0)
                            <div class="section__detail-price-sale">-{{ $row['sale'] }}%</div>
                        @endif

                        <div class="section__detail-intro">
                            <p class="text-muted">
                                {{ $row['intro_desc'] }}
                            </p>
                        </div>

                        <ul class="list-unstyled mb-4 mt-4">
                            <li class="d-flex">
                                <strong class="text-capitalize mr-3">Mã sản phẩm: </strong>
                                <p class="text-capitalize">{{ $row['sku'] }}</p>
                            </li>

                            <li class="d-flex">
                                <strong class="text-capitalize mr-3">Danh mục: </strong>
                                <p class="text-capitalize">{{ $catName['name'] }}</p>
                            </li>

                            <li class="d-flex">
                                <strong class="text-capitalize mr-3">Nhà cung cấp: </strong>
                                <p class="text-capitalize">{{ $producerName['name'] }}</p>
                            </li>

                            @if ($brandName['name'] != 'Empty')
                                <li class="d-flex">
                                    <strong class="text-capitalize mr-3">Thương hiệu: </strong>
                                    <p class="text-capitalize">{{ $brandName['name'] }}</p>
                                </li>
                            @else
                                <li class="d-flex" style="opacity: 0">
                                    <strong class="text-capitalize mr-3">Thương hiệu: </strong>
                                    <p class="text-capitalize"></p>
                                </li>
                            @endif

                            <li class="d-flex">
                                <strong class="text-capitalize mr-3">Lượt xem: </strong>
                                <p class="text-capitalize">{{ $row['view'] }}</p>
                            </li>
                        </ul>

                        <div class="section__detail-btn">
                            <a href="javascript:void(0)" class="section__product-container-addToCart"
                            data-id="{{ $row['id'] }}"> Thêm vào giỏ </a>

                            <a href="javascript:void(0)">
                                <i class="fa fa-heart" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end detail -->

    <!-- detail tab -->
    <section class="section">
        <div class="section__product section__tabs">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home"
                                    role="tab" aria-controls="pills-home" aria-selected="true">chi tiết sản phẩm</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact"
                                    role="tab" aria-controls="pills-contact" aria-selected="false">Đánh giá sản phẩm</a>
                            </li>
                        </ul>

                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                aria-labelledby="pills-home-tab">
                                <div class="section__detail-description">
                                    {!! $row['detail_desc'] !!}
                                </div>
                            </div>

                            <div class="tab-pane fade" id="pills-contact" role="tabpanel"
                                aria-labelledby="pills-contact-tab">
                                <div class="section__detail-comment" id="showComment">
                                    
                                </div>

                                <div class="section__detail-comment-form mt-5" id="formChange">
                                    <form action="{{ route('userPostComment') }}" method="POST" id="postCommentForm">
                                        @csrf
                                        <input type="hidden" name="productid" id="productid" value="{{ $row['id'] }}">
                                        <div id="changeReply"></div>
                                        <div class="form-group">
                                            <label class="text-capitalize">Nội dung đánh giá</label>
                                            <textarea name="body" id="body" class="form-control" cols="30" rows="10" required></textarea>
                                        </div>

                                        <div class="form-group">
                                            <button type="submit" class="section__detail-comment-form-btn">
                                                Đăng
                                            </button>
                                        </div>
                                    </form>
                                </div>

                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end detail tab -->

    <!-- product related -->
    <section class="section">
        <div class="section__product">
            <div class="container">
                <div class="row mt-5">
                    <div class="col-12">
                        <h5 class="section__product-title mb-3">Sản phẩm cùng danh mục</h5>

                        @if (count($listProductRelated))
                            <!-- Swiper -->
                        <div class="swiper-container swiper-product">
                            <div class="swiper-wrapper">
                                @foreach ($listProductRelated ?? '' as $item)
                                    <div class="swiper-slide">
                                        <div class="section__product-container">
                                            <div class="section__product-container-thumb position-relative">
                                                <a href="{{ route('userProductDetail', $item['slug']) }}">
                                                    <img src="{{ url('uploads/product/' . $item['thumb']) }}"
                                                        class="img-fluid" alt="{{ $item['name'] }}" />
                                                </a>

                                                @if ($item['sale'] > 0)
                                                    <div class="section__product-container-info-price-sale">
                                                        -{{ $item['sale'] }}%
                                                    </div>
                                                @endif

                                                <div class="section__product-container-hover">
                                                    <ul class="list-unstyled d-flex">
                                                        <li>
                                                            <a href="javascript:void(0)"
                                                                class="section__product-container-quickview"
                                                                data-toggle="modal" data-target="#dataModal"
                                                                data-id="{{ $item['id'] }}">
                                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:void(0)">
                                                                <i class="fa fa-heart" aria-hidden="true"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:void(0)"
                                                                class="section__product-container-addToCart"
                                                                data-id="{{ $item['id'] }}">
                                                                <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>

                                            <div class="section__product-container-info">
                                                <div class="section__product-container-info-name">
                                                    <a href="{{ route('userProductDetail', $item['slug']) }}">
                                                        {{ $item['name'] }} - {{ $item['sku'] }}
                                                    </a>
                                                </div>

                                                <div class="section__product-container-info-star">
                                                    <div class="text-warning">
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                    </div>
                                                </div>

                                                <p class="text-muted">Lượt xem: {{ $item['view'] }}</p>

                                                @if ($item['sale'] > 0)
                                                    <div class="section__product-container-info-price">
                                                        <div class="section__product-container-info-price-buy">
                                                            {{ number_format($item['price'] - $item['price'] * ($item['sale'] / 100), 0, ',', '.') }}
                                                            VNĐ
                                                        </div>

                                                        <div class="section__product-container-info-price-root">
                                                            {{ number_format($item['price'], 0, ',', '.') }} VNĐ
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="section__product-container-info-price">
                                                        <div class="section__product-container-info-price-buy">
                                                            {{ number_format($item['price'], 0, ',', '.') }} VNĐ
                                                        </div>

                                                        <div class="section__product-container-info-price-buy"
                                                            style="opacity: 0">
                                                            {{ number_format($item['price'], 0, ',', '.') }} VNĐ
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Add Arrows -->
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                        </div>
                        <!-- end Swiper -->
                        @else 
                        <div class="text-uppercase text-danger text-center font-weight-bolder">
                            <h4>Không có sản phẩm nào cùng danh mục</h4>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end product related -->
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

        function showCartTotal() {
            $.ajax({
                url: "{{ route('userShowCartTotal') }}",
                type: "post",
                success: function(data) {
                    $('#cart-total').html(data);
                }
            })
        }

        function showLogin() {
            $.ajax({
                url: "{{ route('userShowLogin') }}",
                type: "post",
                success: function(data) {
                    $('#userLogin').html(data);
                }
            })
        }

        function showLoginName() {
            $.ajax({
                url: "{{ route('userShowLoginName') }}",
                type: "post",
                success: function(data) {
                    $('#userLoginName').html(data);
                }
            })
        }

        function showComment() {
            $.ajax({
                url: "{{ route('userShowComment', $row['id']) }}",
                type: "post",
                success: function(data) {
                    $('#showComment').html(data);
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
        showLogin();
        showLoginName();
        showComment();
    </script>
@endsection

@section('linkAjax')
    <script>
        $(function() {
            $('.section__product-container-quickview').on('click', function() {
                var id = $(this).attr('data-id');

                $.ajax({
                    url: "{{ route('userModal') }}",
                    type: "post",
                    data: {
                        id: id,
                    },
                    success: function(data) {
                        $('#data').html(data);
                        $('#dataModal').modal('show');
                    }
                })
            })

            $('.section__product-container-addToCart').on('click', function() {
                var id = $(this).attr('data-id');

                $.ajax({
                    url: "{{ route('userCartAdd') }}",
                    type: "post",
                    data: {
                        id: id,
                    },
                    success: function(data) {
                        $('.section__sidebar').addClass('active');
                        $('.overplay').addClass('active');
                        showCartSidebar();
                        showCartQuantity();
                        showCartTotal();

                        Command: toastr["success"]("Thêm sản phẩm vào giỏ hàng thành công!")
                        showToastr();
                    }
                })
            })

            $(document).on('click', '.section__sidebar-content-removeCart', function() {
                var id = $(this).attr('data-id');

                $.ajax({
                    url: "{{ route('userRemoveCart') }}",
                    type: "post",
                    data: {
                        id: id,
                    },
                    success: function(data) {
                        showCartSidebar();
                        showCartQuantity();
                        showCartTotal();

                        Command: toastr["success"]("Xóa thành công sản phẩm khỏi giỏ hàng!")
                        showToastr();
                    }
                })
            })

            // Register
            $(document).on('submit', '#postRegisterForm', function(e) {
                e.preventDefault();

                $.ajax({
                    url: "{{ route('userPostRegister') }}",
                    type: "post",
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response.errors) {
                            if (response.errors.fullname) {
                                $('#fullname').addClass('is-invalid');
                                $('.invalid-feedback.fullname').html(response.errors.fullname);
                            } else {
                                $('#fullname').removeClass('is-invalid');
                                $('#fullname').addClass('is-valid');
                                $('.invalid-feedback.fullname').html('');
                            }

                            if (response.errors.email) {
                                $('#email').addClass('is-invalid');
                                $('.invalid-feedback.email').html(response.errors.email);
                            } else {
                                $('#email').removeClass('is-invalid');
                                $('#email').addClass('is-valid');
                                $('.invalid-feedback.email').html('');
                            }

                            if (response.errors.phone) {
                                $('#phone').addClass('is-invalid');
                                $('.invalid-feedback.phone').html(response.errors.phone);
                            } else {
                                $('#phone').removeClass('is-invalid');
                                $('#phone').addClass('is-valid');
                                $('.invalid-feedback.phone').html('');
                            }

                            if (response.errors.username) {
                                $('#username').addClass('is-invalid');
                                $('.invalid-feedback.username').html(response.errors.username);
                            } else {
                                $('#username').removeClass('is-invalid');
                                $('#username').addClass('is-valid');
                                $('.invalid-feedback.username').html('');
                            }

                            if (response.errors.password) {
                                $('#password').addClass('is-invalid');
                                $('.invalid-feedback.password').html(response.errors.password);
                            } else {
                                $('#password').removeClass('is-invalid');
                                $('#password').addClass('is-valid');
                                $('.invalid-feedback.password').html('');
                            }
                        } else {
                            Command: toastr["success"](
                                "Đăng ký thành công! Bây giờ bạn có thể đăng nhập.")
                            showToastr();

                            $('#fullname').addClass('is-valid');
                            $('#fullname').removeClass('is-invalid');
                            $('.invalid-feedback.fullname').html('');

                            $('#email').addClass('is-valid');
                            $('#email').removeClass('is-invalid');
                            $('.invalid-feedback.email').html('');

                            $('#phone').addClass('is-valid');
                            $('#phone').removeClass('is-invalid');
                            $('.invalid-feedback.phone').html('');

                            $('#username').addClass('is-valid');
                            $('#username').removeClass('is-invalid');
                            $('.invalid-feedback.username').html('');

                            $('#password').addClass('is-valid');
                            $('#password').removeClass('is-invalid');
                            $('.invalid-feedback.password').html('');

                            $('#dataRegister').modal('hide');
                            $('#dataLogin').modal('show');
                        }
                    }
                })
            })

            // Login
            $(document).on('submit', '#postLoginForm', function(e) {
                e.preventDefault();

                $.ajax({
                    url: "{{ route('userPostLogin') }}",
                    type: "post",
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response.error) {
                            if (response.error.usernameLogin) {
                                $('#usernameLogin').addClass('is-invalid');
                                $('.invalid-feedback.usernameLogin').html(response.error
                                    .usernameLogin);
                            } else {
                                $('#usernameLogin').removeClass('is-invalid');
                                $('#usernameLogin').addClass('is-valid');
                                $('.invalid-feedback.usernameLogin').html('');
                            }

                            if (response.error.passwordLogin) {
                                $('#passwordLogin').addClass('is-invalid');
                                $('.invalid-feedback.passwordLogin').html(response.error
                                    .passwordLogin);
                            } else {
                                $('#passwordLogin').removeClass('is-invalid');
                                $('#passwordLogin').addClass('is-valid');
                                $('.invalid-feedback.passwordLogin').html('');
                            }
                        } else {
                            if (response.danger) {
                                Command: toastr["error"](
                                    response.danger)
                                showToastr();
                            }

                            if (response.success) {
                                Command: toastr["success"](
                                    response.success)
                                showToastr();
                            }

                            $('#dataLogin').modal('hide');
                            showLogin();
                            showLoginName();
                            showComment();
                        }
                    }
                })
            })

            // Logout
            $(document).on('click', '#postLogout', function(e) {
                e.preventDefault();

                $.ajax({
                    url: "{{ route('userPostLogout') }}",
                    type: "post",
                    success: function(data) {
                        Command: toastr["success"]('Đăng xuất thành công!')
                        showToastr();
                        showLogin();
                        showLoginName();
                        showComment();
                    }
                })
            })

            // Comment
            $(document).on('submit', '#postCommentForm', function(e) {
                e.preventDefault();
                var productid = $('#productid').val();
                var body = $('#body').val();

                $.ajax({
                    url: "{{ route('userPostComment') }}",
                    type: "post",
                    data: {
                        productid: productid,
                        body: body
                    },
                    success: function(data) {
                        Command: toastr["success"]('Bạn vừa đăng bình luận thành công!')
                        showToastr();
                        showComment();
                    }
                })
            })

            // Reply
            $(document).on('click', '.replyComment', function(e) {
                e.preventDefault();
                var id = $(this).attr('data-id');
            
                $.ajax({
                    url: "{{ route('userShowNameReply') }}",
                    type: "post",
                    data: {
                        id: id
                    },
                    success: function(data) {
                        $('#changeReply').html(data);
                        $('#formChange').html(data);
                    }
                })
            })

            $(document).on('submit', '#postReplyForm', function(e) {
                e.preventDefault();
                var commentid = $('#commentid').val();
                var bodyReply = $('#bodyReply').val()
            
                $.ajax({
                    url: "{{ route('userPostReply') }}",
                    type: "post",
                    data: {
                        commentid: commentid,
                        bodyReply: bodyReply
                    },
                    success: function(data) {
                        Command: toastr["success"]('Bạn vừa trả lời bình luận thành công!')
                        showToastr();
                        showComment();
                    }
                })
            })
        })

    </script>
@endsection
