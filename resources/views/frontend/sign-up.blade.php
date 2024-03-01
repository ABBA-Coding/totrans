@extends('frontend.layout.auth')

@section('section')
    <div class="site-wrapper">
        <section class="sec-padding registration">
            <div class="row --columns">
                <div class="col-12 col-sm-12 col-md-6 col-lg-5 col-xl-5">
                    <div class="container">
                        <div class="registration-left">
                            <a href="{{ route('profile.login') }}" class="registration-left__back">
                                <img src="/frontend/images/icon/back.svg" alt="" />
                                <span>{{ __('static.Назад') }}</span>
                            </a>

                            <form action="{{ route('profile.sign-up.secondary') }}" method="get" class="registration-form">

                                <div class="registration-form__title">{{ __('static.Регистрация') }}</div>

                                <div class="registration-form__box">
                                    <div class="registration-form__type">{{ __('static.Имя') }}<span>*</span></div>
                                    <input
                                        name="name"
                                        type="text"
                                        class="registration-form__input"
                                        placeholder="{{ __('static.Введите ваше имя') }}"
                                        autocomplete="off"
                                        required
                                    />
                                </div>

                                <div class="registration-form__box">
                                    <div class="registration-form__type">{{ __('static.Пароль') }}<span>*</span></div>
                                    <input
                                        name="password"
                                        type="password"
                                        class="registration-form__input"
                                        placeholder="{{ __('static.Введите пароль') }}"
                                        autocomplete="off"
                                        required
                                    />
                                </div>

                                <div class="registration-form__box">
                                    <div class="registration-form__type">{{ __('static.Телефон') }}<span>*</span></div>
                                    <input
                                        name="phone"
                                        type="text"
                                        class="registration-form__input"
                                        placeholder="{{ __('static.Введите номер телефона') }}"
                                        autocomplete="off"
                                        data-field-type="phone"
                                        required
                                    />
                                </div>

                                <div class="registration-form__box">
                                    <div class="registration-form__type">{{ __('static.E-mail') }}<span>*</span></div>
                                    <input
                                        name="email"
                                        type="email"
                                        class="registration-form__input"
                                        placeholder="{{ __('static.Введите email') }}"
                                        autocomplete="off"
                                        required
                                    />
                                </div>

                                <div class="registration-form__box mb-30">
                                    <div class="registration-form__type">{{ __('static.Компания') }}<span>*</span></div>
                                    <input
                                        name="company_name"
                                        type="text"
                                        class="registration-form__input"
                                        placeholder="{{ __('static.Введите название компании') }}"
                                        autocomplete="off"
                                        required
                                    />
                                </div>

                                <button type="submit" class="btn btn-main">
                                    <span>{{ __('static.Далее') }}</span>
                                </button>
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
