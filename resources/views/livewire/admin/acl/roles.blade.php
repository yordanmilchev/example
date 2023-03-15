<div>
    <div class="kt-portlet">
        <div class="kt-portlet__body">
            <!--begin::Section-->
            <div class="kt-section">
                <div class="row float-right kt-padding-l-20 kt-padding-r-20 kt-padding-b-20">
                    <button wire:click="createRole" data-toggle="modal" data-target="#create_role_modal" class="btn btn-success">Добави роля</button>
                </div>
                @include('admin.components.flashes')
                <div class="kt-section__content">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead class="thead-light">
                            <tr>
                                <th wire:click="sortBy('id')" class="text-center font-weight-bold" style="cursor:pointer;">ID
                                    @if($sortField == 'id')
                                        @include('admin.components.sorting_arrow')
                                    @endif
                                </th>
                                <th wire:click="sortBy('name')" class="text-center font-weight-bold" style="cursor:pointer;">Име
                                    @if($sortField == 'name')
                                        @include('admin.components.sorting_arrow')
                                    @endif
                                </th>
                                <th wire:click="sortBy('label')" class="text-center font-weight-bold" style="cursor:pointer;">Описание
                                    @if($sortField == 'label')
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
                            @forelse ($roles as $role)
                                <tr wire:key="{{ $role->id }}">
                                    <td class="text-center" style="width: 1% !important;">
                                        <b>{{ $role->id }}</b>
                                    </td>
                                    <td class="text-center">{{ $role->name }}</td>
                                    <td>{{ $role->label }}</td>
                                    <td class="text-center">{{ $role->created_at ? $role->created_at->format('d.m.Y') : '' }}</td>
                                    <td class="text-center">
                                        <button wire:click="editPermissions({{ $role->id }})" type="button" data-toggle="modal" data-target="#permission_edit_modal" title="Редакция на права за ролята"
                                                class="btn btn-sm btn-outline-brand btn-icon">
                                            <i class="flaticon-customer"></i>
                                        </button>
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
            <!--end::Section-->
        </div>
        <!--end::Form-->
    </div>

    <form wire:submit.prevent="savePermissions">
        <div wire:ignore.self class="modal fade" id="permission_edit_modal" tabindex="-1" role="dialog"
             aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-scrollable modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="permission_edit_modal_title">Редактиране на права за роля <span class="kt-font-danger">{{ $editing->name ?? '' }}</span></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="kt-portlet__body">
                            @include('admin.components.flashes')
                            <div class="form-group">
                                <div class="kt-checkbox-list">
                                    @foreach(\App\Models\ACL\Permission::all() as $permission)
                                        <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                                            <input wire:model.lazy="permissions" type="checkbox" value="{{ $permission->id }}"> {{ $permission->name }} <i class="kt-font-info" style="position:unset !important;"><small>// {{ $permission->label }}</small></i>
                                            <span></span>
                                        </label>
                                    @endforeach
                                </div>
                                @error('permissions')
                                    <div class="error invalid-feedback" style="display: block;">{{ $message }}</div>
                                @enderror
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

    <form wire:submit.prevent="saveRole">
        <div wire:ignore.self class="modal fade" id="create_role_modal" tabindex="-1" role="dialog"
             aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-scrollable modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="create_role_modal_title">Създаване на роля {{ $creating->name ?? '' }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="kt-portlet__body">
                            @include('admin.components.flashes')
                            <div class="form-group row">
                                <label for="example-text-input" class="col-2 col-form-label">Наименование</label>
                                <div class="col-10">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="flaticon-customer"></i>
                                        </span>
                                        </div>
                                        <input wire:model.lazy="creating.name" type="text" class="form-control" />
                                    </div>

                                    @error('creating.name')
                                        <div id="email-error" class="error invalid-feedback" style="display: block;">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-text-input" class="col-2 col-form-label">Описание</label>
                                <div class="col-10">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="flaticon-edit-1"></i>
                                        </span>
                                        </div>
                                        <textarea wire:model.lazy="creating.label" class="form-control"></textarea>
                                    </div>

                                    @error('creating.label')
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
