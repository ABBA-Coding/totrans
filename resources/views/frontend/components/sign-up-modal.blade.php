<div class="modal {{ request()->has('_id') ? 'show' : 'd-none' }}">
    <div class="modal-wrapper">
        <div class="modal-body">
            <div class="modal-title">{{ __('static.Вы успешно зарегистрировались') }}</div>
            <div class="modal-icon">
                <img src="/frontend/images/icon/checked.svg" alt="" />
            </div>
            <div class="modal-article">{{ __('static.Ваш ID') }} {{ request()->get('_id') }}</div>
            <div class="modal-text">
                {{ __('static.Никому не сообщайте личные данные вашего аккаунта во избежания взлома') }}
            </div>
        </div>
        <div class="modal-close">
            <img src="/frontend/images/icon/close.svg" alt="" />
        </div>
    </div>
</div>
