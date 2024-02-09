<div class="sidebar">
    <div class="sidebar-wrapper">
        <div class="sidebar-user">
            <div class="sidebar-user__img">
                <img src="/frontend/images/icon/user.svg" alt="" />
            </div>
            <div class="sidebar-user__name">{{ \Illuminate\Support\Facades\Auth::user()->name }}</div>
        </div>

        <ul class="siderbar-list">
            <li>
                <a href="{{ route('profile.home') }}" class="sidebar-link">
                    <img src="/frontend/images/icon/sidebar1.svg" alt="" />
                    <span>{{ __('static.Главная') }}</span>
                </a>
            </li>
            <li>
                <a href="{{ route('profile.orders') }}" class="sidebar-link">
                    <img src="/frontend/images/icon/sidebar2.svg" alt="" />
                    <span>{{ __('static.Мои заказы') }}</span>
                </a>
            </li>
            <li>
                <a href="{{ route('profile.settings') }}" class="sidebar-link">
                    <img src="/frontend/images/icon/sidebar3.svg" alt="" />
                    <span>{{ __('static.Настройки аккаунта') }}</span>
                </a>
            </li>
        </ul>
    </div>

    <button class="sidebar-exit" onclick="getElementById('logout-form').submit()">
        <img src="/frontend/images/icon/logout.svg" alt="" />
        <span>{{ __('static.Выйти') }}</span>
    </button>
    <form id="logout-form" action="{{ route('profile.logout') }}" method="post" hidden>{{ csrf_field() }}</form>
</div>
