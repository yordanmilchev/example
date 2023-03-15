@extends('admin.layout')

@section('title')
    Справка съотношение м/у регулярна цена, промо
@endsection

@section('page_title')
    Справка съотношение м/у регулярна цена, промо
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
                <form class="kt-form kt-form--label-right" method="GET" action="" autocomplete="off">
                    <div class="kt-portlet__body">

                        <div class="form-group row">
                            <div class="col-lg-4">
                                <label class="col-form-label ">Категория</label>
                                <input id="category_visible" name="category_visible" value="{{ old('category_visible') }}"
                                       type="text" class="form-control @error('category_visible') is-invalid @enderror" placeholder="Търсене по категория" readonly onfocus="this.removeAttribute('readonly');" >
                                <input id="category_id" name="category_id" value="{{ old('category_id') }}"
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

    <div class="row">
        <div class="col-lg-12">
            <!--begin::Portlet-->
            <div class="kt-portlet kt-portlet--tab">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <span class="kt-portlet__head-icon kt-hidden">
                            <i class="la la-gear"></i>
                        </span>
                        <h3 class="kt-portlet__head-title">
                            Съотношение м/у цени на продукти
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <div id="am_chart_sales_by_supplier_pie_chart" style="height:800px;margin-bottom:20px;">Няма данни</div>
                </div>
            </div>
            <!--end::Portlet-->
        </div>
    </div>
@endsection

@section('page_js')
    <script src="{{ asset('js/filters-form.js') }}" type="text/javascript"></script>
    @parent

    @if($errors->count()==0)
        <script>
            function createPieAmChart(divChartID, chartData) {
                am4core.useTheme(am4themes_animated);
                var chartSales = am4core.create(divChartID, am4charts.PieChart);

                chartSales.data = chartData;

                // Add and configure Series
                var pieSeries = chartSales.series.push(new am4charts.PieSeries());

                pieSeries.dataFields.value = "count";
                pieSeries.dataFields.category = "price_type_name";
                pieSeries.slices.template.stroke = am4core.color("#fff");
                pieSeries.slices.template.strokeWidth = 2;
                pieSeries.slices.template.strokeOpacity = 1;
                pieSeries.slices.template.tooltipText = "{category}: ({value.percent.formatNumber('###.00')}%) {value.value} бр.";

                // This creates initial animation
                pieSeries.hiddenState.properties.opacity = 1;
                pieSeries.hiddenState.properties.endAngle = -90;
                pieSeries.hiddenState.properties.startAngle = -90;

                chartSales.legend = new am4charts.Legend(); // Add a legend
                // chartSales.legend.labels.template.text = "{category}: {value.value} бр.";

                var chartTitle = chartSales.titles.create();
                chartTitle.text = "Брой продукти общо:  "+totalItemsCount+" бр.";
                chartTitle.fontSize = 25;
                chartTitle.marginBottom = 5;
            }

            var totalItemsCount = "@php echo $totalCount; @endphp";
            var priceTypesCountDataChartData={!!json_encode($priceTypesCount, JSON_UNESCAPED_UNICODE)!!};

            am4core.ready(function() {
                createPieAmChart("am_chart_sales_by_supplier_pie_chart", priceTypesCountDataChartData);
            });

        </script>
    @endif

    <script src="{{ asset('themes/metronic/assets/js/pages/crud/forms/widgets/bootstrap-datetimepicker.js') }}" type="text/javascript"></script>

    <script>
        $(document).ready(function(){
            var categoriesBloodhound = new Bloodhound({
                datumTokenizer: Bloodhound.tokenizers.whitespace,
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                remote: {
                    url: '/autocomplete/categories?query=%QUERY',
                    wildcard: '%QUERY',
                }
            });

            $('#category_visible').typeahead({
                hint: true,
                highlight: true,
                minLength: 2,
            }, {
                name: 'cities',
                display: 'name',
                limit: 10,
                source: categoriesBloodhound,
                templates: {
                    empty: [
                        '<div class="empty-message text-center text-danger">',
                        'Няма намерени.',
                        '</div>'
                    ].join('\n'),
                    suggestion: Handlebars.compile(
                        '<div><strong><?php echo "{{name}}"; ?></strong></div>'
                    )
                }
            })
                .on('typeahead:selected', function (ev, suggestion) {
                    $('#category_id').val(suggestion.id);
                })
                .on('keyup', function (e) {
                    $('#category_id').val('');
                });

            var portlet = new KTPortlet('kt_portlet_tools_1'); //portlet.collapse();
        });
    </script>

@endsection


@section('page_css')
    <link href="{{ asset('css/custom/typeahead.css') }}" rel="stylesheet" type="text/css" />
@endsection

