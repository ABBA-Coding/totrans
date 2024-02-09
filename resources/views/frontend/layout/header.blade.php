<header class="header">
    <div class="container">
        <div class="header-wrapper">
            <div class="header-left">
                <div class="header-main">
                    <a href="{{ __('static.menu.home') }}" class="header-logo">
                        <img src="/frontend/images/icon/logo.svg" alt="" />
                    </a>

                    <div class="header-box">
                        <div class="header-burger">
                            <span></span>
                        </div>

                        <div class="menu">
                            <ul class="menu-list">
                                <li><a href="{{ __('static.menu.home') }}" class="menu-link">{{ __('static.Главная') }}</a></li>
                                <li><a href="{{ __('static.menu.about') }}" class="menu-link">{{ __('static.О нас') }}</a></li>
                                <li><a href="{{ __('static.menu.calculator') }}" class="menu-link">{{ __('static.Калькулятор') }}</a></li>
                                <li><a href="{{ __('static.menu.news') }}" class="menu-link">{{ __('static.Новости') }}</a></li>
                                <li><a href="{{ __('static.menu.contacts') }}" class="menu-link">{{ __('static.Контакты') }}</a></li>
                            </ul>
                            <div class="menu-close">
                                <img src="/frontend/images/icon/cancel.svg" alt="" />
                            </div>
                        </div>

                        @if(\Illuminate\Support\Facades\Auth::check())
                            <a href="{{ route('profile.home') }}" class="btn btn-main">
                                <img src="/frontend/images/icon/login-half.svg" alt="" />
                                <span>{{ __('static.Кабинет') }}</span>
                            </a>
                        @else
                            <a href="{{ route('profile.login') }}" class="btn btn-main">
                                <img src="/frontend/images/icon/login-half.svg" alt="" />
                                <span>{{ __('static.Вход') }}</span>
                            </a>
                        @endif
                    </div>
                </div>

                <div class="language">
                    <ul data-target="one" class="language-list">
                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            @if($localeCode !== App::getLocale())
                                <li>
                                    <a hreflang="{{ $localeCode }}" class="language-link" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                        <span>{{ $properties['visible'] }}</span>
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                    <button data-path="one" class="language-toggle language-text">
                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            @if($localeCode == App::getLocale())
                                <span>{{ $properties['visible'] }}</span> <img class="language-arrow" src="/frontend/images/icon/arrowBottom.svg" alt=""/>
                            @endif
                        @endforeach
                    </button>
                </div>
            </div>

            <div class="header-right">
                <a href="{{ route('calculator') }}" class="btn btn-main">
                    <img class="btn-icon" src="/frontend/images/icon/calculator.svg" alt="" />
                    <span>{{ __('static.Калькулятор') }}</span>
                </a>
                <button class="btn btn-main">
                    <img class="btn-icon" src="/frontend/images/icon/phone.svg" alt="" />
                    <span>{{ __('static.Связаться') }}</span>
                </button>
            </div>
        </div>
    </div>
</header>
