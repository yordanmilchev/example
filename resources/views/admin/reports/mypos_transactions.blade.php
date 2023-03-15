@extends('admin.layout')

@section('title')
    Справка транзакции през MyPos за период
@endsection

@section('page_title')
    Справка транзакции през MyPos за период
@endsection

@section('body_content')
    <!--begin::Portlet-->
    <div class="kt-portlet" id="kt_portlet_filters_form">
        <div class="kt-portlet__head kt-ribbon kt-ribbon--success">
            <div class="kt-ribbon__target" style="top: 15px; left: -14px;"><i class="fa fa-search"></i>
            </div>
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
        <form id="filters_form" name="filters_form" class="kt-form kt-form--label-right" method="GET"
              action="">
            <div class="kt-portlet__body">
                <div class="form-group row">
                    <label class="col-form-label col-md-1 col-sm-12">Период</label>
                    <div class="col-md-5 col-sm-12">
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

                    <div class="col-lg-3">
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text">
                                            <i class="fa fa-flag"></i>
                                    </span></div>
                            <select id="country" name="country" class="form-control">
                                <option value="">- Държава -</option>
                                @foreach(locales() as $locale)
                                    <option
                                        value="{{$locale}}" {{ old('country') == $locale ? 'selected' : '' }}>{{country($locale)}}</option>
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
                            <button type="submit" class="btn btn-primary">Търсене</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!--end::Form-->
    </div>
    <!--end::Portlet-->
    <!--begin::Portlet-->
    <div class="kt-portlet">
        <div class="kt-portlet__body">
            <!--begin::Section-->
            <div class="kt-section">
                <div class="kt-section__content">
                    @include('admin.components.flashes')
                    <div class="table-responsive">
                        {{ $myPosTransactionsForPeriod->appends(request()->query())->links() }}
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="thead-light">
                            <tr>
                                <th class="text-center font-weight-bold">Дата на трансфер</th>
                                <th class="text-center font-weight-bold">Сума</th>
                                <th class="text-center font-weight-bold">Card IPS</th>
                                <th class="text-center font-weight-bold">Код на транзакцията</th>
                                <th class="text-center font-weight-bold">Поръчка №</th>
                                <th class="text-center font-weight-bold">MyPos Метод</th>
                                <th class="text-center font-weight-bold">MyPos Статус</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse ($myPosTransactionsForPeriod as $transaction)
                                <tr>
                                    <td class="text-center">
                                        @if(!empty($transaction->transaction_datetime))
                                            {{ Carbon\Carbon::parse($transaction->transaction_datetime)->format('d.m.Y') }}
                                            <small>{{ Carbon\Carbon::parse($transaction->transaction_datetime)->format('H:i') }}</small>
                                        @else
                                            {{ Carbon\Carbon::parse($transaction->created_at)->format('d.m.Y') }}
                                            <small>{{ Carbon\Carbon::parse($transaction->created_at)->format('H:i') }}</small>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        {{ $transaction->amount ?? '' }} {{ $transaction->currency ?? '' }}
                                    </td>
                                    <td class="text-center">
                                        {{ $transaction->card_type ?? '' }}
                                    </td>
                                    <td class="text-center">
                                        {{ $transaction->sid ?? '' }}
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.orders.show', ['order'=>$transaction->order_id]) }}">
                                            {{ $transaction->order_id }}
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        {{ $transaction->ipc_method ?? '' }}
                                    </td>
                                    <td class="text-center">
                                        {{ $transaction->status_message ?? '' }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-danger">Няма резултати</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="table-responsive">
                        {{ $myPosTransactionsForPeriod->appends(request()->query())->links() }}
                    </div>
                </div>

                <a href="{{ route('admin.report.mypos_transactions.export', ['from' => request()->from_date, 'to' => request()->to_date, 'status' => request()->status, 'country' => request()->country]) }}"
                   class="btn btn-success float-right font-weight-bold" style="font-size: 14px;">
                    <i class="fas fa-file-excel"></i> ЕКСПОРТ на справката
                </a>
            </div>
            <!--end::Section-->
        </div>
    </div>
    <!--end::Portlet-->
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

            var portlet = new KTPortlet('kt_portlet_tools_1'); //portlet.collapse();

            $('#status').val('{{ old('status') }}');
            $('#country').val('{{ old('country') }}');
        });
    </script>
@endsection
