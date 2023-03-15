<div id="categories" class="kt-portlet">
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title pl-0">
                <a href="{{ route('admin.blog.article.list') }}" title="Назад към списъка" class=""><i class="fas fa-arrow-left"></i></a>
            </h3>

            <h3 class="kt-portlet__head-title">
                История на редакцията
            </h3>
        </div>
    </div>

    <div class="kt-portlet__body">
        <!--begin::Section-->
        <div class="kt-section">
            <div class="kt-section__content">
                <div class="form-group row">
                    <div class="col-lg-6">
                        <label class="">Потребители редактирали статията</label>
                        <div class="table-responsive" style="height: 200px;">
                            <table class="table table-bordered table-striped">
                                <thead class="thead-light">
                                <tr>
                                    <th class="text-center font-weight-bold">Потребител</th>
                                    <th class="text-center font-weight-bold">Дата</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($article->edited))
                                    @php
                                        $editLog = $article->edited->reverse()
                                    @endphp
                                    @foreach($editLog as $edit)
                                        <tr class="text-center">
                                            <td class="text-center">
                                                {{ $edit->user->email }}
                                            </td>
                                            <td class="text-center">
                                                {{ $edit->created_at->format('d.m.Y') . 'г. '.$edit->created_at->format('H:i')}}
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="2" class="text-center text-danger">Няма резултати</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
