<div class="application-card status_{{ $application->batch->status }}" style="cursor: auto">
    <div class="info-card">
        <div class="info-card__box">
            <div class="info-card__num" style="margin-bottom: 10px">{{ $application->order_date }}</div>
            <div class="info-card__top">
                <div class="info-card__grey">{{ __('static.ID заказа') }}</div>
                <div class="info-card__grey">{{ __('static.Местоположение груза') }}</div>
            </div>
            <div class="info-card__top">
                <div class="info-card__num">#{{ $application->application_number }}</div>
                <div class="info-card__num application-card__status">{{ $application->batch->state->{'title_'.$lang} }}</div>
            </div>
        </div>
        <div class="info-card__box">
            <div class="info-card__top">
                <div class="info-card__grey">{{ __('static.Точка А') }}</div>
                <div class="info-card__grey">{{ __('static.Точка Б') }}</div>
            </div>
            <div class="info-card__top">
                <div class="info-card__num">
                    {{ $application->pointA->country->{'name_'.$lang} }} <br>
                    ({{ $application->pointA->{'name_'.$lang} }})
                </div>
                <div class="info-card__num">
                    {{ $application->pointB->country->{'name_'.$lang} }} <br>
                    ({{ $application->pointB->{'name_'.$lang} }})
                </div>
            </div>
        </div>
        <div class="info-card__img">
            @if(in_array($application->batch->status, [\App\Models\Batch::STATUS_WAITING, \App\Models\Batch::STATUS_PROCESSING]))
            <img
                class="info-card__dark"
                src="/frontend/images/icon/route.svg"
                alt=""
            />
            @else
            <img
                class="info-card__white"
                src="/frontend/images/icon/route2.svg"
                alt=""
            />
            @endif
        </div>
    </div>

    <div class="information-card">
        <div class="information-card__box">
            <div class="information-card__item">
                <div class="information-card__type">{{ __('static.ID заказа') }}</div>
                <div class="information-card__type">{{ __('static.Объём груза') }}</div>
                <div class="information-card__type">{{ __('static.Местоположение груза') }}</div>
            </div>
            <div class="information-card__item">
                <div class="information-card__value">#{{ $application->application_number }}</div>
                <div class="information-card__value">{{ $application->volume }}</div>
                <div class="information-card__value application-card__status">
                    {{ $application->batch->state->parent->{'title_'.$lang} }}
                </div>
            </div>
        </div>

        <div class="information-card__box">
            <div class="information-card__item">
                <div class="information-card__type">{{ __('static.Количество мест') }}</div>
                <div class="information-card__type">{{ __('static.Вес груза') }}</div>
                <div class="information-card__type">{{ __('static.Маршрут') }}</div>
            </div>
            <div class="information-card__item">
                <div class="information-card__value">{{ $application->seats_number ?? 1 }}</div>
                <div class="information-card__value">{{ $application->weight }} {{ __('static.кг') }}</div>
                <div class="information-card__value">
                    {{ mb_substr($application->pointA->country->{'name_'.$lang}, 0,3) }} - {{ mb_substr($application->pointB->country->{'name_'.$lang}, 0,3) }}
                </div>
            </div>
        </div>

        <div class="information-card__expectations">
            <ul class="information-card__list">
                @foreach($states as $state)
                    @foreach($state->children as $innerState)
                        <li class="information-card__path {{ $innerState->id == $application->batch->state_id ? 'active' : '' }}">
                            <div class="information-card__circle"></div>
                            <div class="information-card__line"></div>
                            <div class="information-card__icon">
                                @php
                                    $svgContent = '';
                                    if ($innerState->file_id) {
                                        $svgContent = @file_get_contents($innerState->getFile('file', 'small'), FILE_USE_INCLUDE_PATH);
                                    }
                                @endphp
                                {!! $svgContent !!}
                            </div>
                            <div class="information-card__text">
                                {{ $innerState->{'title_'.$lang} }}
                            </div>
                        </li>
                    @endforeach
                @endforeach
            </ul>
        </div>
    </div>

</div>
