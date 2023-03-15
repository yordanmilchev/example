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
                    <label>Наименование:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text">
                                            <i class="fa fa-tags"></i>
                                        </span></div>
                        <input wire:model="title" type="text"
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
                        {{ $articles->links() }}
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
                                <th wire:click="sortBy('title')" class="text-center font-weight-bold" style="cursor:pointer;">Заглавие
                                    @if($sortField == 'title')
                                        @include('admin.components.sorting_arrow')
                                    @endif
                                </th>
                                <th wire:click="sortBy('excerpt')" class="text-center font-weight-bold" style="cursor:pointer;">Кратко описание
                                    @if($sortField == 'excerpt')
                                        @include('admin.components.sorting_arrow')
                                    @endif
                                </th>
                                <th wire:click="sortBy('is_enabled')" class="text-center font-weight-bold" style="cursor:pointer;">Публикувана
                                    @if($sortField == 'is_enabled')
                                        @include('admin.components.sorting_arrow')
                                    @endif
                                </th>
                                <th wire:click="sortBy('blog_date')" class="text-center font-weight-bold" style="cursor:pointer;">Създадена на
                                    @if($sortField == 'blog_date')
                                        @include('admin.components.sorting_arrow')
                                    @endif
                                </th>
                                <th class="text-center font-weight-bold">Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse ($articles as $article)
                                <tr wire:key="{{ $article->id }}">
                                    <td class="text-center" style="width: 1% !important;">{{ $article->id }}</td>
                                    <td class="text-center" style="width: 250px;">
                                        @if(!empty($article->image))
                                            <img src="{{ gallery_image($article->image, \App\Constant\GalleryFileConstant::TYPE_BLOG_IMAGE, \App\Constant\GalleryFileConstant::TYPE_COMPRESSED) }}"
                                                 style="max-width: 200px;" class="rounded">
                                        @else
                                            няма изображение
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        {{ $article->title }}
                                    </td>
                                    <td class="text-center">
                                        {{ Str::limit($article->excerpt, 150) }}
                                    </td>
                                    <td class="text-center" style="width: 1%">
                                        <i class="{{ $article->is_enabled ? 'flaticon2-accept' : 'flaticon2-cancel' }}" style="color:{{ $article->is_enabled ? 'green' : 'brown' }}"></i>
                                    </td>
                                    <td class="text-center">
                                        {{ \Carbon\Carbon::parse($article->blog_date)->format('d.m.Y') }}
                                    </td>
                                    <td class="text-center" style="width: 8%;">
                                        <a href="{{ route('admin.blog.article.edit', ['id' => $article]) }}"
                                           role="button" class="btn btn-sm btn-outline-brand btn-icon"><i
                                                class="flaticon-edit"></i></a>

                                        <a href="{{ route('blog.article', $article->slug) }}" role="button"
                                           class="btn btn-sm btn-outline-brand btn-icon" target="_blank"><i
                                                class="flaticon-eye"></i></a>
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
                        {{ $articles->links() }}
                    </div>
                </div>
            </div>
            <!--end::Section-->
        </div>
        <!--end::Form-->
    </div>
</div>
