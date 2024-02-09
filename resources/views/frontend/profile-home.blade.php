@extends('frontend.layout.master')

@section('section')
    <div class="site-wrapper">
        <section class="sec-padding">
            <div class="container">
                <div class="dashboard">
                    @component('frontend.components.profile-sidebar') @endcomponent
                    <div class="dashboard-wrapper">

                        <div class="dashboard-top">
                            <div class="dashboard-top__id">{{ __('static.Мой ID') }} #{{ \Illuminate\Support\Facades\Auth::user()->login }}</div>
                        </div>

                        <div class="dashboard-main">
                            <div class="dashboard-main__left --bg">
                                <div class="dashboard-main__inner">
                                    @if(count($applications) > 0)
                                        @foreach($applications as $application)
                                            @component('frontend.components.application-card', ['application' => $application, 'states' => $states]) @endcomponent
                                        @endforeach
                                    @else
                                        @component('frontend.components.empty') @endcomponent
                                    @endif
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
