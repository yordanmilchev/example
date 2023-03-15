<div class="sidebar">
    <form id="filters-form" action="?" method="get" class="section-filter-wrapper">
        @if (isset($keyword))
            <input type="hidden" name="keyword" value="{{ $keyword }}"/>
        @endif
        <div class="widgets collapse show" id="collapseAll">
            <div class="widget">
                <div class="widget-title-wrapper">
                    <span class="widget-title">{{ trans('Филтри') }}</span>

                    <button type="submit" class="btn btn-dark"
                            style="padding: 0.25rem 1.5rem;">{{ trans('Приложи') }}</button>
                </div>
            </div><!-- /.widget -->

            <div class="widget">
                <button class="widget-title-wrapper" data-toggle="collapse" data-target="#collapseSorting" role="button"
                        aria-expanded="true" aria-controls="collapseExample">
                    <span class="widget-title">{{ trans('Сортиране') }}</span>

                    <i class="fas fa-chevron-up"></i>
                </button><!-- /.widget-title-wrapper -->

                <div class="collapse show" id="collapseSorting">
                    <div class="widget-inner pt-3 text-center">

                        <select class="select-sort" name="sort[direction]" id="sort-direction">
                            <option value="recommended">{{ trans('Препоръчани') }}</option>
                            <option value="newest">{{ trans('Най-нови') }}</option>
                            <option value="lowest_price">{{ trans('Най-ниска цена') }}</option>
                            <option value="highest_price">{{ trans('Най-висока цена') }}</option>
                        </select>
                    </div>
                </div>
            </div><!-- /.widget -->

            <div class="widget">
                <button class="widget-title-wrapper" data-toggle="collapse" data-target="#productPrice" role="button"
                        aria-expanded="true" aria-controls="collapseExample">
                    <span class="widget-title">{{ trans('Цена') }}</span>

                    <i class="fas fa-chevron-up"></i>
                </button><!-- /.widget-title-wrapper -->

                <div class="collapse show" id="productPrice">
                    <div class="widget-inner">
                        <p>
                            <input name="filters[start_price]" type="hidden" id="price-min"
                                   value="{{ $selectedFilters['start_price'] ?? '' }}">
                            <input name="filters[end_price]" type="hidden" id="price-max"
                                   value="{{ $selectedFilters['end_price'] ?? '' }}">
                        </p>

                        <div id="slider-range"></div>

                    </div><!-- /.widget-inner -->
                </div>
            </div><!-- /.widget -->


            @if($filters != '')
                @foreach($filters as $filter)
                    @if ($filter->translate(locale()))
                        <div class="widget">
                            <button class="widget-title-wrapper" data-toggle="collapse"
                                    data-target="#aspiratorAirRemoval"
                                    role="button"
                                    aria-expanded="true" aria-controls="collapseExample">
                                <span class="widget-title">{{ $filter->translate(locale())->name }}</span>

                                <i class="fas fa-chevron-up"></i>
                            </button><!-- /.widget-title-wrapper -->

                            <div class="collapse show" id="aspiratorAirRemoval">
                                <div class="widget-inner">
                                    @foreach ($filter->attributeChoices as $choice)
                                    <div class="custom-control custom-checkbox">
                                        <input name="filters[attribute_choices][{{ $filter->machine_name }}][{{ $choice->id }}]"
                                               type="checkbox" class="custom-control-input" {{ isset($selectedChoicesById[$choice->id]) ? 'checked' : '' }}
                                               id="{{$choice->id}}" data-id="{{$choice->id}}"
                                               value="{{ $selectedFilters['attribute_choices'][$filter->machine_name][$choice->id] ?? '' }}">

                                        <label class="custom-control-label" for="{{ $choice->id }}">{{ $choice->translate(locale())->name ??
                                                $choice->translate('bg')->name }}</label>
                                    </div>
                                    @endforeach
                                </div><!-- /.widget-inner -->
                            </div>
                        </div><!-- /.widget -->
                    @endif
                @endforeach
            @endif
            <div class="widget">
                <div class="widget-title-wrapper text-center">
                    <a href="?" class="btn btn-danger w-100"
                       style="padding: 0.25rem 2rem; display: inline-block;">{{ trans('Изчисти всички') }}</a>
                </div>
            </div><!-- /.widget -->
        </div><!-- /.widgets -->
    </form>
</div>


@section('page_js')
    <script>
        @if(isset($hideFilters))
        $(document).ready(function(e) {
            $(".sidebar").hide();
        });
        @endif

        const localeMultiplier = {{ localPrice(1) }};

        $(document).ready(function () {
            $("#slider-range").slider({
                range: true,
                animate: true,
                min: 0,
                max: 5000,
                values: [{{ isset($selectedFilters['start_price']) && $selectedFilters['start_price'] > 1  ? $selectedFilters['start_price'] : 0 }},
                    {{ isset($selectedFilters['end_price']) && $selectedFilters['end_price'] <= 5000 && $selectedFilters['end_price'] > 1? $selectedFilters['end_price'] : 5000 }}],
                create: function (event, ui) {
                    $("#slider-range").find('.ui-slider-handle').first().attr('data-price', Math.floor($("#slider-range").slider("values", 0)*localeMultiplier));
                    $("#slider-range").find('.ui-slider-handle').last().attr('data-price', Math.floor($("#slider-range").slider("values", 1)*localeMultiplier));
                },
                slide: function (event, ui) {
                    $("#amount").val(ui.values[0] + " - " + ui.values[1]);

                    $(this).find('.ui-slider-handle').first().attr('data-price', Math.floor(ui.values[0]*localeMultiplier));
                    $(this).find('.ui-slider-handle').last().attr('data-price', Math.floor(ui.values[1]*localeMultiplier));

                    $("#price_min").val($("#slider-range").slider("values", 0));
                    $("#price_max").val($("#slider-range").slider("values", 1));
                },
                stop: function (event, ui) {
                    $("#price-min").val($("#slider-range").slider("values", 0));
                    $("#price-max").val($("#slider-range").slider("values", 1));
                }
            });

            // Set initial value
            $("#price-min").val($("#slider-range").slider("values", 0));
            $("#price-max").val($("#slider-range").slider("values", 1));


            $('.select-sort').on('change', function () {
                $('#filters-form').submit();
            })

            var sort = @json($sortMethod);

            if(typeof(sort) != "undefined" && sort !== null){
                $('#sort-direction').val(sort.direction);
            }
        })
    </script>
@endsection
