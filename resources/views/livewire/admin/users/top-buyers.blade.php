<div>
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
        <div class="kt-portlet__body" id="filters_form">
            <div class="form-group row">
                <div class="col-lg-6">
                    <label>E-mail</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text">
                                    <i class="fa fa-search"></i>
                                </span></div>
                        <input wire:model="email" id="email" name="email" type="text"
                               class="form-control">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="kt-portlet">
        <div class="kt-portlet__body">

            <!--begin::Section-->
            <div class="kt-section">
                <div class="kt-section__content">
                    <div class="table-responsive">
                        {{ $ordersByUser->links() }}
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="thead-light">
                            <tr>
                                <th class="text-center font-weight-bold">Име</th>
                                <th wire:click="sortBy('user_email')" class="text-center font-weight-bold" style="cursor:pointer;">E-mail
                                    @if($sortField == 'user_email')
                                        @include('admin.components.sorting_arrow')
                                    @endif
                                </th>
                                <th wire:click="sortBy('orders_count')" class="text-center font-weight-bold" style="cursor:pointer;">Брой поръчки
                                    @if($sortField == 'orders_count')
                                        @include('admin.components.sorting_arrow')
                                    @endif
                                </th>
                                <th wire:click="sortBy('SUM(orders.total)')" class="text-center font-weight-bold" style="cursor:pointer;">Сума
                                    @if($sortField == 'SUM(orders.total)')
                                        @include('admin.components.sorting_arrow')
                                    @endif
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse ($ordersByUser as $orders)
                                <tr>
                                    <td class="text-center">
                                        <a href="{{ route('admin.user.summary', $users[$orders->user_email]->id) }}">
                                            {{ $users[$orders->user_email]->name.' '.$users[$orders->user_email]->lastname }}
                                        </a>
                                    </td>
                                    <td class="text-center">{{ $orders->user_email }}</td>
                                    <td class="text-center">{{ $orders->orders_count }}</td>
                                    <td class="text-center">{{ number_format($orders->orders_total_sum, 2, '.', ' ') }} лв.</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-danger">Няма резултати</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="table-responsive">
                        {{ $ordersByUser->links() }}
                    </div>
                </div>
            </div>
            <!--end::Section-->
        </div>
        <!--end::Form-->
    </div>
</div>
