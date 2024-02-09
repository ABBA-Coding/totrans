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
                            <li class="breadcrumb-item"><a href="{{ route('admin.activities.index') }}">Сфера деятельности</a></li>
                            <li class="breadcrumb-item"><a href="javascript:">Создать</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->

        <form action="{{ route('admin.activities.store') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="row">
                <div class="col-md-8">

                    <div class="card">
                        <div class="card-body">
                            <!------ title ------>
                            <div class="form-group">
                                <label>наименование (ру)</label>
                                <input type="text"
                                       name="title_ru"
                                       class="form-control"
                                       value="{{ old('title_ru') ?? '' }}"
                                       autocomplete="off"
                                       title="">
                            </div>

                            <!------ title ------>
                            <div class="form-group">
                                <label>наименование (uz)</label>
                                <input type="text"
                                       name="title_uz"
                                       class="form-control"
                                       value="{{ old('title_uz') ?? '' }}"
                                       autocomplete="off"
                                       title="">
                            </div>

                            <!------ title ------>
                            <div class="form-group">
                                <label>наименование (en)</label>
                                <input type="text"
                                       name="title_en"
                                       class="form-control"
                                       value="{{ old('title_en') ?? '' }}"
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

            </div>
        </form>
    </div>
@endsection
