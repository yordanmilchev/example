@extends('admin.layout')

@section('title')
    Отчет "Продажби по регион"
@endsection

@section('page_title')
    Отчет "Продажби по регион"
@endsection

@section('body_content')
    <div class="row">
        <div class="col-lg-12">
            <!--begin::Portlet-->
            <div class="kt-portlet" id="kt_portlet_filters_form">
                <div class="kt-portlet__head kt-ribbon kt-ribbon--success">
                    <div class="kt-ribbon__target" style="top: 15px; left: -14px;"><i class="fa fa-search"></i></div>
                    <div class="kt-portlet__head-label"
                         onclick="document.getElementById('searchOptionsToggleBtn').click();">
                        <h3 class="kt-portlet__head-title">
                            Филтри
                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <div class="kt-portlet__head-group">
                            <a href="javascript:;" data-ktportlet-tool="toggle" id="searchOptionsToggleBtn"
                               class="btn btn-sm btn-icon btn-outline-brand btn-icon-md"><i
                                    class="la la-angle-down"></i></a>
                            <a href="javascript:;" data-ktportlet-tool="reload"
                               class="btn btn-sm btn-icon btn-outline-success btn-icon-md"><i class="la la-refresh"></i></a>
                            <a href="javascript:;" data-ktportlet-tool="remove"
                               class="btn btn-sm btn-icon btn-outline-danger btn-icon-md"><i class="la la-close"></i></a>
                        </div>
                    </div>
                </div>

                <!--begin::Form-->
                <form name="report-by-region-form" class="kt-form kt-form--label-right" method="POST" action="" autocomplete="off">
                    @csrf
                    <div class="kt-portlet__body">
                        <label class="col-form-label col-sm-12">Период</label>
                        <div class="form-row">
                            <div class="col">
                                <div class="input-daterange input-group" id="from_datepicker">
                                    <div class="input-group-append">
                                        <span class="input-group-text">от</span>
                                    </div>
                                    <input type="text" id="from_date" name="from_date" value="{{ old('from_date') }}" class="form-control datepicker-input @error('from_date') is-invalid @enderror" >

                                    <div class="invalid-feedback">
                                        @error('from_date'){{ $message }}@enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="input-daterange input-group" id="to_datepicker">
                                    <div class="input-group-append">
                                        <span class="input-group-text">до</span>
                                    </div>
                                    <input type="text" id="to_date" name="to_date" value="{{ old('to_date') }}" size="15" class="form-control datepicker-input @error('to_date') is-invalid @enderror" >
                                    <div class="invalid-feedback">
                                        @error('to_date'){{ $message }}@enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <input id="delivery_region_visible" name="delivery_region_visible" value="{{ old('delivery_region_visible') }}"
                                       type="text" class="form-control @error('delivery_region') is-invalid @enderror" placeholder="Област" readonly onfocus="this.removeAttribute('readonly');" >
                                <input id="delivery_region" name="delivery_region" value="{{ old('delivery_region') }}"
                                       type="hidden">

                            </div>
                            <div class="col">
                                <input id="delivery_city_visible" name="delivery_city_visible" value="{{ old('delivery_city_visible') }}"
                                       type="text" class="form-control @error('delivery_city_id') is-invalid @enderror" placeholder="Населено място" readonly onfocus="this.removeAttribute('readonly');" >
                                <input id="delivery_city_id" name="delivery_city_id" value="{{ old('delivery_city_id') }}"
                                       type="hidden">
                            </div>
                        </div>
                    </div>
                    <div class="kt-portlet__foot">
                        <div class="kt-form__actions">
                            <div class="row">
                                <div class="col-lg-12">
                                    <button type="submit" class="btn btn-primary js-loader">Генериране</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                <!--end::Form-->
            </div>
            <!--end::Portlet-->
        </div>
    </div>

    @if (Request::method() === 'POST')
        <div class="row">
            <div class="col-lg-6">
                <!--begin::Portlet-->
                <div class="kt-portlet kt-portlet--tab">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                        <span class="kt-portlet__head-icon kt-hidden">
                            <i class="la la-gear"></i>
                        </span>
                            <h3 class="kt-portlet__head-title">
                                Топ 50 продукти
                            </h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <div class="kt-scroll ps ps--active-x ps--active-y" data-scroll="true" data-scroll-x="true" style="height: 500px; overflow: hidden;">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead class="thead-light">
                                    <tr>
                                        <th class="text-center font-weight-bold">#</th>
                                        <th class="text-center font-weight-bold">Модел</th>
                                        <th class="text-center font-weight-bold">Брой</th>
                                        <th class="text-center font-weight-bold">Обща стойност</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse ($reportTopModels as $modelData)
                                        <tr>
                                            <td class="text-center">
                                                {{ $loop->index + 1 }}
                                            </td>
                                            @php
                                                $modelName = App\Models\Catalog\Product::where('sku', $modelData->model_name)->first();
                                            @endphp
                                            <td class="text-center"><strong>
                                                    {{ $modelData->model_name }}</strong>&nbsp;{{ $modelName->translate('bg')->title }}
                                            </td>
                                            <td class="text-center">
                                                {{ $modelData->total_quantity }}
                                            </td>
                                            <td class="text-center font-weight-bold">
                                                {{ number_format($modelData->total_amount, 0, '.', '') }} лв.
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="42" class="text-center text-danger">Няма резултати</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="ps__rail-x" style="width: 1063px; left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 300px;"></div></div><div class="ps__rail-y" style="top: 0px; height: 200px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 40px;"></div></div></div>
                    </div>
                </div>
                <!--end::Portlet-->
            </div>
            <div class="col-lg-6">
                <!--begin::Portlet-->
                <div class="kt-portlet kt-portlet--tab">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                        <span class="kt-portlet__head-icon kt-hidden">
                            <i class="la la-gear"></i>
                        </span>
                            <h3 class="kt-portlet__head-title">
                                Продажби по източник (за региона)
                            </h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <div id="am_chart_sales_by_channel" style="height: 500px;">Няма данни</div>
                    </div>
                </div>
                <!--end::Portlet-->
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <!--begin::Portlet-->
                <div class="kt-portlet kt-portlet--tab">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                        <span class="kt-portlet__head-icon kt-hidden">
                            <i class="la la-gear"></i>
                        </span>
                            <h3 class="kt-portlet__head-title">
                                Сравнителна справка 'Регион спрямо цяла България'
                            </h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead class="thead-light">
                                <tr>
                                    <th class="text-center font-weight-bold"> </th>
                                    <th class="text-center font-weight-bold">За избрания регион/населено място</th>
                                    <th class="text-center font-weight-bold">За цяла България</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Средна стойност на поръчка</td>
                                        <td class="text-right font-weight-bold">{{ number_format($reportRegionToBgComparison['average_per_order']['region'], 0, '.', ' ') }} лв.</td>
                                        <td class="text-right font-weight-bold">{{ number_format($reportRegionToBgComparison['average_per_order']['bg'], 0, '.', ' ') }} лв</td>
                                    </tr>
                                    <tr>
                                        <td>Оборот на човек</td>
                                        <td class="text-right font-weight-bold">{{ number_format($reportRegionToBgComparison['turnover_per_person']['region'], 0, '.', ' ') }} лв.</td>
                                        <td class="text-right font-weight-bold">{{ number_format($reportRegionToBgComparison['turnover_per_person']['bg'], 0, '.', ' ') }} лв.</td>
                                    </tr>
                                    <tr>
                                        <td>Брой поръчки на човек</td>
                                        <td class="text-right font-weight-bold">{{ number_format($reportRegionToBgComparison['orders_per_person']['region'], 5, '.', ' ') }} бр.</td>
                                        <td class="text-right font-weight-bold">{{ number_format($reportRegionToBgComparison['orders_per_person']['bg'], 5, '.', ' ') }} бр.</td>
                                    </tr>
                                    <tr>
                                        <td>Брой продукти на човек</td>
                                        <td class="text-right font-weight-bold">{{ number_format($reportRegionToBgComparison['order_products_per_person']['region'], 5, '.', ' ') }} бр.</td>
                                        <td class="text-right font-weight-bold">{{ number_format($reportRegionToBgComparison['order_products_per_person']['bg'], 5, '.', ' ') }} бр.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!--end::Portlet-->
            </div>
            <div class="col-lg-6">
                <!--begin::Portlet-->
                <div class="kt-portlet kt-portlet--tab">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                        <span class="kt-portlet__head-icon kt-hidden">
                            <i class="la la-gear"></i>
                        </span>
                            <h3 class="kt-portlet__head-title">
                                Изменение по периоди
                            </h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="text-center font-weight-bold"> </th>
                                        <th class="text-center font-weight-bold">Текущ период</th>
                                        <th class="text-center font-weight-bold">Предходна година</th>
                                        <th class="text-center font-weight-bold">Изменение в лв.</th>
                                        <th class="text-center font-weight-bold">Изменение в %</th>
                                        <th class="text-center font-weight-bold">Предходен месец</th>
                                        <th class="text-center font-weight-bold">Изменение в лв.</th>
                                        <th class="text-center font-weight-bold">Изменение в %</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Общо</td>
                                        <td class="text-right font-weight-bold">{{ number_format($reportByPeriodComparison['all']['current_period'], 0, '.', ' ') }} лв.</td>
                                        <td class="text-right font-weight-bold">{{ number_format($reportByPeriodComparison['all']['previous_year_same_period'], 0, '.', ' ') }} лв.</td>
                                        <td class="text-right font-weight-bold">{{ number_format($reportByPeriodComparison['all']['current_to_prev_year_change_bgn'], 0, '.', ' ') }} лв.</td>
                                        <td class="text-right font-weight-bold">{{ number_format($reportByPeriodComparison['all']['current_to_prev_year_change_percent'], 0, '.', ' ') }} %</td>
                                        <td class="text-right font-weight-bold">{{ number_format($reportByPeriodComparison['all']['previous_month'], 0, '.', ' ') }} лв.</td>
                                        <td class="text-right font-weight-bold">{{ number_format($reportByPeriodComparison['all']['current_to_prev_month_change_bgn'], 0, '.', ' ') }} лв.</td>
                                        <td class="text-right font-weight-bold">{{ number_format($reportByPeriodComparison['all']['current_to_prev_month_change_percent'], 0, '.', ' ') }} %</td>
                                    </tr>
                                    <tr>
                                        <td>Плащане при доставка</td>
                                        <td class="text-right font-weight-bold">{{ number_format($reportByPeriodComparison['cod']['current_period'], 0, '.', ' ') }} лв.</td>
                                        <td class="text-right font-weight-bold">{{ number_format($reportByPeriodComparison['cod']['previous_year_same_period'], 0, '.', ' ') }} лв.</td>
                                        <td class="text-right font-weight-bold">{{ number_format($reportByPeriodComparison['cod']['current_to_prev_year_change_bgn'], 0, '.', ' ') }} лв.</td>
                                        <td class="text-right font-weight-bold">{{ number_format($reportByPeriodComparison['cod']['current_to_prev_year_change_percent'], 0, '.', ' ') }} %</td>
                                        <td class="text-right font-weight-bold">{{ number_format($reportByPeriodComparison['cod']['previous_month'], 0, '.', ' ') }} лв.</td>
                                        <td class="text-right font-weight-bold">{{ number_format($reportByPeriodComparison['cod']['current_to_prev_month_change_bgn'], 0, '.', ' ') }} лв.</td>
                                        <td class="text-right font-weight-bold">{{ number_format($reportByPeriodComparison['cod']['current_to_prev_month_change_percent'], 0, '.', ' ') }} %</td>
                                    </tr>
                                    <tr>
                                        <td>Банков превод MyPos</td>
                                        <td class="text-right font-weight-bold">{{ number_format($reportByPeriodComparison['mypos_card']['current_period'], 0, '.', ' ') }} лв.</td>
                                        <td class="text-right font-weight-bold">{{ number_format($reportByPeriodComparison['mypos_card']['previous_year_same_period'], 0, '.', ' ') }} лв.</td>
                                        <td class="text-right font-weight-bold">{{ number_format($reportByPeriodComparison['mypos_card']['current_to_prev_year_change_bgn'], 0, '.', ' ') }} лв.</td>
                                        <td class="text-right font-weight-bold">{{ number_format($reportByPeriodComparison['mypos_card']['current_to_prev_year_change_percent'], 0, '.', ' ') }} %</td>
                                        <td class="text-right font-weight-bold">{{ number_format($reportByPeriodComparison['mypos_card']['previous_month'], 0, '.', ' ') }} лв.</td>
                                        <td class="text-right font-weight-bold">{{ number_format($reportByPeriodComparison['mypos_card']['current_to_prev_month_change_bgn'], 0, '.', ' ') }} лв.</td>
                                        <td class="text-right font-weight-bold">{{ number_format($reportByPeriodComparison['mypos_card']['current_to_prev_month_change_percent'], 0, '.', ' ') }} %</td>
                                    </tr>
                                    <tr>
                                        <td>Банков превод Borica</td>
                                        <td class="text-right font-weight-bold">{{ number_format($reportByPeriodComparison['borica']['current_period'], 0, '.', ' ') }} лв.</td>
                                        <td class="text-right font-weight-bold">{{ number_format($reportByPeriodComparison['borica']['previous_year_same_period'], 0, '.', ' ') }} лв.</td>
                                        <td class="text-right font-weight-bold">{{ number_format($reportByPeriodComparison['borica']['current_to_prev_year_change_bgn'], 0, '.', ' ') }} лв.</td>
                                        <td class="text-right font-weight-bold">{{ number_format($reportByPeriodComparison['borica']['current_to_prev_year_change_percent'], 0, '.', ' ') }} %</td>
                                        <td class="text-right font-weight-bold">{{ number_format($reportByPeriodComparison['borica']['previous_month'], 0, '.', ' ') }} лв.</td>
                                        <td class="text-right font-weight-bold">{{ number_format($reportByPeriodComparison['borica']['current_to_prev_month_change_bgn'], 0, '.', ' ') }} лв.</td>
                                        <td class="text-right font-weight-bold">{{ number_format($reportByPeriodComparison['borica']['current_to_prev_month_change_percent'], 0, '.', ' ') }} %</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!--end::Portlet-->
            </div>
        </div>
    @endif
@endsection

@section('page_js')
    <script src="{{ asset('js/filters-form.js') }}" type="text/javascript"></script>
    @parent

    <script src="{{ asset('themes/metronic/assets/js/pages/crud/forms/widgets/bootstrap-datetimepicker.js') }}" type="text/javascript"></script>

    <script>
        $(document).ready(function(){
            $(function () {
                var dateOptions = {
                    format: "yyyy-mm-dd",
                    autoclose: true,
                    todayHighlight: true,
                    language: '{{ Lang::locale() }}',
                    todayBtn: true,
                    weekStart: 1
                };

                $('#from_date').datepicker(dateOptions);
                $('#to_date').datepicker(dateOptions);
            });

            var citiesBloodhound = new Bloodhound({
                datumTokenizer: Bloodhound.tokenizers.whitespace,
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                remote: {
                    url: '/autocomplete/cities?query=%QUERY',
                    wildcard: '%QUERY',
                }
            });

            $('#delivery_city_visible').typeahead({
                hint: true,
                highlight: true,
                minLength: 2,
            }, {
                name: 'cities',
                display: 'name',
                limit: 10,
                source: citiesBloodhound,
                templates: {
                    empty: [
                        '<div class="empty-message text-center text-danger">',
                        'Няма намерени.',
                        '</div>'
                    ].join('\n'),
                    suggestion: Handlebars.compile(
                        '<div><strong><?php echo "{{type}} {{name}}"; ?></strong> (обл. <?php echo "{{district}}"; ?>) - <?php echo "{{country}}"; ?></div>'
                    )
                }
            })
            .on('typeahead:selected', function (ev, suggestion) {
                $('#delivery_city_id').val(suggestion.id);
            })
            .on('keyup', function (e) {
                $('#delivery_city_id').val('');
            });

            var districtsBloodhound = new Bloodhound({
                datumTokenizer: Bloodhound.tokenizers.whitespace,
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                remote: {
                    url: '/autocomplete/districts?query=%QUERY',
                    wildcard: '%QUERY',
                }
            });

            $('#delivery_region_visible').typeahead({
                hint: true,
                highlight: true,
                minLength: 2,
            }, {
                name: 'districts',
                display: 'district',
                limit: 10,
                source: districtsBloodhound,
                templates: {
                    empty: [
                        '<div class="empty-message text-center text-danger">',
                        'Няма намерени.',
                        '</div>'
                    ].join('\n'),
                    suggestion: Handlebars.compile(
                        '<div><strong><?php echo "{{district}}"; ?></strong> - <?php echo "{{country}}"; ?></div>'
                    )
                }
            })
            .on('typeahead:selected', function (ev, suggestion) {
                $('#delivery_region').val(suggestion.district);
            })
            .on('keyup', function (e) {
                $('#delivery_region').val('');
            });

            var portlet = new KTPortlet('report_filters');
        });

    </script>
    @if(!empty($reportBySource))
        <script>
            function createAmChart(divChartID, chartData) {

                am4core.useTheme(am4themes_animated);
                var chartSalesByCountry = am4core.create(divChartID, am4charts.PieChart);
                chartSalesByCountry.data = chartData;
                chartSalesByCountry.language.locale["_thousandSeparator"] = " ";

                // Add and configure Series
                var pieSeries = chartSalesByCountry.series.push(new am4charts.PieSeries());
                pieSeries.dataFields.value = "total_amount";
                pieSeries.dataFields.category = "source_string";
                pieSeries.slices.template.stroke = am4core.color("#fff");
                pieSeries.slices.template.strokeWidth = 2;
                pieSeries.slices.template.strokeOpacity = 1;

                // This creates initial animation
                pieSeries.hiddenState.properties.opacity = 1;
                pieSeries.hiddenState.properties.endAngle = -90;
                pieSeries.hiddenState.properties.startAngle = -90;
                //pieSeries.numberFormatter.numberFormat = '#,### лв.';
                pieSeries.numberFormatter.numberFormat = "#,###.";

                chartSalesByCountry.legend = new am4charts.Legend(); // Add a legend
                chartSalesByCountry.legend.labels.template.text = "{category}: {total_amount} лв.";
            }

            var amChartSalesByChannelData={!! json_encode(array_values($reportBySource)) !!};
            am4core.ready(function() {
                createAmChart("am_chart_sales_by_channel", amChartSalesByChannelData);
            });

        </script>
    @endif

@endsection

@section('head_js')
    <!--[if lt IE 9]>
    <script type='text/javascript' src='{{ asset('vendor/amcharts4/html5shiv.min.js') }}'></script>
    <script type='text/javascript' src='{{ asset('vendor/amcharts4/respond.min.js') }}'></script>
    <![endif]-->
    <script src="{{ asset('vendor/amcharts4/core.js') }}"></script>
    <script src="{{ asset('vendor/amcharts4/charts.js') }}"></script>
    <script src="{{ asset('vendor/amcharts4/themes/animated.js') }}"></script>
@overwrite

@section('page_css')
    <link href="{{ asset('css/custom/typeahead.css') }}" rel="stylesheet" type="text/css" />
@endsection

