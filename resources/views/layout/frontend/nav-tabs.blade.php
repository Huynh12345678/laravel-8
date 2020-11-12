<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home"
            role="tab" aria-controls="pills-home" aria-selected="true">@lang('home.news-title')</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile"
            role="tab" aria-controls="pills-profile"
            aria-selected="false">@lang('home.featured-title')</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact"
            role="tab" aria-controls="pills-contact"
            aria-selected="false">@lang('home.mostView-title')</a>
    </li>
</ul>
<div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
        aria-labelledby="pills-home-tab">
        <!-- Swiper -->
        <div class="swiper-container swiper-product">
            <div class="swiper-wrapper">
                @foreach ($listProductNews as $item)
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
                                                <i class="fa fa-shopping-bag"
                                                    aria-hidden="true"></i>
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
    </div>
    <div class="tab-pane fade" id="pills-profile" role="tabpanel"
        aria-labelledby="pills-profile-tab">
        <!-- Swiper -->
        <div class="swiper-container swiper-product">
            <div class="swiper-wrapper">
                @foreach ($listProductFeatured as $item)
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
                                            <a href="javascript:void(0)" class="section__product-container-addToCart"
                                            data-id="{{ $item['id'] }}">
                                                <i class="fa fa-shopping-bag"
                                                    aria-hidden="true"></i>
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
    </div>
    <div class="tab-pane fade" id="pills-contact" role="tabpanel"
        aria-labelledby="pills-contact-tab">
        <!-- Swiper -->
        <div class="swiper-container swiper-product">
            <div class="swiper-wrapper">
                @foreach ($listProductMostView as $item)
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
                                            <a href="javascript:void(0)" class="section__product-container-addToCart"
                                            data-id="{{ $item['id'] }}">
                                                <i class="fa fa-shopping-bag"
                                                    aria-hidden="true"></i>
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
    </div>
</div>