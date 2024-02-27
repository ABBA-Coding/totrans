<nav class="pcoded-navbar">
    <div class="navbar-wrapper">
        <div class="navbar-brand header-logo">
            <a href="{{ route('admin.home') }}" class="b-brand">
                <div>
                    <img src="/admin-panel/favicon.svg" alt="" style="width: 30px;">
                </div>
                <div class="b-title">
                    {{ \Illuminate\Support\Facades\Auth::user()->name }}
                </div>
            </a>
            <a class="mobile-menu" id="mobile-collapse" href="javascript:"><span></span></a>
        </div>
        <div class="navbar-content scroll-div">
            <ul class="nav pcoded-inner-navbar">

                <li class="nav-item pcoded-menu-caption">
                    <label>Разделы</label>
                </li>


                @if(\App\User::getAuthRole() === \App\User::ROLE_ADMIN)
                    <li class="nav-item">
                        <a href="{{ route('admin.countries.index') }}" class="nav-link ">
                        <span class="pcoded-micon">
                            <i class="feather icon-flag"></i>
                        </span>
                            <span class="pcoded-mtext">Страны</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.states.index') }}" class="nav-link ">
                        <span class="pcoded-micon">
                            <i class="feather icon-tag"></i>
                        </span>
                            <span class="pcoded-mtext">Состоянии</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.includes.index') }}" class="nav-link ">
                        <span class="pcoded-micon">
                            <i class="feather icon-box"></i>
                        </span>
                            <span class="pcoded-mtext">Что входит в тариф?</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.activities.index') }}" class="nav-link ">
                        <span class="pcoded-micon">
                            <i class="feather icon-command"></i>
                        </span>
                            <span class="pcoded-mtext">Сфера деятельности</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.additional-functions.index') }}" class="nav-link ">
                        <span class="pcoded-micon">
                            <i class="feather icon-disc"></i>
                        </span>
                            <span class="pcoded-mtext">Дополнительные функции</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.batches.index') }}" class="nav-link ">
                        <span class="pcoded-micon">
                            <i class="feather icon-package"></i>
                        </span>
                            <span class="pcoded-mtext">Партии</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.managers.index') }}" class="nav-link ">
                        <span class="pcoded-micon">
                            <i class="feather icon-users"></i>
                        </span>
                            <span class="pcoded-mtext">Менеджеры</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.clients.index') }}" class="nav-link ">
                        <span class="pcoded-micon">
                            <i class="feather icon-users"></i>
                        </span>
                            <span class="pcoded-mtext">Клиенты</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.applications.index') }}" class="nav-link ">
                        <span class="pcoded-micon">
                            <i class="feather note-icon-orderedlist"></i>
                        </span>
                            <span class="pcoded-mtext">Заказы</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.feedback.index') }}" class="nav-link ">
                    <span class="pcoded-micon">
                        <i class="feather icon-mail"></i>
                    </span>
                            <span class="pcoded-mtext">Заявки</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.user.index') }}" class="nav-link ">
                        <span class="pcoded-micon">
                            <i class="feather icon-user"></i>
                        </span>
                            <span class="pcoded-mtext">Пользователи</span>
                        </a>
                    </li>

                @else
                    <li class="nav-item">
                        <a href="{{ route('admin.feedback.index') }}" class="nav-link ">
                        <span class="pcoded-micon">
                            <i class="feather icon-mail"></i>
                        </span>
                            <span class="pcoded-mtext">Заявки</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.clients.index') }}" class="nav-link ">
                        <span class="pcoded-micon">
                            <i class="feather icon-users"></i>
                        </span>
                            <span class="pcoded-mtext">Клиенты</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.applications.index') }}" class="nav-link ">
                        <span class="pcoded-micon">
                            <i class="feather note-icon-orderedlist"></i>
                        </span>
                            <span class="pcoded-mtext">Заказы</span>
                        </a>
                    </li>

                    @if(\App\User::getAuthRole() !== \App\User::ROLE_SALES)
                        <li class="nav-item">
                            <a href="{{ route('admin.batches.index') }}" class="nav-link ">
                                <span class="pcoded-micon">
                                    <i class="feather icon-package"></i>
                                </span>
                                <span class="pcoded-mtext">Партии</span>
                            </a>
                        </li>
                    @endif
                @endif

                <li class="nav-item pcoded-menu-caption">
                    <label>Действии</label>
                </li>


                <li class="nav-item">
                    <a href="javascript:" onclick="getElementById('logout-form').submit()" class="nav-link ">
                        <span class="pcoded-micon">
                            <i class="feather icon-power"></i>
                        </span>
                        <span class="pcoded-mtext">Выйти</span>
                    </a>
                    <form id="logout-form" action="{{ route('admin.logout') }}" method="post"
                          hidden>{{ csrf_field() }}</form>
                </li>
            </ul>
        </div>
    </div>
</nav>
