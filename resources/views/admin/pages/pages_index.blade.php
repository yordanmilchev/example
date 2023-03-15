@extends('admin.layout')

@section('title')
    Страници
@endsection

@section('page_title')
    Страници
@endsection


@section('body_content')
<script>
    function deletePage(pageId)
    {
        var destroyURL = "{{route('admin.pages.destroy', 'page_id')}}";
        var pageTitle = $('#td_'+pageId).text();
        if(confirm('Моля, потвърди изтриването на страница: \n'+pageTitle)) {
            destroyURL = destroyURL.replace("page_id", pageId);
            $("#page_delete_form").attr('action', destroyURL);
            $("#page_delete_form").submit();
        }
    }
</script>
<form id="page_delete_form" style="display: none;" method="POST">
    @method('DELETE')
    @csrf
</form>
<div class="row">
    <div class="col-lg-12">

        @include('admin.components.flashes')

        <!--begin::Portlet-->
        <div class="kt-portlet">
            <div class="kt-portlet__body">
                <!--begin::Section-->
                <div class="kt-section">
                    <div class="kt-section__content">
                        <div class="table-responsive">
                            {{ $pages->links() }}
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="text-center font-weight-bold">ID</th>
                                        <th class="text-center font-weight-bold">Заглавие</th>
                                        <th class="text-center font-weight-bold">route_key</th>
                                        <th class="text-center font-weight-bold">Публикувана</th>
                                        <th class="text-center font-weight-bold">Преведена</th>
                                        <th class="text-center font-weight-bold">Действия</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($pages as $page)
                                    <tr>
                                        <td class="text-center" style="width: 1% !important;">
                                            {{ $page->id }}
                                        </td>
                                        <td class="text-center">
                                            <a id="td_{{ $page->id }}" href="{{ route('page', $page->slug) }}" target="_blank">{{ $page->title }}</a>
                                        </td>
                                        <td class="text-center">
                                            {{ $page->route_key }}
                                        </td>
                                        <td class="text-center">
                                            @if($page->is_enabled==1)
                                                <i class="flaticon2-accept" style="color:green"></i>
                                            @else
                                                <i class="flaticon2-cancel" style="color:brown"></i>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @foreach(locales() as $locale)
                                                @php
                                                    $translation = $page->translate($locale);
                                                    $flagUrl = asset("images/flags/64x64/$locale.png");
                                                @endphp
                                                @if(!empty($translation))
                                                    <a href="{{ route('page', $translation->slug) }}" target="_blank"><img class="flag-icon" src="{{ $flagUrl }}" alt=""></a>
                                                @endif
                                            @endforeach
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.pages.edit', $page->id) }}" role="button" class="btn btn-sm btn-outline-brand btn-icon">
                                                <i class="flaticon-edit"></i></a>
                                            <a href="javascript:deletePage({{ $page->id }});" role="button" class="btn btn-sm btn-outline-danger btn-icon">
                                                <i class="flaticon-delete"></i></a>
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
                            {{ $pages->links() }}
                        </div>
                    </div>
                </div>
                <!--end::Section-->
            </div>
        </div>
        <!--end::Portlet-->
    </div>
</div>
@endsection

@section('subheader_toolbar')
    <div class="row float-right kt-padding-r-20">
        <a class="btn btn-success" href="{{ route('admin.pages.create') }}">Създай нова страница</a>
    </div>
@endsection
