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
                            <li class="breadcrumb-item"><a href="{{ route('admin.countries.index') }}">Страны</a></li>
                            <li class="breadcrumb-item"><a href="javascript:">Создать</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->

        <form action="{{ route('admin.countries.store') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}

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
                                       value="{{ old('name_ru') ?? '' }}"
                                       autocomplete="off"
                                       title="">
                            </div>

                            <!------ title ------>
                            <div class="form-group">
                                <label>наименование (uz)</label>
                                <input type="text"
                                       name="name_uz"
                                       class="form-control"
                                       value="{{ old('name_uz') ?? '' }}"
                                       autocomplete="off"
                                       title="">
                            </div>

                            <!------ title ------>
                            <div class="form-group">
                                <label>наименование (en)</label>
                                <input type="text"
                                       name="name_en"
                                       class="form-control"
                                       value="{{ old('name_en') ?? '' }}"
                                       autocomplete="off"
                                       title="">
                            </div>

                            <!------ status ------>
                            <div class="form-group form-check mb-0">
                                <input type="hidden" name="status" value="off">
                                <input type="checkbox" class="form-check-input" id="statusLabel" name="status" checked>
                                <label class="form-check-label" for="statusLabel">Статус</label>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <!------ directions ------>
                            <div class="form-group mb-0">
                                <label>Что входить в тариф?</label>
                                <select class="select2_with_search admin-form-control" name="includes[]"
                                        title="" multiple>
                                    @if(count($includes) > 0)
                                        @foreach($includes as $include)
                                            <option value="{{ $include->id }}">{{ $include->title_ru }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>
@endsection
