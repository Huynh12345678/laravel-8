<div class="slimscroll-menu">

    <!--- Sidemenu -->
    <div id="sidebar-menu">

        <ul class="metismenu" id="side-menu">

            <li class="menu-title">Tổng quan</li>

            <li>
                <a href="{{ route('adminDashboard') }}" class="waves-effect">
                    <i class="remixicon-vip-crown-2-line"></i>
                    <span class="text-capitalize"> Trang thống kê </span>
                </a>
            </li>

            <li class="menu-title">Quản lý sản phẩm</li>

            <li>
                <a href="javascript: void(0);" class="waves-effect">
                    <i class="remixicon-stack-line"></i>
                    <span class="text-capitalize"> Danh mục sản phẩm </span>
                    <span class="menu-arrow"></span>
                </a>
                <ul class="nav-second-level" aria-expanded="false">
                    <li>
                        <a href="{{ route('adminCatalogAdd') }}" class="text-capitalize">Thêm mới</a>
                        <a href="{{ route('adminCatalog') }}" class="text-capitalize">Xem danh sách</a>
                        <a href="{{ route('adminCatalogRecycle') }}" class="text-capitalize">Xem thùng rác</a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="javascript: void(0);" class="waves-effect">
                    <i class="remixicon-stack-line"></i>
                    <span class="text-capitalize"> Nhà cung cấp </span>
                    <span class="menu-arrow"></span>
                </a>
                <ul class="nav-second-level" aria-expanded="false">
                    <li>
                        <a href="{{ route('adminProducerAdd') }}" class="text-capitalize">Thêm mới</a>
                        <a href="{{ route('adminProducer') }}" class="text-capitalize">Xem danh sách</a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="javascript: void(0);" class="waves-effect">
                    <i class="remixicon-stack-line"></i>
                    <span class="text-capitalize"> Thương hiệu </span>
                    <span class="menu-arrow"></span>
                </a>
                <ul class="nav-second-level" aria-expanded="false">
                    <li>
                        <a href="{{ route('adminBrandAdd') }}" class="text-capitalize">Thêm mới</a>
                        <a href="{{ route('adminBrand') }}" class="text-capitalize">Xem danh sách</a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="javascript: void(0);" class="waves-effect">
                    <i class="remixicon-stack-line"></i>
                    <span class="text-capitalize"> Sản phẩm </span>
                    <span class="menu-arrow"></span>
                </a>
                <ul class="nav-second-level" aria-expanded="false">
                    <li>
                        <a href="{{ route('adminProductAdd') }}" class="text-capitalize">Thêm mới</a>
                        <a href="{{ route('adminProduct') }}" class="text-capitalize">Xem danh sách</a>
                        <a href="{{ route('adminProductRecycle') }}" class="text-capitalize">Xem thùng rác</a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="javascript: void(0);" class="waves-effect">
                    <i class="remixicon-stack-line"></i>
                    <span class="text-capitalize"> Coupon </span>
                    <span class="menu-arrow"></span>
                </a>
                <ul class="nav-second-level" aria-expanded="false">
                    <li>
                        <a href="{{ route('adminCouponAdd') }}" class="text-capitalize">Thêm mới</a>
                        <a href="{{ route('adminCoupon') }}" class="text-capitalize">Xem danh sách</a>
                    </li>
                </ul>
            </li>

            <li class="menu-title">Quản lý giao diện</li>

            <li>
                <a href="javascript: void(0);" class="waves-effect">
                    <i class="remixicon-stack-line"></i>
                    <span class="text-capitalize"> Slider </span>
                    <span class="menu-arrow"></span>
                </a>
                <ul class="nav-second-level" aria-expanded="false">
                    <li>
                        <a href="{{ route('adminSliderAdd') }}" class="text-capitalize">Thêm mới</a>
                        <a href="{{ route('adminSlider') }}" class="text-capitalize">Xem danh sách</a>
                    </li>
                </ul>
            </li>

            <li class="menu-title">Quản lý khách hàng</li>

            <li>
                <a href="javascript: void(0);" class="waves-effect">
                    <i class="remixicon-stack-line"></i>
                    <span class="text-capitalize"> Đơn hàng </span>
                    <span class="menu-arrow"></span>
                </a>
                <ul class="nav-second-level" aria-expanded="false">
                    <li>
                        <a href="{{ route('adminOrdersSave') }}" class="text-capitalize">Đơn hàng đã lưu</a>
                        <a href="{{ route('adminOrders') }}" class="text-capitalize">Xem danh sách</a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="javascript: void(0);" class="waves-effect">
                    <i class="remixicon-stack-line"></i>
                    <span class="text-capitalize"> Khách hàng </span>
                    <span class="menu-arrow"></span>
                </a>
                <ul class="nav-second-level" aria-expanded="false">
                    <li>
                        <a href="{{ route('adminUser') }}" class="text-capitalize">Xem danh sách</a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="javascript: void(0);" class="waves-effect">
                    <i class="remixicon-stack-line"></i>
                    <span class="text-capitalize"> Liên hệ </span>
                    <span class="menu-arrow"></span>
                </a>
                <ul class="nav-second-level" aria-expanded="false">
                    <li>
                        <a href="{{ route('adminSliderAdd') }}" class="text-capitalize">Thêm mới</a>
                        <a href="{{ route('adminContact') }}" class="text-capitalize">Xem danh sách</a>
                    </li>
                </ul>
            </li>
        </ul>

    </div>
    <!-- End Sidebar -->

    <div class="clearfix"></div>

</div>
<!-- Sidebar -left -->