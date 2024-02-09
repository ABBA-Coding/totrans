@extends('admin.layout.master')

@section('section')
    <div class="pcoded-inner-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <div class="page-header-title">
                                </div>
                                <ul class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}"><i class="feather icon-home"></i></a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('admin.states.index') }}">{{$parent->title_ru}}</a></li>
                                    <li class="breadcrumb-item"><a href="javascript:">Внутренние состоянии</a></li>
                                </ul>
                            </div>
                            <a href="{{ route('admin.states.inner.create', ['parent_id' => $parent->id]) }}" class="btn btn-primary mr-0">Добавить</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->

        <div class="main-body">
            <div class="page-wrapper">
                <!-- [ Main Content ] start -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th class="w-50p">№</th>
                                    <th></th>
                                    <th>наименование (ру)</th>
                                    <th>наименование (uz)</th>
                                    <th>наименование (en)</th>
                                    <th>статус</th>
                                    <th class="w-200p">действие</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if (count($data) > 0)
                                    @foreach($data as $key => $item)
                                        <tr>
                                            <td>
                                                {{ ($data->currentpage()-1) * $data->perpage() + $key + 1 }}
                                            </td>
                                            <td>
                                                <img src="{{ $item->getFile('file', 'small') }}" alt="">
                                            </td>
                                            <td>
                                                {{ $item->title_ru }}
                                            </td>
                                            <td>
                                                {{ $item->title_uz }}
                                            </td>
                                            <td>
                                                {{ $item->title_en }}
                                            </td>
                                            <td>
                                                {!! $item->statusUI !!}
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.states.inner.edit', ['parent_id' => $parent->id, 'id' => $item->id]) }}"
                                                   class="label theme-bg text-white f-12 mb-0">Изменить
                                                </a>
                                                <a
                                                    href="{{ route('admin.states.inner.destroy', ['parent_id' => $parent->id, 'id' => $item->id]) }}"
                                                    onclick="confirmDelete(event,this.getAttribute('href'))"
                                                    class="label theme-bg2 text-white f-12 mb-0">
                                                    Удалить
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="6" class="text-center">
                                            Нет данные
                                        </td>
                                    </tr>
                                @endif
                                </tbody>
                                @if ($data->hasPages())
                                    <tfoot>
                                        <tr>
                                            <td colspan="6">{{ $data->appends(request()->query())->links() }}</td>
                                        </tr>
                                    </tfoot>
                                @endif
                            </table>
                        </div>
                    </div>
                </div>
                <!-- [ Main Content ] end -->
            </div>
        </div>
    </div>
@endsection
