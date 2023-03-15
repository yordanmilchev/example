<ol class="dd-list">
    @foreach($children as $parent)
        <li class="dd-item dd3-item" data-id="{{ $parent['id'] }}" data-weight="{{ $parent['weight'] }}">
            <div class="dd-handle dd3-handle"></div>
            <div class="dd3-content">
                <div class="flex-with-spaced">
                    {{ $parent['title'] }}
                    <div>
                        <a href="{{ route('gallery', $parent['slug']) }}" target="_blank" role="button"
                           class="btn btn-sm btn-outline-success btn-icon extra-small-btn">
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('admin.gallery.edit', ['id' => $parent['id']]) }}" role="button"
                           class="btn btn-sm btn-outline-brand btn-icon extra-small-btn">
                            <i class="flaticon-edit"></i>
                        </a>
                    </div>
                </div>
            </div>
            @if(isset($parent['children']) && count($parent['children']))
                @include('admin.gallery._sub_gallery_categories', [
                   'children' => $parent['children']
               ])
            @endif
        </li>
    @endforeach
</ol>
