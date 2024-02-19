@extends('admin.layout.master')

@section('section')
    <div class="pcoded-inner-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row">
                    <div class="col-md-12">
                        <div class="page-header-title">
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.applications.index') }}">Заказы</a></li>
                            <li class="breadcrumb-item"><a href="javascript:">Создать</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->

        <form action="{{ route('admin.applications.store') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <!------ users ------>
                            <div class="form-group">
                                <label>Пользователь</label>
                                <select class="select2_with_search admin-form-control" name="user_id"
                                        title="">
                                    <option value=""></option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">
                                            {{ $user->name }} (#{{ $user->login }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!------ delivery_type ------>
                            <div class="form-group">
                                <label>Вид карго</label>
                                <select class="select2_with_search admin-form-control" name="delivery_type"
                                        title="">
                                    <option value="{{ \App\Models\Application::DELIVERY_TYPE_AUTO }}">{{ \App\Models\Application::getDeliveryTypeLabel(\App\Models\Application::DELIVERY_TYPE_AUTO) }}</option>
                                    <option value="{{ \App\Models\Application::DELIVERY_TYPE_AIR }}">{{ \App\Models\Application::getDeliveryTypeLabel(\App\Models\Application::DELIVERY_TYPE_AIR) }}</option>
                                    <option value="{{ \App\Models\Application::DELIVERY_TYPE_TRAIN }}">{{ \App\Models\Application::getDeliveryTypeLabel(\App\Models\Application::DELIVERY_TYPE_TRAIN) }}</option>
                                    <option value="{{ \App\Models\Application::DELIVERY_TYPE_MARINE }}">{{ \App\Models\Application::getDeliveryTypeLabel(\App\Models\Application::DELIVERY_TYPE_MARINE) }}</option>
                                    <option value="{{ \App\Models\Application::DELIVERY_TYPE_ALL }}">{{ \App\Models\Application::getDeliveryTypeLabel(\App\Models\Application::DELIVERY_TYPE_ALL) }}</option>
                                </select>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <!------ point A ------>
                                    <div class="form-group">
                                        <label>Точка А</label>
                                        <select class="select2_with_search admin-form-control" name="point_a_id"
                                                title="">
                                            <option value=""></option>
                                            @foreach($countries as $country)
                                                @if($country->type == \App\Models\Country::POINT_A)
                                                <optgroup label="{{ $country->name_ru }}">
                                                    @foreach($country->cities as $city)
                                                        <option value="{{ $city->id }}">
                                                            {{ $city->name_ru }}
                                                        </option>
                                                    @endforeach
                                                </optgroup>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <!------ point B ------>
                                    <div class="form-group">
                                        <label>Точка Б</label>
                                        <select class="select2_with_search admin-form-control" name="point_b_id"
                                                title="">
                                            <option value=""></option>
                                            @foreach($countries as $country)
                                                @if($country->type == \App\Models\Country::POINT_B)
                                                <optgroup label="{{ $country->name_ru }}">
                                                    @foreach($country->cities as $city)
                                                        <option value="{{ $city->id }}">
                                                            {{ $city->name_ru }}
                                                        </option>
                                                    @endforeach
                                                </optgroup>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!------ activities ------>
                            <div class="form-group">
                                <label>Сфера деятельности</label>
                                <select class="select2_with_search admin-form-control" name="activity_id"
                                        title="">
                                    <option value=""></option>
                                    @foreach($activities as $activity)
                                        <option value="{{ $activity->id }}">
                                            {{ $activity->title_ru }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!------ batch_id ------>
                            <div class="form-group mb-0">
                                <label>Партия</label>
                                <select class="select2_with_search admin-form-control" name="batch_id"
                                        title="">
                                    <option value=""></option>
                                    @foreach($batches as $batch)
                                        <option value="{{ $batch->id }}" {{ $batch->status !== \App\Models\Batch::STATUS_WAITING ? 'disabled' : '' }}>
                                            {{ $batch->batch_number }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <!------ date ------>
                            <div class="form-group">
                                <label>Дата заказа</label>
                                <input type="text"
                                       class="form-control air-datepicker"
                                       name="order_date"
                                       value="{{ old('order_date') ?? '' }}"
                                       placeholder="дата заказа"
                                       autocomplete="off"
                                       title="">
                            </div>

                            <!------ price ------>
                            <div class="form-group">
                                <label>Цена перевозки</label>
                                <input type="text"
                                       class="form-control"
                                       name="price"
                                       value="{{ old('price') ?? '' }}"
                                       placeholder="цена перевозки"
                                       autocomplete="off"
                                       title="">
                            </div>

                            <!------ seats_number ------>
                            <div class="form-group">
                                <label>Количество мест</label>
                                <input type="text"
                                       class="form-control"
                                       name="seats_number"
                                       value="{{ old('seats_number') ?? '' }}"
                                       placeholder="транспорт"
                                       autocomplete="off"
                                       title="">
                            </div>
                            <!------ mileage ------>
                            <div class="form-group">
                                <label>Километраж</label>
                                <input type="text"
                                       class="form-control"
                                       name="mileage"
                                       value="{{ old('mileage') ?? '' }}"
                                       placeholder="км"
                                       autocomplete="off"
                                       title="">
                            </div>

                            <!------ volume ------>
                            <div class="form-group">
                                <label>Обьем груза</label>
                                <input type="text"
                                       class="form-control"
                                       name="volume"
                                       value="{{ old('volume') ?? '' }}"
                                       placeholder="м3"
                                       autocomplete="off"
                                       title="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
