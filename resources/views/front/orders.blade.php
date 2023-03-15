@extends('front.layout')

@section('title')
    {{ trans('Моите поръчки')}}
@endsection

@section('main')
    @include('front.components.breadcrumb')
    <div class="section">
        <div class="container">
            <div class="p-5 bg-f3">
                <h4><strong>{{trans('Моите поръчки')}}</strong></h4>
                <div class="kt-portlet">
                    <div class="kt-portlet__body">
                        <div class="kt-section">
                            <div class="kt-section__content">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead class="thead-light">
                                        <tr>
                                            <th class="text-center font-weight-bold">{{trans('ID')}}</th>
                                            <th class="text-center font-weight-bold">{{trans('Продукти от поръчката')}}</th>
                                            <th class="text-center font-weight-bold">{{trans('Дата')}}</th>
                                            <th class="text-center font-weight-bold">{{trans('Сума')}}</th>
                                            <th class="text-center font-weight-bold">{{trans('Начин на плащане')}}</th>
                                            <th class="text-center font-weight-bold">{{trans('Статус')}}</th>
                                            <th class="text-center font-weight-bold">{{trans('Преглед')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($orders as $order)
                                            <tr>
                                                <td class="text-center" style="width: 1%">
                                                    {{ $order->id }}
                                                </td>
                                                <td class="text-center">
                                                    @foreach($order->orderProducts as $orderProduct)
                                                        <a href="{{ route('product', $orderProduct->productInfo()->slug) }}">{{ $orderProduct->title }}</a>
                                                        <br/>
                                                    @endforeach
                                                </td>
                                                <td class="text-center">
                                                    {{ $order->created_at->format('d.m.Y') }}
                                                    <small>{{ $order->created_at->format('H:i') }}</small>
                                                </td>
                                                <td class="text-center">
                                                    {{ number_format($order->total, 2, '.', '') }} {{ $order->currency }}
                                                </td>
                                                <td class="text-center">
                                                    {{  $order->payment_method }}
                                                </td>
                                                <td class="text-center">
                                                    <span class="btn btn-{{ \App\Constant\OrderStatusConstant::STATUS_BOOTSTRAP_CLASS[$order->status] ?? '' }} font-weight-bold btn-pill w-100 px-3 py-0">
                                                        {{ \App\Constant\OrderStatusConstant::ORDER_STATUS_LABEL[$order->status] }}
                                                    </span>
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{ route('account.order_summary', ['id' => $order->id]) }}" class="btn btn-secondary"><i class="fa fa-eye px-3"></i></a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center">{{ trans('Няма направени поръчки') }}</td>
                                            </tr>
                                        @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
