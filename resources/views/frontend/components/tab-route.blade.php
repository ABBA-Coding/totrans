@component('frontend.components.calculator-data', ['calculatorData' => $calculatorData]) @endcomponent

<div class="tab-bottom">
    <div class="row --center">
        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
            <div class="tab-form">
                <div>
                    <div class="tab-form__box">
                        <div class="tab-form__title">{{ __('static.Откуда нужно забрать ваш груз?') }} ({{ __('static.Точка А') }})</div>
                        <div class="row">
                            <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-6">
                                <select required class="select2_cus" name="point_a_country_id" title="" style="width:100%">
                                    <option value="" selected="selected">{{ __('static.Выберите страну') }}</option>
                                    @foreach($from_countries as $f_country)
                                        <option value="{{ $f_country->id }}"
                                            {{ request()->get('point_a_country_id') == $f_country->id ? 'selected' : '' }}>
                                            {{ $f_country->{'name_'.$lang} }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-6">
                                <select required class="select2_cus" name="point_a_id" data-parent="point_a_country_id" title="" disabled style="width:100%">
                                    <option value="" selected="selected">{{ __('static.Выберите город') }}</option>
                                    @foreach($from_countries as $f_country)
                                        @foreach($f_country->cities as $city)
                                            <option value="{{ $city->id }}"
                                                    data-parent-id="{{ $f_country->id }}"
                                                    {{ request()->get('point_a_id') == $city->id ? 'selected' : '' }}>
                                                {{ $city->{'name_'.$lang} }}
                                            </option>
                                        @endforeach
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="tab-form__box">
                        <div class="tab-form__title">{{ __('static.Куда следует доставить ваш груз?') }} ({{ __('static.Точка Б') }})</div>
                        <div class="row">
                            <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-6">
                                <select required class="select2_cus" name="point_b_country_id" title="" style="width:100%">
                                    <option value="" selected="selected">{{ __('static.Выберите страну') }}</option>
                                    @foreach($to_countries as $t_country)
                                        <option value="{{ $t_country->id }}"
                                            {{ request()->get('point_b_country_id') == $t_country->id ? 'selected' : '' }}>
                                            {{ $t_country->{'name_'.$lang} }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-6">
                                <select required class="select2_cus" name="point_b_id" data-parent="point_b_country_id" title="" disabled style="width:100%">
                                    <option value="" selected="selected">{{ __('static.Выберите город') }}</option>
                                    @foreach($to_countries as $t_country)
                                        @foreach($t_country->cities as $city)
                                            <option value="{{ $city->id }}"
                                                    data-parent-id="{{ $t_country->id }}"
                                                    {{ request()->get('point_b_id') == $city->id ? 'selected' : '' }}>
                                                {{ $city->{'name_'.$lang} }}
                                            </option>
                                        @endforeach
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="tab-form__box">
                        <div class="tab-form__title">{{ __('static.Выберите сферу деятельности') }}</div>
                        <div class="row">
                            <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-12">
                                <select required class="select2_cus" name="activity_id" title="" style="width:100%">
                                    <option value="" selected="selected">{{ __('static.Выберите сферу') }}</option>
                                    @foreach($activities as $activity)
                                        <option value="{{ $activity->id }}"
                                            {{ request()->get('activity_id') == $activity->id ? 'selected' : '' }}>
                                            {{ $activity->{'title_'.$lang} }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-form__footer">
                    <a href="javascript:" class="btn btn-main change-tab" data-tab="transport">
                        <span>{{ __('static.Следующий') }}</span>
                        <img class="btn-arrow" src="/frontend/images/icon/btnArrow.svg" alt="">
                    </a>
                    <div class="tab-form__text">{{ __('static.Заполните все разделы и можете переходить к следующему этапу.') }} <a href="javascript:">{{ __('static.Воспользоваться калькулятором можно через видеогид.') }}</a></div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
            <div class="tab-media">
                <div class="tab-media__img">
                    <img src="/frontend/images/png/tabImg.png" alt="">
                </div>
                <button class="btn btn-white">
                    <img class="btn-icon" src="/frontend/images/icon/play.svg" alt="">
                    <span>{{ __('static.Видеогид') }}</span>
                </button>
                <img class="tab-media__decor1" src="/frontend/images/png/decor1.png" alt="">
                <img class="tab-media__decor2" src="/frontend/images/png/decor2.png" alt="">
            </div>
        </div>
    </div>
</div>
