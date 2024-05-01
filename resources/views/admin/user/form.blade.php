@if($data->id)

    @php
        $isClient = $data->role->role == "client";
    @endphp

    <form action="{{ route('admin.user.post', ['id'=>$data->id]) }}" method="post">
        <div class="modal-message">
        {!! csrf_field() !!}

        <input type="hidden" name="role" value="{{ $data->role->role }}">

        <!------ name ------>
            <div class="form-group">
                <label>Имя</label>
                <input type="text"
                       class="form-control"
                       name="name"
                       value="{{ $data->name }}"
                       {{ $isClient ? 'readonly' : ''}}
                       autocomplete="off"
                       title="">
            </div>
            <!------ email ------>
            <div class="form-group">
                <label>Email</label>
                <input type="text"
                       class="form-control"
                       name="email"
                       value="{{ $data->email }}"
                       {{ $isClient ? 'readonly' : ''}}
                       autocomplete="off"
                       title="">
            </div>
            @if($data->role->role !== \App\User::ROLE_ADMIN)
            <!------ role ------>
            <div class="form-group">
                <label>Роль</label>
                <select class="form-control select2" name="role" title="">
                    <option value="{{ \App\User::ROLE_LOGIST }}" {{ $data->role->role == \App\User::ROLE_LOGIST ? 'selected' : '' }}>Logist</option>
                    <option value="{{ \App\User::ROLE_SALES }}" {{ $data->role->role == \App\User::ROLE_SALES ? 'selected' : '' }}>Sales Manager</option>
                    <option value="{{ \App\User::ROLE_MANAGER }}" {{ $data->role->role == \App\User::ROLE_MANAGER ? 'selected' : '' }}>Manager</option>
                </select>
            </div>
            @endif
            <!------ password ------>
            <div class="form-group">
                <label>Пароль (если не нужно менять пароль, тогда оставляйте это поле пустым)</label>
                <input type="text"
                       class="form-control"
                       name="password"
                       value=""
                       autocomplete="off"
                       title="">
            </div>
        </div>

        <div class="modal-footer pr-0">
            <button type="submit" class="btn btn-primary">Сохранить</button>
            <button type="button" class="btn btn-secondary mr-0">Отмена</button>
        </div>
    </form>
@else
    <form action="{{ route('admin.user.post') }}" method="post">
        <div class="modal-message">
        {!! csrf_field() !!}
        <!------ name ------>
            <div class="form-group">
                <label>Имя</label>
                <input type="text"
                       class="form-control"
                       name="name"
                       value=""
                       autocomplete="off"
                       title="">
            </div>
            <!------ email ------>
            <div class="form-group">
                <label>Email</label>
                <input type="text"
                       class="form-control"
                       name="email"
                       value="{{ $data->email }}"
                       autocomplete="off"
                       title="">
            </div>
            <!------ role ------>
            <div class="form-group">
                <label>Роль</label>
                <select class="form-control select2" name="role" title="">
                    <option value="{{ \App\User::ROLE_LOGIST }}">Logist</option>
                    <option value="{{ \App\User::ROLE_SALES }}">Sales Manager</option>
                    <option value="{{ \App\User::ROLE_MANAGER }}">Manager</option>
                </select>
            </div>
            <!------ password ------>
            <div class="form-group">
                <label>Пароль</label>
                <input type="text"
                       class="form-control"
                       name="password"
                       value=""
                       autocomplete="off"
                       title="">
            </div>
        </div>

        <div class="modal-footer pr-0">
            <button type="submit" class="btn btn-primary">Сохранить</button>
            <button type="button" class="btn btn-secondary mr-0">Отмена</button>
        </div>
    </form>
@endif


