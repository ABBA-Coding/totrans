
@if($manager)
<div class="manager-section">
    <div class="manager-section__top">
        <div class="manager-section__img">
            <img src="{{ $manager->getFile('file', 'small') }}" alt="" />
        </div>
        <div class="manager-section__info">
            <div class="manager-section__name">{{ $manager->{'name_'.$lang} }}</div>
            <div class="manager-section__manager">
                {{ __('static.Менеджер по связи с клиентами') }}
            </div>
            <div class="manager-section__online">{{ __('static.Онлайн') }}</div>
        </div>
    </div>
    <div class="manager-section__center">
        {{ __('static.Есть вопросы по работе системы Totrans logistics?') }}
    </div>
    <div class="manager-section__bottom">
        <button>
            <a href="tel:@phone($manager->phone)" target="_blank" class="btn btn-main">
                <span>{{ __('static.Позвонить') }}</span>
            </a>
        </button>
        <button>
            <a href="https://t.me/{{ $manager->telegram }}" target="_blank" class="btn btn-main">
                <span>{{ __('static.Наш Telegram') }}</span>
            </a>
        </button>
    </div>
</div>
@endif
