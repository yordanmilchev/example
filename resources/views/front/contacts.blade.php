@extends('front.layout')

@section('title')
    {{ trans('Контакти')}}
@endsection

@section('head')
    <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit&hl={{Lang::locale()}}" async="async" defer="defer"></script>
@endsection

@section('main')
    @include('front.components.flash_messages')
    <div class="section section-contact bg-dark">
        <div class="container">
            <div class="section-head border-bottom text-center text-white">
                <p class="h2 section-title">СВЪРЖИ СЕ С НАС</p>
            </div><!-- /.section-head border-bottom text-center text-white -->

            <div class="section-body">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="form form-contact">
                            <div class="section-head border-bottom text-center">
                                <p class="h2 section-title">Пиши ни</p>
                            </div>

                            <div class="section-body">
                                <form method="POST" action="{{ route('contacts.save') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input name="name" type="text" class="form-control" placeholder="Име" value="{{ old('name') }}" required>

                                            <input name="email" type="email" class="form-control" placeholder="Email адрес" value="{{ old('email') }}" required>

                                            <input name="phone" type="tel" class="form-control"  pattern="^[0]\d{9,9}$" placeholder="Телефон" value="{{ old('phone') }}" required>
                                        </div><!-- /.col-md-6 -->

                                        <div class="col-md-6">
                                            <textarea name="inquiry" class="form-control" id="exampleFormControlTextarea1" rows="3" required>{{ old('inquiry') }}</textarea>
                                        </div><!-- /.col-md-6 -->
                                    </div><!-- /.row -->

                                    <div class="pt-3 text-center">
                                        <div class="captcha mb-2">
                                            <div class="g-recaptcha" data-sitekey="{{env('G_CAPTCHA_SITE_KEY')}}" data-theme="light" data-type="image" id="g_recaptcha" style="display: inline-block;"></div>
                                            @error('g-recaptcha-response')
                                            <span class="invalid-feedback text-danger d-block" role="alert">
                                                    {{trans('Антибот проверката е задължителна!')}}
                                                </span>
                                            @enderror
                                        </div>

                                        <button type="submit" class="btn btn-primary box-shadow">Изпрати съобщение</button>
                                    </div><!-- /.section-bottom -->
                                </form>
                            </div><!-- /.section-body -->
                        </div><!-- /.form form-contact -->
                    </div><!-- /.col-lg-8 -->

                    <div class="col-lg-4">
                        <div class="card card-info">
                            <div class="card-head">
                                <div>
                                    <div class="card-title">
                                        <h5>Малев Инженеринг ВТ ООД</h5>
                                    </div>

                                    <div class="card-text">
                                        <p>гр. Велико Търново</p>
                                    </div>
                                </div>

                                <a href="#" target="_blank"><i class="fab fa-facebook-square"></i></a>
                            </div>

                            <div class="card-body">
                                <div class="card-info-inner">
                                    <i class="far fa-phone"></i>

                                    <div>
                                        <a href="tel:062602050" class="meta">062 60 20 50</a>

                                        <a href="tel:0878243447" class="meta">0878 243 447</a>
                                    </div>
                                </div><!-- /.card-info-inner -->

                                <div class="card-info-inner">
                                    <i class="far fa-envelope"></i>

                                    <div>
                                        <a href="mailto:gercho@malev-bg.com" class="meta">gercho@malev-bg.com</a>

                                        <a href="mailto:magazin@malev-bg.com" class="meta">magazin@malev-bg.com</a>
                                    </div>
                                </div><!-- /.card-info-inner -->

                                <div class="card-info-inner">
                                    <i class="far fa-map-marker-alt"></i>

                                    <div>
                                        <p class="meta mb-0">Велико Търново</p>

                                        <a href="https://goo.gl/maps/D44ycL7PbYpaaq4x6" class="meta" target="_blank">ул.
                                            Момина Крепост 22</a>
                                    </div>
                                </div><!-- /.card-info-inner -->
                            </div><!-- /.card-body -->
                        </div><!-- /.card card-info -->
                    </div><!-- /.col-lg-4 -->
                </div> <!-- /.row -->
            </div><!-- /.section-body -->
        </div><!-- /.container -->

        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2914.424845152914!2d25.6190077!3d43.0745628!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40a9260d32238bb3%3A0x8359c2df4b7b29e1!2sul.%20%22Momina%20krepost%22%2022%2C%205002%20Rayon%20Zapaden%2C%20Veliko%20Tarnovo!5e0!3m2!1sen!2sbg!4v1677152451169!5m2!1sen!2sbg"
                width="" height="" style="border:0;" allowfullscreen="" loading="lazy" class="map"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div><!-- /.section section-contact bg-danger -->

@endsection

@section('page_js')
    <script type="text/javascript">
        var onloadCallback = function() {
            grecaptcha.render('g_recaptcha', {
                'sitekey' : '{{env('G_CAPTCHA_SITE_KEY')}}'
            });
        };
    </script>
@endsection
