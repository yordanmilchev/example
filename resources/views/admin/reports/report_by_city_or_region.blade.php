@extends('admin.layout')

@section('title')
    Отчет "Продажби по град или регион"
@endsection

@section('page_title')
    Отчет "Продажби по град или регион"
@endsection

@section('body_content')
    <div class="row">
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
                        <div class="col-md-4">
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text">
                                            <i class="fa fa-credit-card"></i>
                                        </span></div>
                                <select id="payment_method" name="payment_method" class="form-control">
                                    <option value="">-Метод на плащане-</option>
                                    @foreach(\App\Constant\OrderPaymentMethodConstant::ALL_PAYMENT_METHODS as $paymentMethodKey)
                                        <option value="{!!$paymentMethodKey!!}">
                                            {{\App\Constant\OrderPaymentMethodConstant::PAYMENT_METHOD_LABELS[$paymentMethodKey]}}</option>
                                    @endforeach
                                </select>
                            </div>
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

    @if($errors->count()==0 && request()->has('from_date'))
        <div class="row">
            <div class="col-lg-12">
                <!--begin::Portlet-->
                <div class="kt-portlet kt-portlet--tab">
                    <div class="kt-portlet__body">

                        <!--begin::Section-->
                        <div class="kt-section">
                            <div class="kt-section__content">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead class="thead-light">
                                        <tr>
                                            <th class="text-center font-weight-bold">ID</th>
                                            <th class="text-center font-weight-bold">Град / Регион</th>
                                            <th class="text-center font-weight-bold">Оборот</th>
                                            <th class="text-center font-weight-bold">Продукти (бр.)</th>
                                            <th class="text-center font-weight-bold">Ср. цена</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse ($salesArr as $region)
                                            <tr>
                                                <td class="text-center" style="width: 1% !important;">
                                                    {{ $loop->iteration }}
                                                </td>
                                                <td class="text-center">
                                                    <?php
                                                    $url = request()->url() . '?from_date=' . request()->from_date . '&to_date=' . request()->to_date . '&payment_method=' . request()->payment_method;
                                                    ?>
                                                    @if(isset($region->city_neighbourhood))
                                                        {{ $region->city_neighbourhood }}
                                                    @elseif(isset($region->postal_code))
                                                        @php
                                                            $regionName = App\Models\City::where('postal_code', $region->postal_code)->distinct()->get(['name'])->first();
                                                        @endphp
                                                        <a href="{{ $url.'&city='.$region->postal_code }}">{{ $regionName->name }}</a>
                                                    @elseif(isset($region->city_municipality))
                                                        <a href="{{ $url.'&municipality='.$region->city_municipality }}">{{ $region->city_municipality }}</a>
                                                    @elseif(isset($region->city_district))
                                                        <a href="{{ $url.'&district='.$region->city_district }}">{{ $region->city_district }}</a>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    {{ number_format($region->total_amount, 0, '.', ' ') }} {{ config('app.currencies')[$region->location] }}
                                                </td>
                                                <td class="text-center">
                                                    {{ $region->products_count }}
                                                </td>
                                                <td class="text-center">
                                                    <?php
                                                    if ($region->products_count > 0) {
                                                        $avgPrice = $region->total_amount / $region->products_count;
                                                        echo number_format($avgPrice, 0, '.', ' ').' '.config('app.currencies')[$region->location];
                                                    } else {
                                                        echo '0';
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center text-danger">Няма резултати</td>
                                            </tr>
                                        @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
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

    <script src="{{ asset('themes/metronic/assets/js/pages/crud/forms/widgets/bootstrap-datetimepicker.js') }}"
            type="text/javascript"></script>


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

            $('#payment_method').val('{{ old('payment_method') }}')
        });
    </script>
@endsection
