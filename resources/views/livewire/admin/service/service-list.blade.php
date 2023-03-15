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
                    <label>Заглавие:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text">
                            <i class="fa fa-tags"></i>
                        </span></div>
                        <input wire:model="title" type="text" class="form-control">
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
                        {{ $services->links() }}
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="thead-light">
                            <tr>
                                <th class="text-center font-weight-bold">ID</th>
                                <th class="text-center font-weight-bold">Изображение</th>
                                <th class="text-center font-weight-bold">Заглавие</th>
                                <th class="text-center font-weight-bold">Описание</th>
                                <th class="text-center font-weight-bold">Тежест</th>
                                <th class="text-center font-weight-bold">Активна</th>
                                <th class="text-center font-weight-bold">Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse ($services as $service)
                                <tr wire:key="{{ $service->id }}">
                                    <td style="width: 1%">
                                        {{ $service->id }}
                                    </td>
                                    <td class="text-center" style="width: 250px;">
                                        @if(!empty($service->image))
                                            <img src="{{ gallery_image($service->image, \App\Constant\GalleryFileConstant::TYPE_SERVICE_IMAGE, \App\Constant\GalleryFileConstant::TYPE_COMPRESSED) }}"
                                                 style="max-width: 200px;" class="rounded">
                                        @else
                                            няма изображение
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        {{ $service->title }}
                                    </td>
                                    <td class="text-center">
                                        {!! \Str::limit($service->excerpt, 50) !!}
                                    </td>
                                    <td class="text-center">
                                        {{ $service->weight }}
                                    </td>
                                    <td class="text-center" style="width: 1%">
                                        <button wire:click="updateStatus({{ $service->id }})" class="btn btn-icon btn-outline-{{ $service->is_enabled ? 'success' : 'warning' }} btn-sm mr-2">
                                            <i class="{{ $service->is_enabled ? 'flaticon2-check-mark' : 'fa fa-pause' }}"></i>
                                        </button>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.service.edit', ['id' => $service->id]) }}" role="button" class="btn btn-sm btn-outline-brand btn-icon">
                                            <i class="flaticon-edit"></i>
                                        </a>

                                        @if($confirming === $service->id)
                                            <button wire:click="deleteService({{ $service->id }})" role="button"
                                                    class="btn btn-sm btn-outline-success btn-icon">
                                                Yes
                                            </button>
                                            <button wire:click="cancelDelete()" role="button"
                                                    class="btn btn-sm btn-outline-danger btn-icon m-1">
                                                No
                                            </button>
                                        @else
                                            <button wire:click="confirmDelete({{ $service->id }})" role="button"
                                                    class="btn btn-sm btn-outline-danger btn-icon">
                                                <i class="flaticon-delete"></i>
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center text-danger">Няма резултати.</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="table-responsive">
                        {{ $services->links() }}
                    </div>
                </div>
            </div>
            <!--end::Section-->
        </div>
    </div>
</div>
