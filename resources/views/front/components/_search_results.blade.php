@if (isset($searchProducts))
    @foreach($searchProducts as $product)
        <div class="dropdown-menu-card">
            <div class="row no-gutters">
                <div class="col-4">
                    <a href="{{ route('product', $product->slug) }}">
                        <img src="{{ gallery_image($product->getFirstImageName(), \App\Constant\GalleryFileConstant::TYPE_PRODUCT_IMAGE, \App\Constant\GalleryFileConstant::TYPE_TEASER) }}"
                             alt="...">
                    </a>
                </div>

                <div class="col-8">
                    <div class="card-body py-0">
                        <h5 class="card-title">
                            <a href="{{ route('product', $product->slug) }}">{{ $product->title }}</a>
                        </h5>

                        @php $currentPrice = $product->promotional_price > 0 ? $product->promotional_price : $product->regular_price @endphp

                        <p class="card-text">{{ localPrice($currentPrice) ?? '' }}<span>{{ currency() }}</span></p>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    @if (count($searchProducts) > 0)
        <div class="navbar-search-btn-link text-center">
            <a href="{{ route('search') }}?keyword={{ $keyword ?? '' }}" class="text-danger">{{ trans('Виж всички резултати') }} >> </a>
        </div>
    @else
        <div class="navbar-search-btn-link text-center">
            {{ trans('Няма резултати съответстващи на вашето търсене') }}
        </div>
    @endif
@endif
