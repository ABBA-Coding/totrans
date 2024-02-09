<div class="tab-form__box --radio">
    <div class="tab-form__title">{{ __('static.Какой вид карго вам нужен?') }}</div>
    <div class="tab-form__inner">
        <div class="tab-form__container">
            <input class="tab-form__radio"
                   id="delivery_type_name1"
                   type="radio"
                   name="delivery_type"
                   {{ request()->get('delivery_type') == \App\Models\Application::DELIVERY_TYPE_AUTO ? 'checked' : '' }}
                   {{ !request()->has('delivery_type') ? 'checked' : '' }}
                   value="{{ \App\Models\Application::DELIVERY_TYPE_AUTO }}"/>
            <div class="tab-form__items">
                <div class="tab-form__icon">
                    <img src="/frontend/images/icon/radio1.svg" alt=""/>
                </div>
                <label class="tab-form__type" for="delivery_type_name1">{{ __('static.Авто') }}</label>
            </div>
        </div>
        <div class="tab-form__container">
            <input class="tab-form__radio"
                   id="delivery_type_name2"
                   type="radio"
                   name="delivery_type"
                   {{ request()->get('delivery_type') == \App\Models\Application::DELIVERY_TYPE_AIR ? 'checked' : '' }}
                   value="{{ \App\Models\Application::DELIVERY_TYPE_AIR }}"/>
            <div class="tab-form__items">
                <div class="tab-form__icon">
                    <img src="/frontend/images/icon/radio2.svg" alt=""/>
                </div>
                <label class="tab-form__type" for="delivery_type_name2">{{ __('static.Авиа') }}</label>
            </div>
        </div>
        <div class="tab-form__container">
            <input class="tab-form__radio"
                   id="delivery_type_name3"
                   type="radio"
                   name="delivery_type"
                   {{ request()->get('delivery_type') == \App\Models\Application::DELIVERY_TYPE_TRAIN ? 'checked' : '' }}
                   value="{{ \App\Models\Application::DELIVERY_TYPE_TRAIN }}"/>
            <div class="tab-form__items">
                <div class="tab-form__icon">
                    <img src="/frontend/images/icon/radio3.svg" alt=""/>
                </div>
                <label class="tab-form__type" for="delivery_type_name3">{{ __('static.Железнодорожная') }}</label>
            </div>
        </div>
        <div class="tab-form__container">
            <input class="tab-form__radio"
                   id="delivery_type_name4"
                   type="radio"
                   name="delivery_type"
                   {{ request()->get('delivery_type') == \App\Models\Application::DELIVERY_TYPE_MARINE ? 'checked' : '' }}
                   value="{{ \App\Models\Application::DELIVERY_TYPE_MARINE }}"/>
            <div class="tab-form__items">
                <div class="tab-form__icon">
                    <img src="/frontend/images/icon/radio4.svg" alt=""/>
                </div>
                <label class="tab-form__type" for="delivery_type_name4">{{ __('static.Морская') }}</label>
            </div>
        </div>
        <div class="tab-form__container">
            <input class="tab-form__radio"
                   id="delivery_type_name5"
                   type="radio"
                   name="delivery_type"
                   {{ request()->get('delivery_type') == \App\Models\Application::DELIVERY_TYPE_ALL ? 'checked' : '' }}
                   value="{{ \App\Models\Application::DELIVERY_TYPE_ALL }}"/>
            <div class="tab-form__items">
                <div class="tab-form__icon">
                    <img src="/frontend/images/icon/radio5.svg" alt=""/>
                </div>
                <label class="tab-form__type" for="delivery_type_name5">{{ __('static.Все') }}</label>
            </div>
        </div>
    </div>
</div>

<div class="tab-form__info active" data-tab="{{ \App\Models\Application::DELIVERY_TYPE_AUTO }}">
    <p>Автоперевозка грузов- это система, которая заботится о том, чтобы машины и грузы достигали места назначения быстро и эффективно, обеспечивая отслеживание и контроль каждого этапа доставки.</p>
    <p>Наши авто-логистические услуги обеспечивают эффективную доставку сроком 10-15 дней, где каждый этап контролируется с максимальной тщательностью. Гарантия 100% на качество сервиса подчеркивает нашу преданность надежности и высоким стандартам обслуживания клиентов.</p>
    <p>Безопасность вашего груза — наш приоритет. Мы гарантируем полную ответственность за любые возможные инциденты или события, которые могут повлиять на доставку. Наша логистическая компания стремится обеспечить надежность и защиту вашего груза на каждом этапе пути.</p>
</div>

<div class="tab-form__info" data-tab="{{ \App\Models\Application::DELIVERY_TYPE_AIR }}">
    <p>Авиаперевозка грузов - это  область логистики, которая  оптимизирует транспортировки грузов с использованием воздушного транспорта. Наша авиа логистика имеет много преимуществ как: Быстрая доставка: Авиатранспорт обеспечивает быструю и эффективную доставку грузов в любую точку мира, сокращая время в пути по сравнению с другими видами транспорта.</p>
    <p>Глобальное покрытие: Авиалинии обеспечивают обширное глобальное покрытие, что делает авиалогистику предпочтительным выбором для международных перевозок и доставки в отдаленные регионы.</p>
    <p>Гибкость и реагирование: Воздушный транспорт обладает высокой гибкостью, позволяя быстро реагировать на изменения в спросе, чрезвычайные ситуации или срочные заказы.</p>
    <p>Меньший риск утраты и повреждения груза: По сравнению с другими видами транспорта, риск утраты или повреждения груза при авиаперевозках снижается благодаря более прямому и контролируемому маршруту.</p>
</div>

<div class="tab-form__info" data-tab="{{ \App\Models\Application::DELIVERY_TYPE_TRAIN }}">
    <p>Железнодорожная перевозка грузов – это система организации и управления перевозками грузов по железнодорожным путям. Наша услуга включает в себя планирование, координацию и контроль всех этапов транспортировки товаров по железной дороге, обеспечивая эффективность и оптимизацию процесса доставки.</p>
    <p>Этот тип логистики имеет несколько преимуществ, включая более низкие затраты по сравнению с авиаперевозками и большую грузоподъемность по сравнению с дорожным транспортом. Однако время поставки в 25-30 дней может быть длительным, что может быть недостатком в случае необходимости более быстрой доставки.</p>
</div>

<div class="tab-form__info" data-tab="{{ \App\Models\Application::DELIVERY_TYPE_MARINE }}">
    <p>Морская грузоперевозка — это организация и управление перевозками грузов по морским путям. Мы включаем в этот тип логистики планирование маршрутов, загрузку и выгрузку судов, складирование грузов в портах, а также координацию документации и таможенных процедур. Морская логистика часто используется нами для международных грузоперевозок из-за ее высокой грузоподъемности и относительной экономичности на длинных дистанциях.</p>
</div>

<div class="tab-form__info" data-tab="{{ \App\Models\Application::DELIVERY_TYPE_ALL }}">
    <p>Мультимодальная грузоперевозка — это подход, при котором мы  используем несколько видов транспорта (например, железнодорожный, морской, дорожный) для оптимизации маршрута и снижения затрат. Это позволяет более эффективно использовать различные виды транспорта, сокращая время доставки и общие расходы наших клиентов на логистику.</p>
</div>
