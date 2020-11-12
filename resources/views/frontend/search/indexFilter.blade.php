<div class="row">

    @foreach ($listSearch as $item)
        <div class="col-md-4 col-sm-6 mb-2">
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