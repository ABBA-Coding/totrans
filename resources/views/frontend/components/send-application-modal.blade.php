<div class="modal none" id="application-modal">
    <div class="modal-wrapper">
        <div class="modal-body">
            <div class="modal-title">{{ __('static.Создать заявку') }}</div>
            <div class="registration-form__box" style="text-align: left;">
                <div class="registration-form__type" style="font-size: 16px">{{ __('static.Имя') }}</div>
                <input
                    name="name"
                    type="text"
                    class="registration-form__input"
                    placeholder="{{ __('static.Введите ваше имя') }}"
                    autocomplete="off"
                    required
                />
            </div>
            <div class="registration-form__box" style="text-align: left">
                <div class="registration-form__type" style="font-size: 16px">{{ __('static.Телефон') }}</div>
                <input
                    name="phone"
                    type="text"
                    class="registration-form__input"
                    placeholder="{{ __('static.Введите номер телефона') }}"
                    autocomplete="off"
                    data-field-type="phone"
                    required
                />
            </div>
            <button class="btn btn-main change-tab" data-tab="application" style="width: 100%; margin-top: 30px">
                <span>{{ __('static.Создать') }}</span>
            </button>
        </div>
        <div class="modal-close">
            <img src="/frontend/images/icon/close.svg" alt="" />
        </div>
    </div>
</div>
