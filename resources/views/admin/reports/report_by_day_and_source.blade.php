@extends('admin.layout')

@section('title')
Отчет "Продажби по източник и дни"
@endsection

@section('page_title')
Отчет "Продажби по източник и дни"
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
                     onclick="document.getElementById('searchOptionsToggleBtn').click();"
                     style="min-width:70%">
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
                           class="btn btn-sm btn-icon btn-outline-success btn-icon-md"><i
                                class="la la-refresh"></i></a>
                        <a href="javascript:;" data-ktportlet-tool="remove"
                           class="btn btn-sm btn-icon btn-outline-danger btn-icon-md"><i
                                class="la la-close"></i></a>
                    </div>
                </div>
            </div>

            <!--begin::Form-->
            <form id="filters_form" name="filters_form" class="kt-form kt-form--label-right" method="GET" action="">
                <div class="kt-portlet__body">
                    <div class="form-group row">
                        <label class="col-form-label col-md-1 col-sm-12">Период</label>
                        <div class="col-md-6 col-sm-12">
                            <div class="input-daterange input-group" id="kt_datepicker_5">
                                <div class="input-group-append">
                                    <span class="input-group-text">от</span>
                                </div>
                                <input type="text" id="from_date" name="from_date" value="{{ old('from_date') }}"
                                       class="form-control datepicker-input @error('from_date') is-invalid @enderror"
                                       autocomplete="off">
                                <div class="input-group-append">
                                    <span class="input-group-text">до</span>
                                </div>
                                <input type="text" id="to_date" name="to_date" value="{{ old('to_date') }}"
                                       size="15"
                                       class="form-control datepicker-input @error('to_date') is-invalid @enderror"
                                       autocomplete="off">
                                <div class="invalid-feedback">
                                    <div class="row">
                                        <div class="col-6">
                                            @error('from_date'){{ $message }}@enderror
                                        </div>
                                        <div class="col-6">
                                            @error('to_date'){{ $message }}@enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="kt-portlet__foot">
                    <div class="kt-form__actions">
                        <div class="row">
                            <div class="col-lg-12">
                                <button id="submit-form" type="submit" class="btn btn-primary js-loader">
                                    Генериране
                                </button>
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

@if($errors->count()==0 && request()->has('from_date'))
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
                        Продажби по източник и дни
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div id="am_chart_sales_by_day_and_source" style="height: 600px;">Няма данни</div>
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


@if($errors->count()==0 && request()->has('from_date'))
<script>
    function createAmChart(divChartID, chartData) {

        am4core.useTheme(am4themes_animated);

        var chart = am4core.create(divChartID, am4charts.XYChart);

        chart.language.locale["_thousandSeparator"] = " ";
        chart.data = chartData;

        var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
        categoryAxis.dataFields.category = "day";
        categoryAxis.title.text = "Легенда";
        categoryAxis.renderer.grid.template.location = 0;
        categoryAxis.renderer.minGridDistance = 20;
        categoryAxis.renderer.cellStartLocation = 0.1;
        categoryAxis.renderer.cellEndLocation = 0.9;
        categoryAxis.renderer.labels.template.rotation = 270;
        categoryAxis.renderer.labels.template.verticalCenter = "middle";
        categoryAxis.renderer.labels.template.horizontalCenter = "left";

        var  valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
        valueAxis.min = 0;
        valueAxis.title.text = "Продажби (лв.)";
        valueAxis.calculateTotals = true;

        // Create series
        function createSeries(field, name, stacked) {
            var series = chart.series.push(new am4charts.ColumnSeries());
            series.dataFields.valueY = field;
            series.dataFields.categoryX = "day";
            series.name = name;
            series.columns.template.tooltipText = "{name}: {valueY} лв. (Общо: {valueY.sum})";
            series.stacked = stacked;
            series.columns.template.width = am4core.percent(95);
        }

        @foreach(\App\Constant\OrderPaymentMethodConstant::ALL_PAYMENT_METHODS as $paymentMethod)
            createSeries("{{ $paymentMethod }}", "{{ \App\Constant\OrderPaymentMethodConstant::PAYMENT_METHOD_LABELS[$paymentMethod] }}", true);
        @endforeach

        chart.legend = new am4charts.Legend();

    }

    var amChartSalesByDayData={!!json_encode($salesByDayAndSource, JSON_UNESCAPED_UNICODE)!!};

    am4core.ready(function() {
        if(amChartSalesByDayData.length>0) {
            createAmChart("am_chart_sales_by_day_and_source", amChartSalesByDayData);
        }
    });

</script>
@endif

<script>
    $(document).ready(function () {
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

        $('#filters_form').disableAutoFill();
    });
</script>

@endsection
