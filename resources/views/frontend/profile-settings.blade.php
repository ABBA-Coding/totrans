@extends('frontend.layout.master')

@section('section')
    <div class="site-wrapper">
        <section class="sec-padding">
            <div class="container">
                <div class="dashboard">
                    @component('frontend.components.profile-sidebar') @endcomponent
                    <div class="dashboard-wrapper">

                        <div class="dashboard-top">
                            <div class="dashboard-top__id">{{ __('static.Мой ID') }} {{ \Illuminate\Support\Facades\Auth::user()->login }}</div>
                        </div>

                        <div class="dashboard-main">
                            <div class="dashboard-main__left">
                                <div class="account-section">
                                    <div class="account-section__title">{{ __('static.Мой аккаунт') }}</div>

                                    <div class="{{ request()->has('edit') ? 'd-none' : 'd-block' }}">

                                        <div class="account-section__box">
                                            <div class="sidebar-user">
                                                <div class="sidebar-user__img">
                                                    <img src="/frontend/images/icon/user.svg" alt="" />
                                                </div>
                                                <div class="sidebar-user__name">{{ \Illuminate\Support\Facades\Auth::user()->name }}</div>
                                            </div>
                                            <a href="{{ route('profile.settings', ['edit' => true]) }}" class="account-section__button">
                                                <img src="/frontend/images/icon/pencil.svg" alt="" />
                                                <span>{{ __('static.Редактировать') }}</span>
                                            </a>
                                        </div>

                                        <div class="account-section__box">
                                            <div class="account-section__item">
                                                <div class="account-section__type">{{ __('static.Имя') }}</div>
                                                <div class="account-section__name">{{ $user->name }}</div>
                                            </div>
                                            <a href="{{ route('profile.settings', ['edit' => true]) }}" class="account-section__button">
                                                <img src="/frontend/images/icon/pencil.svg" alt="" />
                                                <span>{{ __('static.Редактировать') }}</span>
                                            </a>
                                        </div>

                                        <div class="account-section__box">
                                            <div class="account-section__item">
                                                <div class="account-section__type">{{ __('static.Фамилия') }}</div>
                                                <div class="account-section__name">{{ $user->surname ?? '-' }}</div>
                                            </div>
                                            <a href="{{ route('profile.settings', ['edit' => true]) }}" class="account-section__button">
                                                <img src="/frontend/images/icon/pencil.svg" alt="" />
                                                <span>{{ __('static.Редактировать') }}</span>
                                            </a>
                                        </div>

                                        <div class="account-section__box">
                                            <div class="account-section__item">
                                                <div class="account-section__type">{{ __('static.Сфера деятельности') }}</div>
                                                <div class="account-section__name">{{ $user->activity->{'title_'.$lang} }}</div>
                                            </div>
                                            <a href="{{ route('profile.settings', ['edit' => true]) }}" class="account-section__button">
                                                <img src="/frontend/images/icon/pencil.svg" alt="" />
                                                <span>{{ __('static.Редактировать') }}</span>
                                            </a>
                                        </div>

                                        <div class="account-section__box">
                                            <div class="account-section__item">
                                                <div class="account-section__type">{{ __('static.Номер телефона') }}</div>
                                                <div class="account-section__name">{{ $user->phone ?? '-' }}</div>
                                            </div>
                                            <a href="{{ route('profile.settings', ['edit' => true]) }}" class="account-section__button">
                                                <img src="/frontend/images/icon/pencil.svg" alt="" />
                                                <span>{{ __('static.Редактировать') }}</span>
                                            </a>
                                        </div>

                                        <div class="account-section__box">
                                            <div class="account-section__item">
                                                <div class="account-section__type">{{ __('static.E-mail') }}</div>
                                                <div class="account-section__name">
                                                    {{ $user->email ?? '-' }}
                                                </div>
                                            </div>
                                            <a href="{{ route('profile.settings', ['edit' => true]) }}" class="account-section__button">
                                                <img src="/frontend/images/icon/pencil.svg" alt="" />
                                                <span>{{ __('static.Редактировать') }}</span>
                                            </a>
                                        </div>

                                        <div class="account-section__box">
                                            <div class="account-section__item">
                                                <div class="account-section__type">{{ __('static.Компания') }}</div>
                                                <div class="account-section__name">
                                                    {{ $user->company_name ?? '-' }}
                                                </div>
                                            </div>
                                            <a href="{{ route('profile.settings', ['edit' => true]) }}" class="account-section__button">
                                                <img src="/frontend/images/icon/pencil.svg" alt="" />
                                                <span>{{ __('static.Редактировать') }}</span>
                                            </a>
                                        </div>
                                    </div>

                                    <form action="{{ route('profile.settings.post') }}" method="post" class="{{ request()->has('edit') ? 'd-block' : 'd-none' }}">
                                        {{ csrf_field() }}

                                        <div class="row">
                                            <div class="col-12 col-md-6">
                                                <div class="account-section__item">
                                                    <div class="account-section__type">{{ __('static.Имя') }}</div>
                                                    <div class="form-group">
                                                        <input type="text" class="tab-form__input" name="name" title="" value="{{ $user->name }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12 col-md-6">
                                                <div class="account-section__item">
                                                    <div class="account-section__type">{{ __('static.Фамилия') }}</div>
                                                    <div class="form-group">
                                                        <input type="text" class="tab-form__input" name="surname" title="" value="{{ $user->surname }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12 col-md-6">
                                                <div class="account-section__item">
                                                    <div class="account-section__type">{{ __('static.Дата рождение') }}</div>
                                                    <div class="form-group">
                                                        <input type="text" class="tab-form__input" name="birthday" title=""
                                                               data-field-type="birthday" value="{{ $user->birthday }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12 col-md-6">
                                                <div class="account-section__item">
                                                    <div class="account-section__type">{{ __('static.Сфера деятельности') }}</div>
                                                    <div class="form-group">
                                                        <select class="select2_cus" name="activity_id" title="" style="width:100%">
                                                            <option value="" selected="selected">{{ __('static.Выберите сферу деятельности') }}</option>
                                                            @foreach($activities as $activity)
                                                                <option value="{{ $activity->id }}"
                                                                    {{ $activity->id == $user->activity_id ? 'selected' : '' }}>
                                                                    {{ $activity->{'title_'.$lang} }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12 col-md-6">
                                                <div class="account-section__item">
                                                    <div class="account-section__type">{{ __('static.Номер телефона') }}</div>
                                                    <div class="form-group">
                                                        <input type="text" class="tab-form__input" name="phone" title=""
                                                               data-field-type="phone" value="{{ $user->phone }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12 col-md-6">
                                                <div class="account-section__item">
                                                    <div class="account-section__type">{{ __('static.E-mail') }}</div>
                                                    <div class="form-group">
                                                        <input type="email" class="tab-form__input" name="email" title="" value="{{ $user->email }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12 col-md-6">
                                                <div class="account-section__item">
                                                    <div class="account-section__type">{{ __('static.Компания') }}</div>
                                                    <div class="form-group">
                                                        <input type="text" class="tab-form__input" name="company_name" title="" value="{{ $user->company_name }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-6">
                                                <a href="{{ route('profile.settings') }}" class="btn btn-grey" style="width: 100%">
                                                    <span>{{ __('static.Отмена') }}</span>
                                                </a>
                                            </div>
                                            <div class="col-6">
                                                <button type="submit" style="width: 100%" class="btn btn-main">
                                                    <span>{{ __('static.Сохранить') }}</span>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="dashboard-main__right">
                                <div class="banner-section">
                                    <a href="{{ __('static.menu.home') }}" class="banner-section__img">
                                        <img src="/frontend/images/png/banner.png" alt="" />
                                    </a>
                                </div>
                                @component('frontend.components.manager', ['manager' => $manager]) @endcomponent
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
