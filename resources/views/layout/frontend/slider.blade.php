<div class="container">
    <div class="row">
        <div class="col-md-12">
            <!-- Swiper -->
            <div class="swiper-container swiper-slider">
                <div class="swiper-wrapper">
                    @foreach ($listSlider as $item)
                    <div class="swiper-slide">
                        <img src="{{ url('uploads/slider/'.$item['thumb']) }}" class="img-fluid w-100" alt="{{ $item['name'] }}" />
                    </div>
                    @endforeach
                </div>
                <!-- Add Pagination -->
                <div class="swiper-pagination"></div>
            </div>
            <!-- end Swiper -->
        </div>
    </div>
</div>