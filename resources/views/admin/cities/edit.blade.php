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
                            <li class="breadcrumb-item"><a href="{{ route('admin.countries.index') }}">{{$country->name_ru}}</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.cities.index', ['country_id' => $country->id]) }}">Городы</a></li>
                            <li class="breadcrumb-item"><a href="javascript:">Изменить</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->

        <form action="{{ route('admin.cities.update', ['country_id' => $country->id, 'id' => $data->id]) }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}

            <input type="hidden" name="country_id" value="{{ $country->id }}">

            <div class="row">
                <div class="col-md-8">

                    <div class="card">
                        <div class="card-body">
                            <!------ title ------>
                            <div class="form-group">
                                <label>наименование (ру)</label>
                                <input type="text"
                                       name="name_ru"
                                       class="form-control"
                                       value="{{ old('name_ru') ?? $data->name_ru }}"
                                       autocomplete="off"
                                       title="">
                            </div>

                            <!------ title ------>
                            <div class="form-group">
                                <label>наименование (uz)</label>
                                <input type="text"
                                       name="name_uz"
                                       class="form-control"
                                       value="{{ old('name_uz') ?? $data->name_uz }}"
                                       autocomplete="off"
                                       title="">
                            </div>

                            <!------ title ------>
                            <div class="form-group">
                                <label>наименование (en)</label>
                                <input type="text"
                                       name="name_en"
                                       class="form-control"
                                       value="{{ old('name_en') ?? $data->name_en }}"
                                       autocomplete="off"
                                       title="">
                            </div>

                            <!------ transport_price ------>
                            <div class="form-group">
                                <label>Цена транспорта ($)</label>
                                <input type="number"
                                       name="transport_price"
                                       class="form-control"
                                       value="{{ old('transport_price') ?? $data->transport_price }}"
                                       autocomplete="off"
                                       title="">
                            </div>

                            <!------ status ------>
                            <div class="form-group form-check mb-0">
                                <input type="hidden" name="status" value="off">
                                <input type="checkbox" class="form-check-input" id="statusLabel" name="status" {{ $data->status ? 'checked' : '' }}>
                                <label class="form-check-label" for="statusLabel">Статус</label>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>

            </div>
        </form>
    </div>
@endsection
