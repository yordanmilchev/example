<ul class="tabs--primary nav nav-tabs">
    <li @if(\Request::route()->getName()=="register") class="active" @endif><a href="{{ route('register') }}">{{trans('Регистрация')}}</a></li>
    <li @if(\Request::route()->getName()=="login") class="active" @endif><a href="{{ route('login') }}" class="active">{{trans('Вход')}}</a></li>
    <li @if(\Request::route()->getName()=="password.request" || \Request::route()->getName()=="password.reset") class="active" @endif><a href="{{ route('password.request') }}">{{trans('Забравена парола')}}</a></li>
</ul>