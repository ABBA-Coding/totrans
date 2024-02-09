@extends('admin.layout.auth')

@section('section')
<div class="card">
    <div class="card-body text-center">
        <form action="{{ route('admin.login.post') }}" method="post">
            {{ csrf_field() }}
            <div class="mb-4">
                <i class="feather icon-unlock auth-icon"></i>
            </div>
            <h3 class="mb-4">Авторизоваться</h3>
            <div class="input-group mb-3">
                <input type="email" name="email" class="form-control" placeholder="Email" title="" required autocomplete="off">
            </div>
            <div class="input-group mb-4">
                <input type="password" name="password" class="form-control" placeholder="Пароль" title="" required>
            </div>
            <button class="btn btn-primary shadow-2 mb-4">Войти</button>
        </form>
    </div>
</div>
@endsection
