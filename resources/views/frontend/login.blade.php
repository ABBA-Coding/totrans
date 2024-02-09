@extends('frontend.layout.auth')

@section('section')
    <div class="site-wrapper">
        <section class="sec-padding registration">
            <div class="row --columns">
                <div class="col-12 col-sm-12 col-md-6 col-lg-5 col-xl-5">
                    <div class="container">
                        <div class="registration-left">
                            <a href="{{ url()->previous() }}" class="registration-left__back">
                                <img src="/frontend/images/icon/back.svg" alt="" />
                                <span>{{ __('static.Назад') }}</span>
                            </a>

                            <form action="{{ route('profile.login.post') }}" method="post" class="registration-form">
                                {{ csrf_field() }}

                                <div class="registration-form__title">{{ __('static.Авторизация') }}</div>

                                <div class="registration-form__box">
                                    <div class="registration-form__type">{{ __('static.Логин') }}</div>
                                    <input
                                        name="login"
                                        type="text"
                                        class="registration-form__input"
                                        placeholder="{{ __('static.Введите логин') }}"
                                        autocomplete="off"
                                    />
                                </div>

                                <div class="registration-form__box">
                                    <div class="registration-form__type">{{ __('static.Пароль') }}</div>
                                    <input
                                        name="password"
                                        type="text"
                                        class="registration-form__input"
                                        placeholder="{{ __('static.Введите пароль') }}"
                                        autocomplete="off"
                                    />
                                </div>

                                <div class="registration-form__inner">
                                    <div class="checkbox">
{{--                                        <label class="checkbox-label">--}}
{{--                                            <input class="checkbox-input" type="checkbox" />--}}
{{--                                            <span class="checkbox-border"></span>--}}
{{--                                            <span class="checkbox-name">{{ __('static.Запомнить меня') }}</span>--}}
{{--                                        </label>--}}
                                    </div>

{{--                                    <a href="#!" class="registration-form__password">--}}
{{--                                        {{ __('static.Забыли пароль?') }}--}}
{{--                                    </a>--}}
                                </div>

                                <button type="submit" class="btn btn-main">
                                    <span>{{ __('static.Войти') }}</span>
                                </button>

                                <div class="registration-form__link">
                                    {{ __('static.Нет аккаунта?') }} <a href="{{route('profile.sign-up')}}">{{ __('static.Зарегистрироваться') }}</a>
                                </div>
                            </form>

                            <div class="registration-left__description">
                                © 2023 TOTRANS Logistics. All Rights Reserved. Made by ABBA!
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-12 col-md-6 col-lg-7 col-xl-7">
                    @component('frontend.components.auth-right') @endcomponent
                </div>
            </div>
        </section>
    </div>
@endsection
