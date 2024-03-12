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
                            <div class="dashboard-main__left --bg">
                                <div class="dashboard-main__inner">
                                    @if(count($applications) > 0)
                                        @foreach($applications as $application)
                                            @component('frontend.components.application-card', ['application' => $application, 'states'=>$states]) @endcomponent
                                        @endforeach
                                    @else
                                        @component('frontend.components.empty') @endcomponent
                                    @endif
                                </div>
                            </div>

                            <div class="dashboard-main__right">
                                <div class="statistic-section">
                                    <div class="statistic-section__wrapper">
                                        <div class="statistic-section__item">
                                            <div class="statistic-section__name">
                                                {{ __('static.Совершено перевозок в этом месяце') }}
                                            </div>
                                            <div class="statistic-section__line"></div>
                                            <div class="statistic-section__num">{{ $statistics['currentMonth'] }}</div>
                                        </div>
                                        <div class="statistic-section__item">
                                            <div class="statistic-section__name">
                                                {{ __('static.Совершено перевозок в прошлом месяце') }}
                                            </div>
                                            <div class="statistic-section__line"></div>
                                            <div class="statistic-section__num">{{ $statistics['prevMonth'] }}</div>
                                        </div>
                                        <div class="statistic-section__item">
                                            <div class="statistic-section__name --red">
                                                {{ __('static.Совершено перевозок за год') }}
                                            </div>
                                            <div class="statistic-section__line"></div>
                                            <div class="statistic-section__num">{{ $statistics['currentYear'] }}</div>
                                        </div>
                                    </div>
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
