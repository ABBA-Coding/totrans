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
                            <li class="breadcrumb-item"><a href="javascript:">Настройки сайта</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->

        <form action="{{ route('admin.settings.update', ['id'=>$data->id]) }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">

                            <div id="f1" class="fm-field"> <x-filemanager-field name="logo_id" label="Logotip" id="f1" value="{{ $data->logo_id }}"></x-filemanager-field> </div>

                            <div id="f2" class="fm-field"> <x-filemanager-field name="favicon_id" label="Favicon" id="f2" value="{{ $data->favicon_id }}"></x-filemanager-field> </div>

                            <div class="row">
                                <div class="col-6">
                                    <!------ email ------>
                                    <div class="form-group">
                                        <label>Почта 1</label>
                                        <input type="email"
                                               class="form-control"
                                               name="email"
                                               value="{{ old('email') ?? $data->{'email'} }}"
                                               autocomplete="off"
                                               title="">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <!------ email ------>
                                    <div class="form-group">
                                        <label>Почта 2</label>
                                        <input type="email"
                                               class="form-control"
                                               name="email2"
                                               value="{{ old('email2') ?? $data->{'email2'} }}"
                                               autocomplete="off"
                                               title="">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <!------ phone ------>
                                    <div class="form-group">
                                        <label>Телефон 1</label>
                                        <input type="text"
                                               class="form-control"
                                               name="phone"
                                               value="{{ old('phone') ?? $data->{'phone'} }}"
                                               autocomplete="off"
                                               title="">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <!------ phone ------>
                                    <div class="form-group">
                                        <label>Телефон 2</label>
                                        <input type="text"
                                               class="form-control"
                                               name="phone2"
                                               value="{{ old('phone2') ?? $data->{'phone2'} }}"
                                               autocomplete="off"
                                               title="">
                                    </div>
                                </div>
                            </div>

                            <!------ facebook ------>
                            <div class="form-group">
                                <label>Facebook</label>
                                <input type="text"
                                       class="form-control"
                                       name="facebook"
                                       value="{{ old('facebook') ?? $data->{'facebook'} }}"
                                       autocomplete="off"
                                       title="">
                            </div>

                            <!------ instagram ------>
                            <div class="form-group">
                                <label>Instagram</label>
                                <input type="text"
                                       class="form-control"
                                       name="instagram"
                                       value="{{ old('instagram') ?? $data->{'instagram'} }}"
                                       autocomplete="off"
                                       title="">
                            </div>

                            <!------ telegram ------>
                            <div class="form-group">
                                <label>Telegram</label>
                                <input type="text"
                                       class="form-control"
                                       name="telegram"
                                       value="{{ old('telegram') ?? $data->{'telegram'} }}"
                                       autocomplete="off"
                                       title="">
                            </div>

                            <!------ map_iframe ------>
                            <div class="form-group">
                                <label>Google Map & Yandex Map (Iframe)</label>

                                <textarea class="form-control"
                                          name="map_iframe"
                                          style="min-height: 210px"
                                          title="">{{ old('map_iframe') ?? $data->{'map_iframe'} }}</textarea>
                            </div>

                            <!------ meta_tags ------>
                            <div class="form-group">
                                <label>Мета Теги</label>
                                <textarea class="form-control"
                                          name="meta_tags"
                                          style="min-height: 410px"
                                          title="">{{ old('meta_tags') ?? $data->{'meta_tags'} }}</textarea>
                            </div>

                            <!------ coming_soon ------>
                            <div class="form-group form-check mb-0 mr-20">
                                <input type="hidden" name="coming_soon" value="off">
                                <input type="checkbox" class="form-check-input" id="comingSoonLabel" name="coming_soon" {{ $data->coming_soon ? 'checked' : '' }}>
                                <label class="form-check-label" for="comingSoonLabel">Coming Soon</label>
                            </div>

                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>
                <div class="col-md-6">

                    @include('admin.parts.nav-lang')

                    @php
                        $locales = config('env.LOCALES');
                    @endphp

                    <div class="tab-content" id="pills-tabContent">
                        @foreach($locales as $key => $locale)
                            <div class="tab-pane fade {{ $locale == 2 ? 'show active' : '' }}" id="pills-{{ $key }}" role="tabpanel" aria-labelledby="pills-{{ $key }}-tab">

                                <!------ address ------>
                                <div class="form-group">
                                    <label>Адрес ({{ $key }})</label>
                                    <textarea class="form-control"
                                              name="address[{{ $key }}]"
                                              title="">{{ old('address')[$key] ?? @$data->address[$key] }}</textarea>
                                </div>

                                <!------ meta_title ------>
                                <div class="form-group">
                                    <label>Мета заголовок ({{ $key }})</label>
                                    <input type="text"
                                           class="form-control"
                                           name="meta_title[{{$key}}]"
                                           value="{{ old('meta_title')[$key] ?? @$data->meta_title[$key] }}"
                                           title=""
                                           autocomplete="off">
                                </div>
                                <!------ meta_description ------>
                                <div class="form-group">
                                    <label>Мета описание ({{ $key }})</label>
                                    <textarea class="form-control"
                                              name="meta_description[{{ $key }}]"
                                              title="">{{ old('meta_description')[$key] ?? @$data->meta_description[$key] }}</textarea>
                                </div>
                                <!------ meta_keywords ------>
                                <div class="form-group">
                                    <label>Мета ключевые слова ({{ $key }})</label>
                                    <textarea class="form-control"
                                              name="meta_keywords[{{ $key }}]"
                                              title="">{{ old('meta_keywords')[$key] ?? @$data->meta_keywords[$key] }}</textarea>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
