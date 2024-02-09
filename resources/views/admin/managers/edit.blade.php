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
                            <li class="breadcrumb-item"><a href="{{ route('admin.managers.index') }}">Менеджеры </a></li>
                            <li class="breadcrumb-item"><a href="javascript:">Изменить</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->

        <form action="{{ route('admin.managers.update', ['id' => $data->id]) }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="row">
                <div class="col-md-8">

                    <div class="card">
                        <div class="card-body">
                            <!------ title ------>
                            <div class="form-group">
                                <label>имя (ру)</label>
                                <input type="text"
                                       name="name_ru"
                                       class="form-control"
                                       value="{{ old('name_ru') ?? $data->name_ru }}"
                                       autocomplete="off"
                                       title="">
                            </div>

                            <!------ title ------>
                            <div class="form-group">
                                <label>имя (uz)</label>
                                <input type="text"
                                       name="name_uz"
                                       class="form-control"
                                       value="{{ old('name_uz') ?? $data->name_uz }}"
                                       autocomplete="off"
                                       title="">
                            </div>

                            <!------ title ------>
                            <div class="form-group mb-0">
                                <label>имя (en)</label>
                                <input type="text"
                                       name="name_en"
                                       class="form-control"
                                       value="{{ old('name_en') ?? $data->name_en }}"
                                       autocomplete="off"
                                       title="">
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div id="f1" class="fm-field"> <x-filemanager-field name="file_id" label="Фото" id="f1" value="{{ $data->file_id }}"></x-filemanager-field> </div>

                            <!------ phone ------>
                            <div class="form-group">
                                <label>номер телефона</label>
                                <input type="text"
                                       name="phone"
                                       class="form-control"
                                       value="{{ old('phone') ?? $data->phone }}"
                                       autocomplete="off"
                                       title="">
                            </div>

                            <!------ telegram ------>
                            <div class="form-group mb-0">
                                <label>телеграм</label>
                                <input type="text"
                                       name="telegram"
                                       class="form-control"
                                       value="{{ old('telegram') ?? $data->telegram }}"
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
