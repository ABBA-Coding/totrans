@extends('admin.layout.auth')

@section('section')
    <div class="card">
        <div class="card-body text-center">
            <form action="{{ route('admin.forgot-password.post') }}" method="post">
                {{ csrf_field() }}
                <div class="mb-4">
                    <i class="feather icon-mail auth-icon"></i>
                </div>
                <h3 class="mb-4">Сброс пароля</h3>
                <div class="input-group mb-3">
                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                </div>
                <button class="btn btn-primary shadow-2 mb-4">Сброс пароля</button>
                <p class="mb-2 text-muted">Уже есть аккаунт? <a href="{{ route('admin.login.show') }}">Авторизоваться</a></p>
                <p class="mb-0 text-muted">У вас нет аккаунта? <a href="{{ route('admin.register.show') }}">Зарегистрироваться</a></p>
            </form>
        </div>
    </div>
@endsection
