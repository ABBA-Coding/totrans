@if($data->id)


    <form action="{{ route('admin.clients.post', ['id'=>$data->id]) }}" method="post">
        <div class="modal-message">
        {!! csrf_field() !!}

            <div class="row">
                <div class="col-6">
                    <!------ name ------>
                    <div class="form-group">
                        <label>Имя</label>
                        <input type="text"
                               class="form-control"
                               name="name"
                               value="{{ $data->name }}"
                               autocomplete="off"
                               required
                               title="">
                    </div>
                </div>
                <div class="col-6">
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
                </div>
            </div>

            <div class="row">
                <div class="col-6">
                    <!------ phone ------>
                    <div class="form-group">
                        <label>Номер телефона</label>
                        <input type="text"
                               class="form-control"
                               name="phone"
                               value="{{ $data->phone }}"
                               autocomplete="off"
                               data-field-type="phone"
                               required
                               title="">
                    </div>
                </div>
                <div class="col-6">
                    <!------ company_name ------>
                    <div class="form-group">
                        <label>Наименование компании</label>
                        <input type="text"
                               class="form-control"
                               name="company_name"
                               value="{{ $data->company_name }}"
                               autocomplete="off"
                               required
                               title="">
                    </div>
                </div>
            </div>

            <!------ activities ------>
            <div class="form-group">
                <label>Сфера деятельности</label>
                <select required class="select2_with_search admin-form-control" name="activity_id"
                        title="">
                    <option value=""></option>
                    @foreach($activities as $activity)
                        <option value="{{ $activity->id }}" {{ $activity->id == $data->activity_id ? 'selected' : '' }}>
                            {{ $activity->title_ru }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!------ managers ------>
            <div class="form-group">
                <label>Менеджер</label>
                <select required class="select2_with_search admin-form-control" name="manager_id"
                        title="">
                    <option value=""></option>
                    @foreach($managers as $manager)
                        <option value="{{ $manager->id }}" {{ $manager->id == $data->manager_id ? 'selected' : '' }}>
                            {{ $manager->name_ru }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!------ district ------>
            <div class="form-group">
                <label>Регион</label>
                <select required class="select2_with_search admin-form-control" name="district_id"
                        title="">
                    <option value=""></option>
                    @foreach($districts as $district)
                        <option value="{{ $district->id }}" {{ $district->id == $data->district_id ? 'selected' : '' }}>
                            {{ $district->name_ru }}
                        </option>
                    @endforeach
                </select>
            </div>

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
    <form action="{{ route('admin.clients.post') }}" method="post">
        <div class="modal-message">
        {!! csrf_field() !!}
            <!------ role ------>
            <input type="hidden" name="role" value="{{ \App\User::ROLE_CLIENT }}">

            <div class="row">
                <div class="col-6">
                    <!------ name ------>
                    <div class="form-group">
                        <label>Имя</label>
                        <input type="text"
                               class="form-control"
                               name="name"
                               value=""
                               autocomplete="off"
                               required
                               title="">
                    </div>
                </div>
                <div class="col-6">
                    <!------ email ------>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text"
                               class="form-control"
                               name="email"
                               value=""
                               autocomplete="off"
                               title="">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-6">
                    <!------ phone ------>
                    <div class="form-group">
                        <label>Номер телефона</label>
                        <input type="text"
                               class="form-control"
                               name="phone"
                               value=""
                               autocomplete="off"
                               data-field-type="phone"
                               required
                               title="">
                    </div>
                </div>

                <div class="col-6">
                    <!------ company_name ------>
                    <div class="form-group">
                        <label>Наименование компании</label>
                        <input type="text"
                               class="form-control"
                               name="company_name"
                               value=""
                               autocomplete="off"
                               required
                               title="">
                    </div>
                </div>
            </div>


            <!------ activities ------>
            <div class="form-group">
                <label>Сфера деятельности</label>
                <select required class="select2_with_search admin-form-control" name="activity_id"
                        title="">
                    <option value=""></option>
                    @foreach($activities as $activity)
                    <option value="{{ $activity->id }}">
                        {{ $activity->title_ru }}
                    </option>
                    @endforeach
                </select>
            </div>

            <!------ managers ------>
            <div class="form-group">
                <label>Менеджер</label>
                <select required class="select2_with_search admin-form-control" name="manager_id"
                        title="">
                    <option value=""></option>
                    @foreach($managers as $manager)
                        <option value="{{ $manager->id }}">
                            {{ $manager->name_ru }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!------ district ------>
            <div class="form-group">
                <label>Регион</label>
                <select required class="select2_with_search admin-form-control" name="district_id"
                        title="">
                    <option value=""></option>
                    @foreach($districts as $district)
                        <option value="{{ $district->id }}">
                            {{ $district->name_ru }}
                        </option>
                    @endforeach
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
                       required
                       title="">
            </div>
        </div>

        <div class="modal-footer pr-0">
            <button type="submit" class="btn btn-primary">Сохранить</button>
            <button type="button" class="btn btn-secondary mr-0">Отмена</button>
        </div>
    </form>
@endif


