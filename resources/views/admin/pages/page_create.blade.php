@extends('admin.layout')

@section('title')
    Създаване на нова страница
@endsection

@section('page_title')
    Създаване на нова страница
@endsection

@section('body_content')

    <div class="row">
        <div class="col-12">

            <!--begin::Portlet-->
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title pl-0">
                            <a href="{{ route('admin.pages.index') }}" title="Назад към списъка" class=""><i class="fas fa-arrow-left"></i></a>
                        </h3>

                        <h3 class="kt-portlet__head-title">
                            Нова страница
                        </h3>
                    </div>
                </div>

                <!--begin::Form-->
                <form class="kt-form" action="{{route('admin.pages.store')}}" method="POST">
                    @csrf
                    <div class="kt-portlet__body">
                        <div class="form-group form-group-last">
                            <div class="alert alert-secondary" role="alert">
                                <div class="alert-icon"><i class="flaticon-warning kt-font-brand"></i></div>
                                <div class="alert-text">
                                    Ще бъде създадена празна, неактивна страница, на която трябва да се попълни съдържание и
                                    да се добави линк към нея в source кода на сайта, за да бъде достъпна.
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12 col-md-8 col-lg-6">
                                <label>Заглавие на български език*</label>
                                <input name="title" type="text" class="form-control" required>
                                <span class="form-text text-muted">Например: "За фирмата", "Общи условия". След създаването може да се превежда.</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12 col-md-6 col-lg-4">
                                <label>Route key* <a href="#" role="button" class="btn btn-sm btn-outline-brand btn-icon js-add-key"><i
                                            class="flaticon-web"></i></a></label>
                                <select name="route_key" class="form-control" id="select_route_key">
                                    <option value=""></option>
                                    @forelse($routeKeys as $routeKey)
                                        <option value="{{$routeKey->route_key}}">{{$routeKey->route_key}}</option>
                                    @empty
                                        <option value="">Няма записи, моля добавете</option>
                                    @endforelse
                                </select>
                                <span class="form-text text-muted">Това са ключове за линкове, които ще сочат към страницата, за която бъдат избрани. Всеки ключ може да се избере само за една страница.
                                Ако искате да добавите ключ, моля направете го с бутона.</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12 col-md-6 col-lg-4">
                                <label for="dynamicContentSelect">Избор на темплейт</label>
                                <select name="template" class="form-control" id="dynamicContentSelect">
                                    @foreach(\App\Constant\PageConstant::templateList() as $template)
                                    <option value="{{$template}}">{{$template}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="kt-portlet__foot">
                        <div class="kt-form__actions">
                            <button type="submit" class="btn btn-success">Създаване</button>
                        </div>
                    </div>
                </form>

                <!--end::Form-->
            </div>

            <!--end::Portlet-->

            <!--begin::Portlet-->

        </div>
    </div>

    @include('admin.pages._route_key_modal_prototype')
@endsection

@section('page_js')
    <script>
        $(document).ready(function(e) {

            $('#add-key-btn').on('click', function (e) {
                $.ajax({
                    type: 'POST',
                    url: '{{ route('admin.add_key') }}',
                    data: $('#add-key-form').serialize(),
                }).done(function (data) {
                    $('#add-key-modal').modal('hide');
                    $('#select_route_key').append($('<option>',
                        {
                            value: data.route_key,
                            text : data.route_key
                        }));
                    Swal.fire('Успех','Route_key беше добавен успешно', 'success');
                });
            });


            $('.js-add-key').on('click', function (e) {
                $('#route_key_content').val('');
                $('#add-key-modal').modal('show');
            })
        });
    </script>
@endsection
