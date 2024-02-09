@component('frontend.components.calculator-data', ['calculatorData' => $calculatorData]) @endcomponent

<div class="tab-bottom">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
            <div class="tab-form">
                <div>
                    @component('frontend.components.delivery-types') @endcomponent

                    <div class="tab-form__box --radio">
                        <div class="row">
                            <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-5">
                                <div class="tab-form__title">{{ __('static.Вес груза') }}</div>
                                <label for="" class="tab-form__label">
                                    <input required name="weight" autocomplete="off" class="tab-form__input" type="text" value="{{ request()->get('weight') }}"/>
                                    <div class="tab-form__name"><span>0.0</span> {{ __('static.кг') }}</div>
                                </label>
                            </div>
                            <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-5">
                                <div class="tab-form__title">{{ __('static.Размер груза') }}</div>
                                <label for="" class="tab-form__label">
                                    <input required name="volume" autocomplete="off" class="tab-form__input" type="text" value="{{ request()->get('volume') }}"/>
                                    <div class="tab-form__name"><span>0.0</span> {{ __('static.м3') }}</div>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-form__address">
                    <img src="/frontend/images/icon/line.svg" alt=""/>
                    <div class="tab-form__subtitle">
                        {{ __('static.Точка А') }} ({{ $pointA ? $pointA->country->{'name_'.$lang} : '' }}, {{ $pointA ? $pointA->{'name_'.$lang} : '' }})
                        -
                        {{ __('static.Точка Б') }} ({{ $pointB ? $pointB->country->{'name_'.$lang} : '' }}, {{ $pointB ? $pointB->{'name_'.$lang} : '' }})
                        <a href="javascript:" class="change-tab" data-tab="route">{{ __('static.Изменить') }}</a>
                    </div>
                </div>

                <div class="tab-form__footer">
                    <div class="tab-form__item">
                        <a href="javascript:" class="btn btn-grey change-tab" data-tab="route" style="margin-right: 5px">
                            <img class="btn-icon" src="/frontend/images/icon/btnArrow2.svg" alt=""/>
                            <span>{{ __('static.Вернутся') }}</span>
                        </a>
                        <a href="javascript:" class="btn btn-main change-tab" data-tab="detail">
                            <span>{{ __('static.Следующий') }}</span>
                            <img class="btn-arrow" src="/frontend/images/icon/btnArrow.svg" alt=""/>
                        </a>
                    </div>

                    <div class="tab-form__text">
                        {{ __('static.Заполните все разделы и можете переходить к следующему этапу.') }}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
            <div class="tab-media --red">
                <div class="tab-media__img">
                    <img src="/frontend/images/png/tabImg2.png" alt=""/>
                </div>

                <button class="btn btn-white">
                    <img class="btn-icon" src="/frontend/images/icon/play.svg" alt=""/>
                    <span>{{ __('static.Видеогид') }}</span>
                </button>
                <img
                    class="tab-media__decor3"
                    src="/frontend/images/png/decor1.png"
                    alt=""
                />
            </div>
        </div>
    </div>
</div>
