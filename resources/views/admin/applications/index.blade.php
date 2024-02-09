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
                                    <li class="breadcrumb-item"><a href="javascript:">Заказы</a></li>
                                </ul>
                            </div>
                            <a href="{{ route('admin.applications.create') }}" class="btn btn-primary mr-0">Добавить</a>
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
                                    <th>пользователь</th>
                                    <th>номер телефона</th>
                                    <th>точка А</th>
                                    <th>точка Б</th>
                                    <th>время создание</th>
                                    <th>партия</th>
                                    <th class="w-150p">статус</th>
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
                                                {{ $item->user->name }}<br>

                                                ({{ $item->user->login }})
                                            </td>
                                            <td>
                                                {{ $item->user->phone ?? '-'}}
                                            </td>
                                            <td>
                                                {{ $item->pointA->country->name_ru }}<br>({{ $item->pointA->name_ru }})
                                            </td>
                                            <td>
                                                {{ $item->pointB->country->name_ru }}<br>({{ $item->pointB->name_ru }})
                                            </td>
                                            <td>
                                                {{ \Carbon\Carbon::createFromTimestamp($item->order_date)->format('d-m-Y') }}
                                            </td>
                                            <td>
                                                {{ $item->batch->batch_number }}
                                            </td>
                                            <td>
                                                <span class="btn-status btn-status-warning">{{ $item->batch->state->title_ru }}</span>
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.applications.edit', ['id' => $item->id]) }}"
                                                   class="label theme-bg text-white f-12 mb-0">Изменить
                                                </a>
                                                <a
                                                    href="{{ route('admin.applications.destroy', ['id' => $item->id]) }}"
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
