@extends('admin.layout.auth')

@section('section')
    <div class="card">
        <div class="card-body text-center">
            <form action="{{ route('admin.register.post') }}" method="post">
                {{ csrf_field() }}
                <div class="mb-4">
                    <i class="feather icon-user-plus auth-icon"></i>
                </div>
                <h3 class="mb-4">Зарегистрироваться</h3>
                <div class="input-group mb-3">
                    <input type="text" name="name" class="form-control" placeholder="Имя" required>
                </div>
                <div class="input-group mb-4">
                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                </div>
                <div class="input-group mb-4">
                    <input type="password" name="password" class="form-control" placeholder="Пароль" required>
                </div>
                <div class="input-group mb-4">
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Повторите пароль" required>
                </div>
                <button class="btn btn-primary shadow-2 mb-4">Зарегистрироваться</button>
                <p class="mb-2 text-muted">Забыл пароль? <a href="{{ route('admin.forgot-password.show') }}">Сброс</a></p>
                <p class="mb-0 text-muted">Уже есть аккаунт? <a href="{{ route('admin.login.show') }}">Авторизоваться</a></p>
            </form>
        </div>
    </div>
@endsection
