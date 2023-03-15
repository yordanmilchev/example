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
                <div class="col-lg-4">
                    <label>E-mail:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text">
                                            <i class="fa fa-at"></i>
                                        </span></div>
                        <input wire:model="email" type="text"
                               class="form-control">
                    </div>
                </div>
                <div class="col-lg-4">
                    <label>Име:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text">
                                            <i class="fa fa-user"></i>
                                        </span></div>
                        <input wire:model="name" type="text"
                               class="form-control">
                    </div>
                </div>
                <div class="col-lg-4">
                    <label>Телефон:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text">
                                            <i class="fa fa-phone"></i>
                                        </span></div>
                        <input wire:model="phone" type="text"
                               class="form-control">
                    </div>
                </div>
            </div>
        </div>
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
                        {{ $inquiries->links() }}
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="thead-light">
                            <tr>
                                <th class="text-center font-weight-bold">Действия</th>
                                <th wire:click="sortBy('email')" class="text-center font-weight-bold" style="cursor:pointer;">E-mail
                                    @if($sortField == 'email')
                                        @include('admin.components.sorting_arrow')
                                    @endif
                                </th>
                                <th wire:click="sortBy('name')" class="text-center font-weight-bold" style="cursor:pointer;">Име
                                    @if($sortField == 'name')
                                        @include('admin.components.sorting_arrow')
                                    @endif
                                </th>
                                <th wire:click="sortBy('phone')" class="text-center font-weight-bold" style="cursor:pointer;">Телефон
                                    @if($sortField == 'phone')
                                        @include('admin.components.sorting_arrow')
                                    @endif
                                </th>
                                <th wire:click="sortBy('inquiry')" class="text-center font-weight-bold" style="cursor:pointer;">Съобщение
                                    @if($sortField == 'inquiry')
                                        @include('admin.components.sorting_arrow')
                                    @endif
                                </th>
                                <th wire:click="sortBy('created_at')" class="text-center font-weight-bold" style="cursor:pointer;">Дата
                                    @if($sortField == 'created_at')
                                        @include('admin.components.sorting_arrow')
                                    @endif
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse ($inquiries as $message)
                                <tr wire:key="{{ $message->id }}" style="{{ $message->seen ? '' : 'font-weight: bold;' }}">
                                    <td class="text-center" style="width: 12%;">
                                        <button wire:click="messageSeen({{ $message->id }})" role="button" class="btn btn-sm btn-outline-success btn-icon">
                                            <i class="fas fa-check"></i>
                                        </button>

                                        <button wire:click="getInquiry({{ $message->id }})" role="button" class="btn btn-sm btn-outline-info btn-icon" data-toggle="modal" data-target="#view-inquiry-modal">
                                            <i class="far fa-eye"></i>
                                        </button>

                                        @if($confirming === $message->id)
                                            <button wire:click="deleteInquiry({{ $message->id }})" role="button"
                                                    class="btn btn-sm btn-outline-success btn-icon">
                                                Yes
                                            </button>
                                            <button wire:click="cancelDelete()" role="button"
                                                    class="btn btn-sm btn-outline-danger btn-icon m-1">
                                                No
                                            </button>
                                        @else
                                            <button wire:click="confirmDelete({{ $message->id }})" role="button"
                                                    class="btn btn-sm btn-outline-danger btn-icon">
                                                <i class="flaticon-delete"></i>
                                            </button>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        {{ $message->email }}
                                    </td>
                                    <td class="text-center">
                                        {{ $message->name }}
                                    </td>
                                    <td class="text-center">
                                        {{ $message->phone }}
                                    </td>
                                    <td class="text-center" style="width: 40%;">
                                        {{ Str::limit($message->inquiry, 150) }}
                                    </td>
                                    <td class="text-center">
                                        {{ $message->created_at->format('d.m.Y') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-danger">Няма резултати</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="table-responsive">
                        {{ $inquiries->links() }}
                    </div>
                </div>
            </div>
            <!--end::Section-->
        </div>
    </div>
    <!--end::Portlet-->

    <div wire:ignore.self class="modal fade" id="view-inquiry-modal" tabindex="-1" role="dialog"
         aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Преглеждане на съобщение</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div id="add-key-content" class="modal-body">
                    <div class="kt-portlet__body">
                        <div class="form-group row">
                            <div class="col-6">
                                <label>E-mail</label>
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text">
                                        <i class="fa fa-at"></i>
                                    </span></div>
                                    <input type="text" class="form-control" value="{{ $context->email ?? '' }}" disabled />
                                </div>
                            </div>
                            <div class="col-6">
                                <label>Име</label>
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text">
                                        <i class="fa fa-user"></i>
                                    </span></div>
                                    <input type="text" class="form-control" value="{{ $context->name ?? '' }}" disabled />
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-6">
                                <label>Телефон</label>
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text">
                                        <i class="fa fa-phone"></i>
                                    </span></div>
                                    <input type="text" class="form-control" value="{{ $context->phone ?? '' }}" disabled />
                                </div>
                            </div>
                            <div class="col-6">
                                <label>Дата</label>
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text">
                                        <i class="fa fa-calendar"></i>
                                    </span></div>
                                    <input value="{{ $context->created_at_humanized ?? '' }}" type="text" class="form-control" disabled />
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12">
                                <label>Съобщение</label>
                                <textarea name="label" class="form-control" style="height: 250px;" disabled >{{ $context->inquiry ?? '' }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Затваряне</button>
                </div>
            </div>
        </div>
    </div>
</div>
