@extends('admin.layout')

@section('title')
    Отчет "Продажби по източник"
@endsection

@section('page_title')
    Отчет "Продажби по източник"
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
            <div class="col-lg-6">
                <!--begin::Portlet-->
                <div class="kt-portlet kt-portlet--tab">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                        <span class="kt-portlet__head-icon kt-hidden">
                            <i class="la la-gear"></i>
                        </span>
                            <h3 class="kt-portlet__head-title">
                                Продажби по държава
                            </h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <div id="am_chart_sales_by_country" style="height: 500px;">Няма данни</div>
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
                                Продажби по канал (всички държави)
                            </h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <div id="am_chart_sales_by_channel" style="height: 500px;">Няма данни</div>
                    </div>
                </div>
                <!--end::Portlet-->
            </div>
            @foreach($salesByChannelByCountry as $country => $countrySalesByChannel)
                <div class="col-lg-6">
                    <!--begin::Portlet-->
                    <div class="kt-portlet kt-portlet--tab">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                        <span class="kt-portlet__head-icon kt-hidden">
                            <i class="la la-gear"></i>
                        </span>
                                <h3 class="kt-portlet__head-title">
                                    Продажби по канал ({{ $country }})
                                </h3>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <div id="am_chart_sales_by_channel_{{$country}}" style="height: 500px;">Няма данни</div>
                        </div>
                    </div>
                    <!--end::Portlet-->
                </div>
            @endforeach
        </div>
    @endif
@endsection

@section('page_js')
    <script src="{{ asset('js/filters-form.js') }}" type="text/javascript"></script>
    @parent

    <script src="{{ asset('themes/metronic/assets/js/pages/crud/forms/widgets/bootstrap-datetimepicker.js') }}" type="text/javascript"></script>

    @if($errors->count()==0 && request()->has('from_date'))
        <script>
            function createAmChart(divChartID, chartData, showTotal = true) {

                am4core.useTheme(am4themes_animated);
                var chartSales = am4core.create(divChartID, am4charts.PieChart);
                chartSales.language.locale["_thousandSeparator"] = " ";
                chartSales.numberFormatter.numberFormat = "#,###.";

                chartSales.data = chartData;

                // Add and configure Series
                var pieSeries = chartSales.series.push(new am4charts.PieSeries());

                pieSeries.dataFields.value = Object.keys(chartData[0])[0];
                pieSeries.dataFields.category = Object.keys(chartData[0])[1];
                pieSeries.dataFields.count = Object.keys(chartData[0])[2];
                pieSeries.slices.template.stroke = am4core.color("#fff");
                pieSeries.slices.template.strokeWidth = 2;
                pieSeries.slices.template.strokeOpacity = 1;

                // This creates initial animation
                pieSeries.hiddenState.properties.opacity = 1;
                pieSeries.hiddenState.properties.endAngle = -90;
                pieSeries.hiddenState.properties.startAngle = -90;
                //pieSeries.labels.template.text = "{category}: ({value.percent.formatNumber('###.00')}%) {value.value} BGN";

                chartSales.legend = new am4charts.Legend(); // Add a legend
                chartSales.legend.labels.template.text = "{category}: {value.value} BGN / {count} поръчки";

                //add chart title
                if (showTotal) {
                    var chartTitle = chartSales.titles.create();
                    chartTitle.text = "Общо {!! $salesByCountry['grand_total'] !!} лв. / {!! $salesByCountry['grand_total_orders'] !!} поръчки";
                    chartTitle.fontSize = 25;
                    chartTitle.marginBottom = 5;
                }

            }

            var amChartSalesByCountryData={!!json_encode($salesByCountry['chart_data'], JSON_UNESCAPED_UNICODE)!!};
            var amChartSalesByChannelAllCountriesData={!!json_encode($salesByChannel, JSON_UNESCAPED_UNICODE)!!};


            am4core.ready(function() {
                if(amChartSalesByCountryData.length>0) {
                    createAmChart("am_chart_sales_by_country", amChartSalesByCountryData);
                }
                if(amChartSalesByChannelAllCountriesData.length>0) {
                    createAmChart("am_chart_sales_by_channel", amChartSalesByChannelAllCountriesData);
                }
                @if (count($salesByChannelByCountry))
                @foreach($salesByChannelByCountry as $country => $countrySalesByChannel)
                var amChartSalesByChannelByCountryData={!!json_encode($countrySalesByChannel, JSON_UNESCAPED_UNICODE)!!};
                createAmChart("am_chart_sales_by_channel_{{ $country }}", amChartSalesByChannelByCountryData, false);
                @endforeach
                @endif
            });

        </script>
    @endif

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
        });
    </script>

@endsection

