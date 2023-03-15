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
                    <label>Layout регион:</label>
                    <div class="input-group">
                        <select wire:model="region_name" class="form-control">
                            <option value="">-all-</option>
                            @foreach(\App\Constant\LayoutRegionConstant::ALL as $layoutRegion)
                                <option value="{{ $layoutRegion }}">{{ $layoutRegion }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-4">
                    <label>Държава:</label>
                    <div class="input-group">
                        <select wire:model="location" class="form-control">
                            <option value=""> - всички - </option>
                            @foreach(locales() as $locale)
                                <option value="{{$locale}}">{{ country($locale) }}</option>
                            @endforeach
                        </select>
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
                        {{ $blocks->links() }}
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="thead-light">
                            <tr>
                                <th class="text-center font-weight-bold">Id</th>
                                <th class="text-center font-weight-bold">Name</th>
                                <th class="text-center font-weight-bold">Layout region</th>
                                <th class="text-center font-weight-bold">Country</th>
                                <th class="text-center font-weight-bold">Content</th>
                                <th class="text-center font-weight-bold">Weight</th>
                                <th class="text-center font-weight-bold">Enabled</th>
                                <th class="text-center font-weight-bold">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse ($blocks as $block)
                                <tr wire:key="{{ $block->id }}">
                                    <td style="width: 1%">
                                        {{ $block->id }}
                                    </td>
                                    <td class="text-center">
                                        {{ $block->name }}
                                    </td>
                                    <td class="text-center">
                                        {{ $block->region_name }}
                                    </td>
                                    <td class="text-center">
                                        @if(!empty($block->locale))
                                            <img src="{{ asset('images/flags/64x64/'.$block->locale.'.png') }}" style="width:24px;height:20px;" alt="{{ $block->locale }}" title="{{ country($block->locale) }}">
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if(!empty($block->dynamic_content))
                                            Class generator: {{ $block->dynamic_content }}
                                        @elseif(!empty($block->static_content))
                                            Static HTML
                                        @endif
                                    </td>
                                    <td style="width: 1%;">
                                        <p style="float: left;">{{ $block->weight }}</p>
                                        <button wire:click="editWeight({{ $block->id }})" style="float: right;" data-toggle="modal" data-target="#layout_block_weight"><i class="fa fa-edit text-info"></i></button>
                                    </td>
                                    <td class="text-center" style="width: 1%">
                                        <button wire:click="updateStatus({{ $block->id }})" class="btn btn-icon btn-outline-{{ $block->is_enabled ? 'success' : 'warning' }} btn-sm mr-2">
                                            <i class="{{ $block->is_enabled ? 'flaticon2-check-mark' : 'fa fa-pause' }}"></i>
                                        </button>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.layout-blocks.edit', $block->id) }}" role="button" class="btn btn-sm btn-outline-brand btn-icon">
                                            <i class="flaticon-edit"></i>
                                        </a>

                                        @if($confirming === $block->id)
                                            <button wire:click="deleteLayoutBlock({{ $block->id }})" role="button"
                                                    class="btn btn-sm btn-outline-success btn-icon">
                                                Yes
                                            </button>
                                            <button wire:click="cancelDelete()" role="button"
                                                    class="btn btn-sm btn-outline-danger btn-icon m-1">
                                                No
                                            </button>
                                        @else
                                            <button wire:click="confirmDelete({{ $block->id }})" role="button"
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
                        {{ $blocks->links() }}
                    </div>
                </div>
            </div>
            <!--end::Section-->
        </div>
    </div>
    <form wire:submit.prevent="saveWeight">
        <div wire:ignore.self class="modal fade" id="layout_block_weight" tabindex="-1" role="dialog"
             aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="layout_block_weight_title">Редактиране на тежестта на {{ $editing->name ?? '' }}</h5>
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
