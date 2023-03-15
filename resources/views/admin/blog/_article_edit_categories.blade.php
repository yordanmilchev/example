<div id="categories" class="kt-portlet">
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title pl-0">
                <a href="{{ route('admin.blog.article.list') }}" title="Назад към списъка" class=""><i class="fas fa-arrow-left"></i></a>
            </h3>

            <h3 class="kt-portlet__head-title">
                Категории
            </h3>
        </div>
    </div>

    <div class="kt-portlet__body">
        <!--begin::Section-->
        <div class="kt-section">
            <div class="kt-section__content">
                <div class="form-group row">
                    <div class="col-lg-6">
                        <label class="">Категории</label>
                        <select name="categories[]" multiple="" class="form-control select is-multiple" style="height: 300px;">
                            @foreach ($allBlogCategories as $blogCategory)
                                <option value="{{ $blogCategory->id }}" {{ old('categories[]') == $blogCategory->id ? 'selected' : ($article->hasCategoryById($blogCategory->id) ? 'selected' : '') }}>{{ $blogCategory->title }}</option>
                            @endforeach
                        </select>
                        <span class="form-text text-muted input-hint">Избор на категории към които спада артикула</span>
                        @error('categories')
                        <div id="email-error" class="error invalid-feedback" style="display: block;">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-lg-6">
                        <label for="blog_date" class="mt-20 mr-20">Създаден на :</label>
                        <div class="input-group mb-3">
                            <input type="text" id="blog_date" name="blog_date"
                                   value="{{ old('blog_date', $article->blog_date) }}"
                                   size="15" class="form-control datepicker-input @error('blog_date') is-invalid @enderror"
                                   required>
                            <div class="invalid-feedback">
                                @error('blog_date'){{ $message }}@enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
