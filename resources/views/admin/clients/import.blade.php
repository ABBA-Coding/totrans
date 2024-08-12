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
                            <li class="breadcrumb-item"><a href="{{ route('admin.clients.index') }}">Клиенты </a></li>
                            <li class="breadcrumb-item"><a href="javascript:">Импорт</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->

        <form action="{{ route('admin.clients.import-post') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="row">
                <div class="col-md-8">

                    <div class="card">
                        <div class="card-body">
                            <div id="f1" class="fm-field"> <x-filemanager-field name="file_id" label="Фото" id="f1"></x-filemanager-field> </div>

                            <div class="form-group">
                                <a href="/clients_import.xlsx" download="Шаблон" class="btn-link">Скачать шаблон</a>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Импорт</button>
                </div>
            </div>
        </form>
    </div>
@endsection
