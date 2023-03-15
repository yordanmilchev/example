<div id="main-characteristics" class="kt-portlet">
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title pl-0">
                <a href="{{ route('admin.blog.article.list') }}" title="Назад към списъка" class=""><i class="fas fa-arrow-left"></i></a>
            </h3>

            <h3 class="kt-portlet__head-title">
                Основни характеристики
            </h3>
        </div>
    </div>

    <div class="kt-portlet__body">
        <!--begin::Section-->
        <div class="kt-section">
            <div class="kt-section__content">
                @include('admin.components.flashes')

                    @php $translationsFieldsConfig = [
                                'title' => [
                                   'object' => $article,
                                   'label' => 'Заглавие на статията'
                                ],
                                'slug' => [
                                    'object' => $article,
                                    'label' => 'Slug',
                                    'disabled' => true,
                                    'help' => 'Автоматично генериран идентификатор за статията'
                                ],
                                'meta_description' => [
                                    'object' => $article,
                                    'label' => 'Мета описание',
                                ],
                                'is_enabled' => [
                                    'object' => $article,
                                    'label' => 'Активна статия?',
                                    'type' => 'checkbox',
                                ],
                                'excerpt' => [
                                    'object' => $article,
                                    'label' => 'Кратко описание',
                                ],
                                'body' => [
                                    'object' => $article,
                                    'label' => 'Съдържание на статията',
                                    'type' => 'rich_text_editor'
                                ]
                            ];
                    @endphp
                    {{ \TransWidget::renderFields($translationsFieldsConfig) }}

            </div>
        </div>
        <!--end::Section-->
    </div>
</div>
