<ul class="navbar-nav mr-auto ml-md-3">
    @foreach ($categoriesTree as $navMenuItem)
        <li class="nav-item dropdown">
            <a class="dropdown-item" href="{{ route('products', $navMenuItem['slug']) }}" id="navbarDropdown">
                <b>{{ $navMenuItem['name'] }}</b>
            </a>

            <div class="nav-item dropdown" aria-labelledby="navbarDropdown">

                @if(isset($navMenuItem['children']) && count($navMenuItem['children']))
                    @foreach($navMenuItem['children'] as $parent)
                        <a class="dropdown-item" href="{{ route('products', $parent['slug']) }}">
                            {{ $parent['name'] }}
                        </a>
                    @endforeach
                @endif
            </div>
        </li>
    @endforeach
</ul>
