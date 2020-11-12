@extends('layout.backend.layout')

@section('title', 'Trang quản trị ADMIN')

@section('content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Circle</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);" class="text-capitalize">Tổng quan</a></li>
                        <li class="breadcrumb-item active text-capitalize">Trang thống kê</li>
                    </ol>
                </div>
                <h4 class="page-title text-uppercase">Trang thống kê</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-md-6 col-xl-3">
            <div class="card-box">
                <h4 class="mt-0 font-16 text-capitalize">Sản phẩm</h4>
                <h2 class="text-primary my-3 text-center"><span data-plugin="counterup">{{ $listProduct }}</span></h2>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="card-box">
                <h4 class="mt-0 font-16 text-capitalize">Liên hệ</h4>
                <h2 class="text-primary my-3 text-center"><span data-plugin="counterup">{{ $listContact }}</span></h2>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="card-box">
                <h4 class="mt-0 font-16 text-capitalize">Đơn hàng chưa duyệt</h4>
                <h2 class="text-primary my-3 text-center"><span data-plugin="counterup">{{ $listOrderNew }}</span></h2>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="card-box">
                <h4 class="mt-0 font-16 text-capitalize">Đơn hàng hoàn thành</h4>
                <h2 class="text-primary my-3 text-center"><span data-plugin="counterup">{{ $listOrderComplete }}</span></h2>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 col-xl-4">
            <div class="card-box">
                <h4 class="mt-0 font-16 text-capitalize">Doanh thu ngày</h4>
                <h2 class="text-primary my-3 text-center">{{ $formatTotalDay }}</h2>
            </div>
        </div>

        <div class="col-md-6 col-xl-4">
            <div class="card-box">
                <h4 class="mt-0 font-16 text-capitalize">Doanh thu tháng</h4>
                <h2 class="text-primary my-3 text-center">{{ $formatTotalMonth }}</h2>
            </div>
        </div>

        <div class="col-md-6 col-xl-4">
            <div class="card-box">
                <h4 class="mt-0 font-16 text-capitalize">Doanh thu năm</h4>
                <h2 class="text-primary my-3 text-center">{{ $formatTotalYear }}</h2>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="float-right d-none d-md-inline-block">
                        <div class="btn-group mb-2">
                            <button type="button" class="btn btn-xs btn-light">Today</button>
                            <button type="button" class="btn btn-xs btn-secondary">Weekly</button>
                            <button type="button" class="btn btn-xs btn-light">Monthly</button>
                        </div>
                    </div>
                    <h4 class="header-title">Recent Revenue</h4>

                    <div class="row mt-4 text-center">
                        <div class="col-4">
                            <p class="text-muted font-15 mb-1 text-truncate">Target</p>
                            <h4><i class="fe-arrow-down text-danger mr-1"></i>$7.8k</h4>
                        </div>
                        <div class="col-4">
                            <p class="text-muted font-15 mb-1 text-truncate">Last week</p>
                            <h4><i class="fe-arrow-up text-success mr-1"></i>$1.4k</h4>
                        </div>
                        <div class="col-4">
                            <p class="text-muted font-15 mb-1 text-truncate">Last Month</p>
                            <h4><i class="fe-arrow-down text-danger mr-1"></i>$15k</h4>
                        </div>
                    </div>

                    <div class="mt-3" dir="ltr">
                        <div id="apex-area" class="apex-charts"></div>
                    </div>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col -->

        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="float-right d-none d-md-inline-block">
                        <div class="btn-group mb-2">
                            <button type="button" class="btn btn-xs btn-secondary">Today</button>
                            <button type="button" class="btn btn-xs btn-light">Weekly</button>
                            <button type="button" class="btn btn-xs btn-light">Monthly</button>
                        </div>
                    </div>
                    <h4 class="header-title">Projections Vs Actuals</h4>
                    <div class="row mt-4 text-center">
                        <div class="col-4">
                            <p class="text-muted font-15 mb-1 text-truncate">Target</p>
                            <h4><i class="fe-arrow-down text-danger mr-1"></i>$3.8k</h4>
                        </div>
                        <div class="col-4">
                            <p class="text-muted font-15 mb-1 text-truncate">Last week</p>
                            <h4><i class="fe-arrow-up text-success mr-1"></i>$1.1k</h4>
                        </div>
                        <div class="col-4">
                            <p class="text-muted font-15 mb-1 text-truncate">Last Month</p>
                            <h4><i class="fe-arrow-down text-danger mr-1"></i>$25k</h4>
                        </div>
                    </div>
                    <div class="mt-3" dir="ltr">
                        <div id="apex-pie-2" class="apex-charts"></div>
                    </div>
                </div>
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>
    <!-- end row -->

    <div class="row">
        <div class="col-xl-4">
            <div class="card-box">
                <div class="row">
                    <div class="col-6">
                        <div class="avatar-sm bg-primary rounded-circle">
                            <i class="fe-aperture avatar-title font-22 text-white"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-right">
                            <h3 class="text-dark my-1">$<span data-plugin="counterup">8,145</span></h3>
                            <p class="text-muted mb-1 text-truncate">Income Status</p>
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <span data-plugin="peity-bar" data-colors="#7266ba,#ebeff2" data-width="100%"
                        data-height="36">5,3,9,6,5,9,7,3,5,2,9,7,2,1,3,5,2,9,7,2,5,3,9,6,5,9,7</span>
                </div>
            </div> <!-- end card-box-->
        </div> <!-- end col -->

        <div class="col-xl-4">
            <div class="card-box">
                <div class="row">
                    <div class="col-6">
                        <div class="avatar-sm bg-pink rounded-circle">
                            <i class="fe-users avatar-title font-22 text-white"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-right">
                            <h3 class="text-dark my-1"><span data-plugin="counterup">7204</span></h3>
                            <p class="text-muted mb-1 text-truncate">Recent Users</p>
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <span data-plugin="peity-line" data-fill="#f672a7" data-stroke="#f672a7" data-width="100%"
                        data-height="36">3,5,2,9,7,2,5,3,9,6,5,9,7</span>
                </div>
            </div> <!-- end card-box-->
        </div> <!-- end col -->

        <div class="col-xl-4">
            <div class="card-box">
                <div class="row">
                    <div class="col-6">
                        <div class="avatar-sm bg-secondary rounded-circle">
                            <i class="fe-shopping-bag avatar-title font-22 text-white"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-right">
                            <h3 class="text-dark my-1"><span data-plugin="counterup">367</span></h3>
                            <p class="text-muted mb-1 text-truncate">Sales Status</p>
                        </div>
                    </div>
                </div>

                <div class="mt-4 text-center">
                    <span data-plugin="peity-line" data-fill="#fff" data-stroke="#6c757d" data-width="100%"
                        data-height="36">5,3,9,6,5,9,7,3,5,2</span>
                </div>
            </div> <!-- end card-box-->
        </div> <!-- end col -->

    </div>
    <!-- end row -->


    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <div class="card-widgets">
                        <a href="javascript: void(0);" data-toggle="reload"><i class="mdi mdi-refresh"></i></a>
                        <a data-toggle="collapse" href="#cardCollpase4" role="button" aria-expanded="false"
                            aria-controls="cardCollpase4"><i class="mdi mdi-minus"></i></a>
                        <a href="javascript: void(0);" data-toggle="remove"><i class="mdi mdi-close"></i></a>
                    </div>
                    <h4 class="header-title mb-0">Revenue By Location</h4>

                    <div id="cardCollpase4" class="collapse pt-3 show">
                        <div id="world-map-markers" style="height: 433px"></div>
                    </div> <!-- collapsed end -->
                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->

        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <div class="card-widgets">
                        <a href="javascript: void(0);" data-toggle="reload"><i class="mdi mdi-refresh"></i></a>
                        <a data-toggle="collapse" href="#cardCollpase5" role="button" aria-expanded="false"
                            aria-controls="cardCollpase5"><i class="mdi mdi-minus"></i></a>
                        <a href="javascript: void(0);" data-toggle="remove"><i class="mdi mdi-close"></i></a>
                    </div>
                    <h4 class="header-title mb-0">Top Selling Products</h4>

                    <div id="cardCollpase5" class="collapse pt-3 show">
                        <div class="table-responsive">
                            <table class="table table-hover table-centered mb-0">
                                <thead>
                                    <tr>
                                        <th>Product Name</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>ASOS Ridley High Waist</td>
                                        <td>$79.49</td>
                                        <td>82</td>
                                        <td>$6,518.18</td>
                                    </tr>
                                    <tr>
                                        <td>Marco Lightweight Shirt</td>
                                        <td>$128.50</td>
                                        <td>37</td>
                                        <td>$4,754.50</td>
                                    </tr>
                                    <tr>
                                        <td>Half Sleeve Shirt</td>
                                        <td>$39.99</td>
                                        <td>64</td>
                                        <td>$2,559.36</td>
                                    </tr>
                                    <tr>
                                        <td>Lightweight Jacket</td>
                                        <td>$20.00</td>
                                        <td>184</td>
                                        <td>$3,680.00</td>
                                    </tr>
                                    <tr>
                                        <td>Marco Shoes</td>
                                        <td>$28.49</td>
                                        <td>69</td>
                                        <td>$1,965.81</td>
                                    </tr>
                                    <tr>
                                        <td>ASOS Ridley High Waist</td>
                                        <td>$79.49</td>
                                        <td>82</td>
                                        <td>$6,518.18</td>
                                    </tr>
                                    <tr>
                                        <td>Half Sleeve Shirt</td>
                                        <td>$39.99</td>
                                        <td>64</td>
                                        <td>$2,559.36</td>
                                    </tr>
                                    <tr>
                                        <td>Lightweight Jacket</td>
                                        <td>$20.00</td>
                                        <td>184</td>
                                        <td>$3,680.00</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div> <!-- end table responsive-->
                    </div> <!-- collapsed end -->
                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>
    <!-- end row -->
@endsection
