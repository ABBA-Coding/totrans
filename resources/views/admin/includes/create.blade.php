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
                            <li class="breadcrumb-item"><a href="{{ route('admin.includes.index') }}">Что входит в тариф?</a></li>
                            <li class="breadcrumb-item"><a href="javascript:">Создать</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->

        <form action="{{ route('admin.includes.store') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="row">
                <div class="col-md-8">

                    @include('admin.parts.nav-lang')
                    @php
                        $locales = config('env.LOCALES');
                    @endphp

                    <div class="tab-content" id="pills-tabContent">
                        @foreach($locales as $key => $locale)
                            <div class="tab-pane fade {{ $locale == 1 ? 'show active' : '' }}" id="pills-{{ $key }}" role="tabpanel" aria-labelledby="pills-{{ $key }}-tab">

                                <!------ title ------>
                                <div class="form-group">
                                    <label>Заголовок ({{ $key }})</label>
                                    <input type="text"
                                           name="title_{{ $key }}"
                                           class="form-control"
                                           value="{{ old('title_'.$key) ?? '' }}"
                                           autocomplete="off"
                                           title="">
                                </div>

                                <!------ description ------>
                                <div class="form-group mb-0">
                                    <label>Описание ({{ $key }})</label>
                                    <textarea class="form-control"
                                              name="description_{{$key}}"
                                              title="">{!! old('description_'.$key) ?? '' !!}</textarea>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <button type="submit" class="btn btn-primary m-t-30">Сохранить</button>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">

                            <!------ sort ------>
                            <div class="form-group">
                                <label>Сортировка</label>
                                <input type="text"
                                       name="sort"
                                       class="form-control"
                                       value="{{ old('sort') ?? '' }}"
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
                </div>
            </div>
        </form>
    </div>
@endsection
