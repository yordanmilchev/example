@extends('admin.layout')

@section('title')
    Данни за профил {{ $user->name }}
@endsection

@section('page_title')
    Данни за профил {{ $user->name }}
@endsection

@section('body_content')
    <div class="row">
        <div class="col-lg-12">

            <!--begin::Portlet-->
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon">
                        <i class="fa fa-box-open"></i>
                    </span>
                        <h3 class="kt-portlet__head-title">
                            Последна поръчка
                        </h3>
                    </div>
                    @if(count($ordersInfo['orders']) > 0)
                        @php $lastOrder = $ordersInfo['orders'][0]; @endphp
                        <div class="kt-portlet__head-toolbar">
                            <div class="btn-group">
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-danger" disabled>Статус</button>
                                    <div class="btn-group" role="group">
                                        <button id="menuOrderStatus" type="button"
                                                class="btn btn-outline-danger dropdown-toggle"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            {{ $lastOrder->status }}
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right"
                                             aria-labelledby="menuOrderStatus">
                                            @foreach(\App\Constant\OrderStatusConstant::ORDER_STATUS_LABEL as $statusKey => $statusVal)
                                                <button class="dropdown-item js-change-status" type="button"
                                                        data-order-id="{{ $lastOrder->id }}"
                                                        data-value="{!!$statusKey!!}">{{ $statusVal }}</button>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    @endif

                </div>

                <div class="kt-portlet__body" style="min-height: 400px;">
                    <div class="kt-scroll" data-scroll="true" data-scrollbar-shown="true">
                        @if(count($ordersInfo['orders']) > 0)
                            <div class="row">
                                <div class="col-sm-12 col-md-2 col-lg-2 col-xl-2">
                                    <div class="col-inner col-inner-delivery">
                                        <h4 class="kt-font-info">Доставка</h4>

                                        @if(!empty($lastOrder->delivery_first_name) || !empty($lastOrder->delivery_last_name))
                                            <b>Име:</b>
                                        @endif
                                        @if(!empty($lastOrder->delivery_first_name))
                                            {{$lastOrder->delivery_first_name}}
                                        @endif
                                        @if(!empty($lastOrder->delivery_last_name))
                                            {{$lastOrder->delivery_last_name}}
                                        @endif
                                        @if(!empty($lastOrder->delivery_first_name) || !empty($lastOrder->delivery_last_name))
                                            <br>
                                        @endif

                                        @if(!empty($lastOrder->delivery_phone))
                                            <b>Тел.:</b> {{$lastOrder->delivery_phone}}<br>
                                        @endif

                                        @if(!empty($lastOrder->delivery_company))
                                            <b>Фирма:</b> {{$lastOrder->delivery_company}}<br>
                                        @endif

                                        @if(!empty($lastOrder->country_id))
                                            <b>Държава:</b> {{$country->name}}<br>
                                        @endif

                                        @if(!empty($lastOrder->delivery_city))
                                            <b>Област:</b> {{$lastOrder->delivery_district}}<br>
                                            <b>Град:</b> {{$lastOrder->delivery_city}}@if(!empty($lastOrder->delivery_postal_code))
                                                , <b>пощ.к.</b> {{$lastOrder->delivery_postal_code}}@endif
                                            <br>
                                        @endif

                                        @if(!empty($lastOrder->delivery_address))
                                            <b>Адрес:</b> {{$lastOrder->delivery_address}}<br>
                                        @endif

                                        @if(!empty($lastOrder->delivery_office))
                                            <b>Офис на Speedy:</b> {{$lastOrder->delivery_office}}<br>
                                        @endif

                                        @if($lastOrder->country=='Гърция' && !empty($lastOrder->billing_ein))
                                            <b>ΑΦΜ:</b> {{$lastOrder->billing_ein}}<br>
                                        @endif
                                    </div>

                                    <div class="col-inner col-inner-payment mt-3">
                                        <h4 class="kt-font-info">Плащане</h4>

                                        <p><b>Общо:</b> <span
                                                style="font-size: 1.25rem;">{{ number_format($lastOrder->getTotalInOrderCurrency(), 2, '.', '') }} {{ $lastOrder->currency }}.</span>
                                        </p>

                                        <p class="mt-2 mb-1"><b>Начин на плащане:</b> <br></p>
                                        <h6>{{ \App\Constant\OrderPaymentMethodConstant::PAYMENT_METHOD_LABELS[$lastOrder->payment_method] }}</h6>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-10 col-lg-10 col-xl-5">
                                    <div class="table-responsive mt-4 mt-md-0">
                                        <table class="table table-bordered">
                                            <thead class="thead-light">
                                            <tr>
                                                <th>Продукт</th>
                                                <th>Изображение</th>
                                                <th>Количество</th>
                                                <th>Цена</th>
                                                <th>Сума</th>
                                            </tr>
                                            </thead>

                                            <tbody>
                                            @foreach($lastOrder->orderProducts as $orderProduct)

                                                <tr>
                                                    <td>{{ $orderProduct->productRelation->title ?? ($orderProduct->model . ' ' . $orderProduct->title) }}</td>
                                                    <td>
                                                        @if ($orderProduct->productRelation)
                                                            @if (isset($orderProduct->productRelation->getGalleryFiles()->first()->name))
                                                                <a href="{{ route('product', $orderProduct->productRelation->slug) }}"
                                                                   target="_blank">
                                                                    <img
                                                                        src="{{ gallery_image($orderProduct->productRelation->getGalleryFiles()->first()->name, \App\Constant\GalleryFileConstant::TYPE_PRODUCT_IMAGE, \App\Constant\GalleryFileConstant::TYPE_TEASER) }}"
                                                                        alt="" style="width: 35px; height: 25px;">
                                                                </a>
                                                            @endif
                                                        @endif
                                                    </td>
                                                    <td class="text-center">{{ $orderProduct->quantity }}</td>
                                                    <td class="text-right">{{ number_format($orderProduct->price * $lastOrder->exchange_rate, 2, '.', '') }} {{ $lastOrder->currency }}
                                                        .
                                                    </td>
                                                    <td class="text-right">{{ number_format($orderProduct->getTotalAmount() * $lastOrder->exchange_rate, 2, '.', '') }} {{ $lastOrder->currency }}
                                                        .
                                                    </td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td colspan="4" class="text-right"><b>Общо : </b></td>
                                                <td class="text-right">
                                                    <b>{{ $lastOrder->getOrderProductsTotalAmount() * $lastOrder->exchange_rate }} {{ $lastOrder->currency }}
                                                        .</b></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-2">
                                    <!--begin:: Widgets/New Users-->
                                    <div class="kt-portlet kt-portlet--tabs kt-portlet--height-fluid border">
                                        <div class="kt-portlet__head">
                                            <div class="kt-portlet__head-label justify-content-between w-100">
                                                <h3 class="kt-portlet__head-title">
                                                    <b>Услуги</b>
                                                </h3>
                                                <a href="javascript:;" id="add-order-service">
                                                    <i class="fa fa-plus-circle"></i>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="kt-portlet__body p-3">
                                            <div class="tab-content">
                                                <div class="tab-pane active" id="kt_widget4_tab1_content">
                                                    <div class="kt-widget4">
                                                        @if (count($lastOrder->orderServices) > 0)
                                                            @foreach($lastOrder->orderServices as $service)
                                                                <div class="kt-widget4__item">
                                                                    <div class="kt-widget4__info"
                                                                         style="max-width: 70%">
                                                                        <div class="kt-widget4__username d-flex">
                                                                            <b>{{$service->title}}</b>
                                                                            <a href="#"
                                                                               class="js-delete-order-service ml-2 text-danger"
                                                                               data-url="{{ route('admin.orders.delete_service') . '?id=' .  $service->id }}">
                                                                                x
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                    <a class="btn btn-sm btn-label-{{ \App\Constant\OrderStatusConstant::STATUS_BOOTSTRAP_CLASS[$service->order->status] }} btn-bold p-1">+{{ number_format($service->price * $lastOrder->exchange_rate, 2, '.', '') }} {{ $lastOrder->currency }}</a>
                                                                </div>
                                                            @endforeach
                                                        @else
                                                            <div class="kt-widget4__item">
                                                                <div class="kt-widget4__info">
                                                                    <p class="kt-widget4__text">
                                                                        Няма услуги към поръчката
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!--end:: Widgets/New Users-->
                                </div>
                            </div>

                            @include('admin.orders._add_order_service', [ 'order' => $lastOrder ])

                        @else
                            <h3>Няма направени поръчки</h3>
                        @endif
                    </div>

                </div>
            </div>
            <!--end::Portlet-->
        </div>

        <div class="col-12 col-xl-7">
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon">
                        <i class="fa fa-history"></i>
                    </span>
                        <h3 class="kt-portlet__head-title">
                            История на поръчките | Брой: {{ $ordersInfo['ordersNum'] }} | Обща цена: {{ $ordersInfo['ordersTotalAmount'] }}
                        </h3>
                    </div>
                </div>

                <div class="kt-portlet__body" style="min-height: 250px;">
                    <div class="kt-scroll" data-scroll="true" data-height="250" data-scrollbar-shown="true">

                        <table class="table table-bordered">
                            <thead class="thead-light">
                            <tr>
                                <th class="text-center">Поръчка N:</th>
                                <th class="text-center">Продукти</th>
                                <th class="text-center">Дата</th>
                                <th class="text-center">Сума</th>
                                <th class="text-center">Метод на плащане</th>
                                <th class="text-center">Статус</th>
                            </tr>
                            </thead>

                            <tbody>
                            @forelse($ordersInfo['orders'] as $order)
                                <tr>
                                    <td class="text-center">
                                        <a href="{{ route('admin.orders.show', ['order' => $order->id]) }}">
                                            {{ $order->id }} <i class="fa fa-external-link-alt"></i>
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        @foreach($order->orderProducts as $orderProduct)
                                            <a href="{{ route('product', $orderProduct->productInfo()->slug) }}"
                                               target="_blank">{{ $orderProduct->title }}</a><br>
                                        @endforeach
                                    </td>
                                    <td class="text-center">{{ $order->created_at->format('d.m.Y') }}
                                        <small>{{ $order->created_at->format('H:i') }}</small></td>
                                    <td class="text-center">{{ localPrice($order->total) }} {{ $order->currency }}</td>
                                    <td class="text-center">{{ \App\Constant\OrderPaymentMethodConstant::PAYMENT_METHOD_LABELS[$order->payment_method] }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.orders.show', ['order' => $order->id]) }}"
                                           class="btn btn-{{ \App\Constant\OrderStatusConstant::STATUS_BOOTSTRAP_CLASS[$order->status] }} font-weight-bold btn-pill w-100 px-3 py-0">
                                            {{ \App\Constant\OrderStatusConstant::ORDER_STATUS_LABEL[$order->status] }}
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center"><b>Няма направени поръчки</b></td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-xl-5">
            <div class="kt-portlet kt-portlet--tabs kt-portlet--height-fluid border">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon">
                        <i class="fa fa-address-card"></i>
                    </span>
                        <h3 class="kt-portlet__head-title">
                            <b>Адреси</b>
                        </h3>
                    </div>
                </div>

                <div class="kt-portlet__body" style="min-height: 250px;">
                    <div class="kt-scroll" data-scroll="true" data-height="250" data-scrollbar-shown="true">
                        <div class="row">
                            <div class="card-deck" style="width: 100%">
                                @foreach ($dossierUsers as $user)
                                    <div class="col-lg-6 col-md-12 col-sm-12 mb-3">
                                        <div class="card h-100">
                                            <div class="card-body">
                                                <h5 class="card-title">Потребител: {{ $user->name }}</h5>
                                                <p class="card-text">

                                                    @php $addressAttributes = $user->getAddressAttributesFromOrders() @endphp

                                                    <b>Телефон: </b> {{ $user->phone_number }} {{ !empty($addressAttributes['phone']) ? ', '. $addressAttributes['phone'] : '' }} <br/>

                                                    <b>Е-поща:</b> {{ $user->email }} <br/>

                                                    <b>Област:</b> {{ $addressAttributes['district'] }} <br/>

                                                    <b>Община:</b> {{ $addressAttributes['municipality'] }} <br/>

                                                    <b>Населено място:</b> {{ $addressAttributes['city_name'] }} <br/>

                                                    <b>Адрес:</b> {{ $addressAttributes['address'] }} <br/>
                                                </p>
                                            </div>
                                            <div class="card-footer d-flex justify-content-between"
                                                 style="justify-content: center; align-items: center;">
                                                @if(!empty($addressAttributes['created_at']))
                                                    <small class="text-muted">Адрес създаден
                                                        на: {{  $addressAttributes['created_at']->format('d.m.Y') }} </small>
                                                @else
                                                    <small class="text-muted">Няма адрес</small>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page_js')
    <script>
        $(document).ready(function (e) {
            $('.js-delete-order-service').on('click', function (e) {
                var hasConfirmation = confirm('Сигурни ли сте че искате да изтриете избраната услуга?');
                if (hasConfirmation) {
                    $('body').loadingModal({
                        text: 'Зареждане...',
                        color: '#fff',
                        animation: 'wave'
                    });
                    $('body').loadingModal('show');
                    $.ajax({
                        url: $(this).data('url'),
                    }).done(function (data) {
                        location.reload();
                    });
                }
            });

            $('.js-change-status').on('click', function (event) {
                $this = $(this);
                var orderStatus = $this.data('value');
                var orderId = $this.data('order-id');
                $.ajax({
                    method: "POST",
                    url: "{{ route('admin.orders.change_status') }}",
                    data: {status: orderStatus, order_id: orderId}
                }).done(function (data) {
                    Swal.fire('Успешна промяна на статус', 'Статуса на поръчката беше променена на ' + $this.html(), 'success');
                    setTimeout(function () {
                        location.reload();
                    }, 2000)
                });
            });
        });
    </script>
@endsection
