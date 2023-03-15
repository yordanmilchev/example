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
                    <label>Име:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text">
                                <i class="flaticon-users"></i>
                            </span></div>
                        <input wire:model="name" name="name" type="text"
                               class="form-control" aria-describedby="basic-addon1">

                    </div>
                </div>
                <div class="col-lg-4">
                    <label>Фамилия:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text">
                                <i class="flaticon-users"></i>
                            </span></div>
                        <input wire:model="lastname" id="lastname" name="lastname" aria-describedby="basic-addon1"
                               type="text" class="form-control">
                    </div>
                </div>
                <div class="col-lg-4">
                    <label>Имейл:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text">@</span>
                        </div>
                        <input wire:model="email" id="email" name="email"
                               type="text" class="form-control">
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>User ID:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text">
                            <i class="fa fa-tags"></i>
                        </span></div>
                        <input wire:model="user_id" id="user_id" name="user_id"
                               type="text" class="form-control">
                    </div>
                </div>
                <div class="col-lg-4">
                    <label>Роля</label>
                    <div class="input-group">
                        <select wire:model="role_id" class="form-control">
                            <option value=""> - Избор на роля - </option>
                            @foreach ($rolesList as $role)
                                <option value="{{ $role->id }}">{{ $role->name }} - {{ $role->label }}</option>
                            @endforeach
                        </select>
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
                @include('admin.components.flashes')
                <div class="kt-section__content">
                    <div class="table-responsive">
                        {{ $users->links() }}
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
                                <th wire:click="sortBy('name')" class="text-center font-weight-bold" style="cursor:pointer;">Име
                                    @if($sortField == 'name')
                                        @include('admin.components.sorting_arrow')
                                    @endif
                                </th>
                                <th wire:click="sortBy('lastname')" class="text-center font-weight-bold" style="cursor:pointer;">Фамилия
                                    @if($sortField == 'lastname')
                                        @include('admin.components.sorting_arrow')
                                    @endif
                                </th>
                                <th wire:click="sortBy('email')" class="text-center font-weight-bold" style="cursor:pointer;">E-mail
                                    @if($sortField == 'email')
                                        @include('admin.components.sorting_arrow')
                                    @endif
                                </th>
                                <th wire:click="sortBy('phone_number')" class="text-center font-weight-bold" style="cursor:pointer;">Тел номер
                                    @if($sortField == 'phone_number')
                                        @include('admin.components.sorting_arrow')
                                    @endif
                                </th>
                                <th wire:click="sortBy('created_at')" class="text-center font-weight-bold" style="cursor:pointer;">Създаден на
                                    @if($sortField == 'created_at')
                                        @include('admin.components.sorting_arrow')
                                    @endif
                                </th>
                                <th class="text-center font-weight-bold">Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($users as $user)
                                <tr wire:key="{{ $user->id }}">
                                    <td class="text-center">
                                        {{ $user->id }}
                                    </td>
                                    <td class="text-center">
                                        <a href="{{route('admin.user.summary', ['user' => $user->id])}}">{{ $user->name }}</a>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{route('admin.user.summary', ['user' => $user->id])}}">{{ $user->lastname }}</a>
                                    </td>
                                    <td class="text-center">
                                        {{ $user->email }}
                                    </td>
                                    <td class="text-center">
                                        {{ $user->phone_number }}
                                    </td>
                                    <td class="text-center">
                                        {{ Carbon\Carbon::parse($user->created_at)->format('d.m.Y') }}
                                    </td>
                                    <td class="text-center">
                                        @can('manage_acl')
                                            <button wire:click="editRole({{ $user->id }})"
                                               title="Редакция на роли"
                                               class="btn btn-sm btn-outline-brand btn-icon" data-toggle="modal" data-target="#user_edit_role_modal">
                                                <i class="flaticon-customer"></i>
                                            </button>
                                        @endcan

                                        @can('view_orders')
                                            <a href="{{ route('admin.user.summary', ['user' => $user->id])}}"
                                               title="История на поръчките"
                                               class="btn btn-sm btn-clean btn-icon btn-icon-md">
                                                <i class="flaticon-time-1"></i>
                                            </a>
                                        @endcan

                                        @can('manage_users')
                                            <button wire:click="edit({{ $user->id }})" role="button" data-toggle="modal" data-target="#user_edit_modal"
                                                    class="btn btn-sm btn-outline-brand btn-icon"><i
                                                    class="flaticon-edit"></i>
                                            </button>

                                            <a href="{{ route('admin.user.list-edit', ['id' => $user->id]) }}"
                                               title="Редакция на клиент" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                                                <i class="flaticon-edit"></i>
                                            </a>
                                        @endcan
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
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
            <!--end::Section-->
        </div>
        <!--end::Form-->
    </div>

    <form wire:submit.prevent="save">
        <div wire:ignore.self class="modal fade" id="user_edit_modal" tabindex="-1" role="dialog"
             aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="user_edit_modal_title">Редактиране на потребител</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="kt-portlet__body">
                            @include('admin.components.flashes')
                            <div class="form-group row">
                                <label for="editing.name" class="col-2 col-form-label">Име</label>
                                <div class="col-10">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="flaticon-users"></i>
                                            </span>
                                        </div>
                                        <input wire:model.defer="editing.name" id="editing.name" type="text" value="" class="form-control" />
                                    </div>
                                    @error('editing.name')
                                    <div id="email-error" class="error invalid-feedback" style="display: block;">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="editing.lastname" class="col-2 col-form-label">Фамилия</label>
                                <div class="col-10">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="flaticon-users"></i>
                                            </span>
                                        </div>
                                        <input wire:model.defer="editing.lastname" id="editing.lastname" type="text" value="" class="form-control" />
                                    </div>
                                    @error('editing.lastname')
                                    <div id="email-error" class="error invalid-feedback" style="display: block;">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="editing.email" class="col-2 col-form-label">Имейл</label>
                                <div class="col-10">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                @
                                            </span>
                                        </div>
                                        <input wire:model.defer="editing.email" id="editing.email" type="text" value="" class="form-control" />
                                    </div>
                                    @error('editing.email')
                                    <div id="email-error" class="error invalid-feedback" style="display: block;">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="editing.phone_number" class="col-2 col-form-label">Телефон</label>
                                <div class="col-10">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fa fa-phone-alt" style="color: green;"></i>
                                            </span>
                                        </div>
                                        <input wire:model.defer="editing.phone_number" id="editing.phone_number" placeholder="Не е задължително" type="text" value="" class="form-control" />
                                    </div>
                                    @error('editing.phone_number')
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

    <form wire:submit.prevent="saveRole">
        <div wire:ignore.self class="modal fade" id="user_edit_role_modal" tabindex="-1" role="dialog"
             aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="user_edit_role_modal_title">Редактиране на роли за потребител {{ $editing->name ?? '' }} {{ $editing->lastname ?? '' }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="kt-portlet__body">
                            @include('admin.components.flashes')
                            <div class="form-group">
                                <h5>Избор на роли</h5>
                                <div class="kt-checkbox-list">
                                    @foreach($allRoles as $role)
                                        <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                                            <input wire:model.defer="roles" type="checkbox" value="{{ $role->id }}"> {{ $role->name }}
                                            <span></span>
                                        </label>
                                    @endforeach
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
