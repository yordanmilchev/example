<div>
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
                    <label>Линк:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-tags"></i>
                            </span>
                        </div>
                        <input wire:model="link" type="text"
                               class="form-control">
                    </div>
                </div>
            </div>
        </div>
        <!--end::Form-->
    </div>
    <!--end::Portlet-->

    <div class="kt-portlet">
        <div class="kt-portlet__body">
            <!--begin::Section-->
            <div class="kt-section">
                <div class="kt-section__content">
                    <div class="table-responsive">
                        {{ $sliders->links() }}
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="thead-light">
                            <tr>
                                <th wire:click="sortBy('id')" class="text-center font-weight-bold" style="cursor:pointer;">ID
                                    @if($sortField == 'id')
                                        @include('admin.components.sorting_arrow')
                                    @endif
                                </th>
                                <th class="text-center font-weight-bold">Изображение</th>
                                <th wire:click="sortBy('link')" class="text-center font-weight-bold" style="cursor:pointer;">Линк
                                    @if($sortField == 'link')
                                        @include('admin.components.sorting_arrow')
                                    @endif
                                </th>
                                <th wire:click="sortBy('weight')" class="text-center font-weight-bold" style="cursor:pointer;">Тежест
                                    @if($sortField == 'weight')
                                        @include('admin.components.sorting_arrow')
                                    @endif
                                </th>
                                <th wire:click="sortBy('is_enabled')" class="text-center font-weight-bold" style="cursor:pointer;">Публикувана
                                    @if($sortField == 'is_enabled')
                                        @include('admin.components.sorting_arrow')
                                    @endif
                                </th>
                                <th wire:click="sortBy('created_at')" class="text-center font-weight-bold" style="cursor:pointer;">Създадена на
                                    @if($sortField == 'created_at')
                                        @include('admin.components.sorting_arrow')
                                    @endif
                                </th>
                                <th class="text-center font-weight-bold">Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse ($sliders as $slider)
                                <tr wire:key="{{ $slider->id }}">
                                    <td class="text-center" style="width: 1% !important;">{{ $slider->id }}</td>
                                    <td class="text-center" style="width: 250px;">
                                        @if(!empty($slider->image))
                                            <img src="{{ gallery_image($slider->image, \App\Constant\GalleryFileConstant::TYPE_SLIDER_IMAGE, \App\Constant\GalleryFileConstant::TYPE_COMPRESSED) }}"
                                                 style="max-width: 200px;" class="rounded">
                                        @elseif(!empty($slider->mobile_image))
                                            <img src="{{ gallery_image($slider->mobile_image, \App\Constant\GalleryFileConstant::TYPE_SLIDER_IMAGE, \App\Constant\GalleryFileConstant::TYPE_COMPRESSED) }}"
                                                 style="max-width: 200px;" class="rounded">
                                        @else
                                            няма изображение
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ $slider->link }}">{{ $slider->link }}</a>
                                    </td>
                                    <td class="text-center" style="width: 1%;">
                                        <p style="float: left;">{{ $slider->weight }}</p>
                                        <button wire:click="editWeight({{ $slider->id }})" style="float: right;" data-toggle="modal" data-target="#slider_weight"><i class="fa fa-edit text-info"></i></button>
                                    </td>
                                    <td class="text-center" style="width: 1%">
                                        <button wire:click="updateStatus({{ $slider->id }})" class="btn btn-icon btn-outline-{{ $slider->is_enabled ? 'success' : 'warning' }} btn-sm mr-2">
                                            <i class="{{ $slider->is_enabled ? 'flaticon2-check-mark' : 'fa fa-pause' }}"></i>
                                        </button>
                                    </td>
                                    <td class="text-center">
                                        {{ \Carbon\Carbon::parse($slider->created_at)->format('d.m.Y') }}
                                    </td>
                                    <td class="text-center" style="width: 8%;">
                                        <a href="{{ route('admin.homepage.slider.edit', ['id' => $slider]) }}"
                                           role="button" class="btn btn-sm btn-outline-brand btn-icon"><i
                                                class="flaticon-edit"></i></a>
                                        @if($confirming === $slider->id)
                                            <button wire:click="deleteSlider({{ $slider->id }})" role="button"
                                                    class="btn btn-sm btn-outline-success btn-icon">
                                                Yes
                                            </button>
                                            <button wire:click="cancelDelete()" role="button"
                                                    class="btn btn-sm btn-outline-danger btn-icon m-1">
                                                No
                                            </button>
                                        @else
                                            <button wire:click="confirmDelete({{ $slider->id }})" role="button"
                                                    class="btn btn-sm btn-outline-danger btn-icon">
                                                <i class="flaticon-delete"></i>
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center text-danger">Няма резултати</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="table-responsive">
                        {{ $sliders->links() }}
                    </div>
                </div>
            </div>
            <!--end::Section-->
        </div>
        <!--end::Form-->
    </div>
    <form wire:submit.prevent="saveWeight">
        <div wire:ignore.self class="modal fade" id="slider_weight" tabindex="-1" role="dialog"
             aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="slider_weight_title">Редактиране на тежестта на {{ $editing->title ?? '' }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="kt-portlet__body">
                            @include('admin.components.flashes')
                            <div class="form-group row">
                                <label for="editing.name" class="col-2 col-form-label">Тежест</label>
                                <div class="col-10">
                                    <input wire:model.defer="editing.weight" type="number" value="" class="form-control" />
                                    @error('editing.weight')
                                    <div id="email-error" class="error invalid-feedback" style="display: block;">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-outline-success">Запазване</button>
                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Затваряне</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
