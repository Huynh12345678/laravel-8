@foreach ($catalogAccordion as $cat)
    <li class="section__category-accordion-item">
        <div class="d-flex align-items-center border-bottom justify-content-between pb-2 mb-3">
            <a href="{{ route('userProductCatalog', $cat['slug']) }}" class="section__category-accordion-link">
                {{ $cat['name'] }}
            </a>

            @if ($cat->items->count() > 0)
                <div class="section__category-accordion-toggle">
                    <i class="fa fa-angle-up" aria-hidden="true"></i>
                </div>
            @endif

        </div>

        <!-- acorion sub -->

        <ul class="list-unstyled section__category-accordion-sub" style="display: none;">
            @foreach ($cat->items as $cat1)
                <li>
                    <div class="d-flex align-items-center border-bottom justify-content-between pb-2 mb-3">
                        <a href="{{ route('userProductCatalog', $cat1['slug']) }}"
                            class="section__category-accordion-link">
                            {{ $cat1['name'] }}
                        </a>

                        @if ($cat1->items->count() > 0)
                            <div class="section__category-accordion-toggle">
                                <i class="fa fa-angle-up" aria-hidden="true"></i>
                            </div>
                        @endif
                    </div>

                    <ul class="list-unstyled section__category-accordion-sub" style="display: none;">
                        @foreach ($cat1->items as $cat2)
                            <li>
                                <div class="d-flex align-items-center border-bottom justify-content-between pb-2 mb-3">
                                    <a href="{{ route('userProductCatalog', $cat2['slug']) }}"
                                        class="section__category-accordion-link">
                                        {{ $cat2['name'] }}
                                    </a>

                                    @if ($cat2->items->count() > 0)
                                        <div class="section__category-accordion-toggle">
                                            <i class="fa fa-angle-up" aria-hidden="true"></i>
                                        </div>
                                    @endif
                                </div>

                                <ul class="list-unstyled section__category-accordion-sub" style="display: none;">
                                    @foreach ($cat2->items as $cat3)
                                        <li>
                                            <div
                                                class="d-flex align-items-center border-bottom justify-content-between pb-2 mb-3">
                                                <a href="{{ route('userProductCatalog', $cat3['slug']) }}"
                                                    class="section__category-accordion-link">
                                                    {{ $cat3['name'] }}
                                                </a>

                                                @if ($cat3->items->count() > 0)
                                                    <div class="section__category-accordion-toggle">
                                                        <i class="fa fa-angle-up" aria-hidden="true"></i>
                                                    </div>
                                                @endif
                                            </div>
                                        </li>
                                    @endforeach

                                </ul>
                            </li>
                        @endforeach

                    </ul>

                </li>

            @endforeach

        </ul>
        <!-- end accordion sub -->

    </li>
@endforeach
