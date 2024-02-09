@extends('admin.layout.auth')

@section('section')
    <div class="card">
        <div class="card-body text-center">
            <form action="#" method="post">
                {{ csrf_field() }}
                <div class="mb-4">
                    <i class="feather icon-mail auth-icon"></i>
                </div>
                <h3 class="mb-4">Изменить пароль</h3>
                <div class="input-group mb-3">
                    <input type="email" name="email" class="form-control" value="{{ $email }}" required readonly>
                </div>
                <div class="input-group mb-4">
                    <input type="password" name="password" class="form-control" placeholder="Придумайте пароль" required>
                </div>
                <div class="input-group mb-4">
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Повторите пароль" required>
                </div>
                <button class="btn btn-primary shadow-2 mb-4">Изменить пароль</button>
            </form>
        </div>
    </div>
@endsection
