<div id="main-image" class="kt-portlet">
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title pl-0">
                <a href="{{ route('admin.blog.article.list') }}" title="Назад към списъка" class=""><i class="fas fa-arrow-left"></i></a>
            </h3>

            <h3 class="kt-portlet__head-title">
                Основно изображение
            </h3>
        </div>
    </div>

    <div class="kt-portlet__body">
        <!--begin::Section-->
        <div class="kt-section">
            <div class="kt-section__content">
                <div class="form-group row">
                    <div class="col-lg-4">
                        @if(!empty($article->image))
                            <a href="{{ gallery_image($article->image, \App\Constant\GalleryFileConstant::TYPE_BLOG_IMAGE, \App\Constant\GalleryFileConstant::TYPE_COMPRESSED) }}" class="image-link">
                                <img src="{{ gallery_image($article->image, \App\Constant\GalleryFileConstant::TYPE_BLOG_IMAGE, \App\Constant\GalleryFileConstant::TYPE_COMPRESSED) }}" id="preview-on-upload"
                                     style="max-width: 100%;" class="rounded">
                            </a>
                        @else
                            <img
                                src="{{ asset('images/placeholder-image.png') }}" id="preview-on-upload"
                                style="max-width: 100%;" class="rounded">
                        @endif
                    </div>

                    <div class="col-lg-4">
                        <label for="example-text-input" class="mt-20 mr-20">Изображение:</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input onchange="readURL(this);" name="image" type="file" class="custom-file-input" id="image">
                                <label class="custom-file-label text-left" for="image">
                                    <i class="fa fa-file"></i>{{ ' '.$article->image }}
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
