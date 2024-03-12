@component('frontend.components.calculator-data', ['calculatorData' => $calculatorData]) @endcomponent

@php
    $isAuto = request()->get('delivery_type') == \App\Models\Application::DELIVERY_TYPE_AUTO;
@endphp

<div class="tab-bottom">
    <div class="row justify-content-between">
        <div class="col-12 col-sm-12 col-md-12 col-lg-7 col-xl-7">
            <div class="tab-rate --layout">
                <div class="tab-rate__inner">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-6 col-lg-7 col-xl-8">
                            <div class="tab-rate__text">
                                {{ __('static.Calculator Detail Title') }}
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6 col-lg-5 col-xl-4">
                            <div class="tab-rate__select">
                                <div class="tab-rate__name">{{ __('static.Дополнительные функции') }}</div>
                                <select class="select2_cus" name="additional_id" title="" style="width: 100%">
                                    <option hidden selected="selected" value="">
                                        {{ __('static.Выберите функцию') }}
                                    </option>
                                    @foreach($additional_functions as $additional_function)
                                    <option value="{{ $additional_function->id }}"
                                        {{ request()->get('additional_id') == $additional_function->id ? 'selected' : '' }}>
                                        {{ $additional_function->{'title_'.$lang} }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                @if(count($includes) > 0)
                <div class="tab-rate__box">
                    <div class="tab-rate__title">{{ __('static.Что входит в тариф?') }}</div>

                    <ul class="tab-rate__list">
                        @foreach($includes as $include)
                        <li class="tab-rate__item">
                            <img src="/frontend/images/icon/question.svg" alt="" />
                            <span>{{ $include->{'title_'.$lang} }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>
            <div class="row">
                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="tab-phone --layout">
                        <div class="tab-phone__icon">
                            <img src="/frontend/images/icon/call.svg" alt="" />
                        </div>
                        <div class="tab-phone__info">
                            <div class="tab-phone__title">
                                {{ __('static.Есть вопросы по нашему сервису?') }}
                            </div>
                            <div class="tab-phone__text">
                                {{ __('static.Обращайтесь в наш колцентр, менеджер проконсультирует вас') }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <button class="btn btn-main --big" id="sendApplicationBtn">
                        <span>{{ __('static.Отправить заявку') }}</span>
                    </button>
                </div>
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="tab-description">
                        {{ __('static.Выбирая и отправляя информацию, вы соглашаетесь со всей политикой и правилами конфиденциальности сайта.') }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-12 col-md-12 col-lg-5 col-xl-5">
            <div class="tab-price --additionally">
                <div class="tab-price__top {{ !$isAuto ? 'full-border' : '' }}">
                    <div class="tab-price__title">{{ __('static.Чек лист вашей грузоперевозки') }}</div>

                    <div class="tab-price__item">
                        <div class="tab-price__type">{{ __('static.Дата заказа') }}</div>
                        <div class="tab-price__value">{{ \Carbon\Carbon::now()->format('d/m/Y') }}</div>
                    </div>
                    <div class="tab-price__item">
                        <div class="tab-price__type">{{ __('static.Откуда') }}</div>
                        <div class="tab-price__value">{{ @$pointA->country->{'name_'.$lang} }} ({{ @$pointA->{'name_'.$lang} }})</div>
                    </div>
                    <div class="tab-price__item">
                        <div class="tab-price__type">{{ __('static.Куда') }}</div>
                        <div class="tab-price__value">{{ @$pointB->country->{'name_'.$lang} }} ({{ @$pointB->{'name_'.$lang} }})</div>
                    </div>
                    <div class="tab-price__item">
                        <div class="tab-price__type">{{ __('static.Вид карго') }}</div>
                        <div class="tab-price__value">
                            {{ \App\Models\Application::getDeliveryTypeLabel(request()->get('delivery_type')) }}
                        </div>
                    </div>
                    <div class="tab-price__item">
                        <div class="tab-price__box">
                            <div class="tab-price__type">{{ __('static.Вес груза') }}</div>
                            <img src="/frontend/images/icon/!.svg" alt="" />
                        </div>
                        <div class="tab-price__value">{{ request()->get('weight') ?? 0 }} {{ __('static.кг') }}</div>
                    </div>
                    <div class="tab-price__item">
                        <div class="tab-price__box">
                            <div class="tab-price__type">{{ __('static.Размер груза') }}</div>
                            <img src="/frontend/images/icon/!.svg" alt="" />
                        </div>
                        <div class="tab-price__value">{{ request()->get('volume') ?? 0 }} м3</div>
                    </div>

                    <div class="tab-price__item">
                        <div class="tab-price__box">
                            <div class="tab-price__type">{{ __('static.Страховка') }}</div>
                            <img src="/frontend/images/icon/!.svg" alt="" />
                        </div>
                        <div class="tab-price__value">{{ __('static.Включена') }}</div>
                    </div>
                    <div class="tab-price__item">
                        <div class="tab-price__box">
                            <div class="tab-price__type">{{ __('static.Время доставки') }}</div>
                            <img src="/frontend/images/icon/!.svg" alt="" />
                        </div>
                        <div class="tab-price__value">{{ $isAuto ? '15-20' : '5-6' }} {{ __('static.дней') }}</div>
                    </div>
                </div>

                @if($isAuto)
                <div class="tab-price__bottom">
                    <div class="tab-price__amount">{{ __('static.Цена') }}: <span>@priceFormat(round($price)) {{ __('static.$') }}</span></div>
                    <div class="tab-price__text" style="max-width: 100%;margin-bottom: 10px">
                        {{ __('static.Расчет осуществляется по курсу ЦБ в сумах')  }}
                    </div>
                    <div class="tab-price__text" style="max-width: 100%">
                        {{ __('static.Цена учтена по итогу ваших настроек, изменить цену можно выбрав други настройки грузоперевозки')  }}
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
