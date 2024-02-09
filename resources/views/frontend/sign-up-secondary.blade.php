@extends('frontend.layout.auth')

@section('section')
    <div class="site-wrapper">
        <section class="sec-padding registration">
            <div class="row --columns">
                <div class="col-12 col-sm-12 col-md-6 col-lg-5 col-xl-5">
                    <div class="container">
                        <div class="registration-left">
                            <a href="{{ route('profile.sign-up') }}" class="registration-left__back">
                                <img src="/frontend/images/icon/back.svg" alt="" />
                                <span>{{ __('static.Назад') }}</span>
                            </a>

                            <form action="{{ route('profile.sign-up.post') }}" method="post" class="registration-form">
                                {{ csrf_field() }}

                                <input type="hidden" name="name" value="{{ request()->get('name') }}">
                                <input type="hidden" name="email" value="{{ request()->get('email') }}">
                                <input type="hidden" name="phone" value="{{ request()->get('phone') }}">
                                <input type="hidden" name="password" value="{{ request()->get('password') }}">
                                <input type="hidden" name="company_name" value="{{ request()->get('company_name') }}">

                                <div class="registration-form__title">{{ __('static.Регистрация') }}</div>

                                <div class="registration-form__box">
                                    <div class="registration-form__type">{{ __('static.Выберите сферу деятельности') }}</div>
                                    <select required class="select2_cus" name="activity_id" title="" style="width:100%">
                                        <option value="" selected="selected">{{ __('static.Выберите сферу') }}</option>
                                        @foreach($activities as $activity)
                                            <option value="{{ $activity->id }}"
                                                {{ request()->get('activity_id') == $activity->id ? 'selected' : '' }}>
                                                {{ $activity->{'title_'.$lang} }}
                                            </option>
                                        @endforeach
                                    </select>

{{--                                    <div class="registration-form__radios">--}}
{{--                                        @foreach($activities as $activity)--}}
{{--                                            <div class="registration-form__radio">--}}
{{--                                                <input title="" type="radio" name="activity_id" value="{{ $activity->id }}">--}}
{{--                                                <span>{{ $activity->{'title_'.$lang} }}</span>--}}
{{--                                            </div>--}}
{{--                                        @endforeach--}}
{{--                                    </div>--}}
                                </div>

                                <div class="registration-form__box mb-30">
                                    <div class="registration-form__type">{{ __('static.Выберите менеджера') }}</div>
                                    <select required class="select2_cus" name="manager_id" title="" style="width:100%">
                                        <option value="" selected="selected">{{ __('static.Выберите менеджера') }}</option>
                                        @foreach($managers as $manager)
                                            <option value="{{ $manager->id }}"
                                                {{ request()->get('manager_id') == $manager->id ? 'selected' : '' }}>
                                                {{ $manager->{'name_'.$lang} }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-main">
                                    <span>{{ __('static.Зарегистрироваться') }}</span>
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
