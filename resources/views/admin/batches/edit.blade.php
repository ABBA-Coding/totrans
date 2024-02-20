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
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}"><i
                                        class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.batches.index') }}">Партии</a></li>
                            <li class="breadcrumb-item"><a href="javascript:">Изменить</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->

        <form action="{{ route('admin.batches.update', ['id' => $data->id]) }}" method="post"
              enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="row">
                <div class="col-md-8">

                    <div class="card">
                        <div class="card-body">
                            <!------ title ------>
                            <div class="form-group">
                                <label>Номер партии</label>
                                <input type="text"
                                       name="batch_number"
                                       class="form-control"
                                       value="{{ old('batch_number') ?? $data->batch_number }}"
                                       autocomplete="off"
                                       data-field-type="batch_number"
                                       title="">
                            </div>

                            <!------ states ------>
                            <div class="form-group">
                                <label>Состояние</label>
                                <select class="select2_with_search admin-form-control" name="state_id"
                                        title="">
                                    <option value=""></option>
                                    @foreach($states as $state)
                                        <optgroup label="{{ $state->title_ru }}">
                                            @foreach($state->children as $innerState)
                                                <option
                                                    value="{{ $innerState->id }}" {{ $innerState->id == $data->state_id ? 'selected' : '' }}>
                                                    {{ $innerState->title_ru }}
                                                </option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mb-0">
                                <label>Статус</label>
                                <select class="select2_with_search admin-form-control" name="status"
                                        title="">
                                    <option value="{{ \App\Models\Batch::STATUS_WAITING }}"
                                        {{ $data->status == \App\Models\Batch::STATUS_WAITING ? 'selected' : ''}}>
                                        В ожидание
                                    </option>
                                    <option value="{{ \App\Models\Batch::STATUS_PROCESSING }}"
                                        {{ $data->status == \App\Models\Batch::STATUS_PROCESSING ? 'selected' : ''}}>
                                        В процессе
                                    </option>
                                    <option value="{{ \App\Models\Batch::STATUS_COMPLETED }}"
                                        {{ $data->status == \App\Models\Batch::STATUS_COMPLETED ? 'selected' : ''}}>
                                        Завершено
                                    </option>
                                    <option value="{{ \App\Models\Batch::STATUS_REJECTED }}"
                                        {{ $data->status == \App\Models\Batch::STATUS_REJECTED ? 'selected' : ''}}>
                                        Отклонено
                                    </option>
                                </select>
                            </div>

                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>

            </div>
        </form>

        <form action="{{ route('admin.batches.transfer', ['id' => $data->id]) }}" method="POST" class="position-relative">
            {!! csrf_field() !!}
            <button type="submit" class="transfer-circle"></button>
            <div class="row mt-4">
                <div class="col-6">
                    <h5 class="b-title">входит в партию </h5>
                    <div class="card mb-0">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>№</th>
                                <th>пользователь</th>
                                <th>номер телефона</th>
                                <th>точка А</th>
                                <th>точка Б</th>
                                <th>время создание</th>
                            </tr>
                            </thead>
                            @foreach($ownApplications as $ownApplication)
                                <tr>
                                    <td>
                                        <label class="d-flex align-items-center mb-0">
                                            <input class="mr-1" type="checkbox" name="own[{{ $ownApplication->id }}]" title="">
                                            {{ $ownApplication->application_number }}
                                        </label>
                                    </td>
                                    <td>
                                        {{ $ownApplication->user->name }}<br>

                                        ({{ $ownApplication->user->login }})
                                    </td>
                                    <td>
                                        {{ $ownApplication->user->phone ?? '-'}}
                                    </td>
                                    <td>
                                        {{ $ownApplication->pointA->country->name_ru }}<br>({{ $ownApplication->pointA->name_ru }})
                                    </td>
                                    <td>
                                        {{ $ownApplication->pointB->country->name_ru }}<br>({{ $ownApplication->pointB->name_ru }})
                                    </td>
                                    <td>
                                        {{ $ownApplication->order_date }}
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
                <div class="col-6">
                    <h5 class="b-title">не входит в партию </h5>
                    <div class="card mb-0">
                        <table class="table">
                            <thead>
                            <tr>
                                <th class="w-50p">№</th>
                                <th>пользователь</th>
                                <th>номер телефона</th>
                                <th>точка А</th>
                                <th>точка Б</th>
                                <th>время создание</th>
                            </tr>
                            </thead>
                            @foreach($otherApplications as $otherApplication)
                                <tr>
                                    <td>
                                        <label class="d-flex align-items-center mb-0">
                                            <input class="mr-1" type="checkbox" name="other[{{ $otherApplication->id }}]" title="">
                                            {{ $otherApplication->application_number }}
                                        </label>
                                    </td>
                                    <td>
                                        {{ $otherApplication->user->name }}<br>

                                        ({{ $otherApplication->user->login }})
                                    </td>
                                    <td>
                                        {{ $otherApplication->user->phone ?? '-'}}
                                    </td>
                                    <td>
                                        {{ $otherApplication->pointA->country->name_ru }}<br>({{ $otherApplication->pointA->name_ru }})
                                    </td>
                                    <td>
                                        {{ $otherApplication->pointB->country->name_ru }}<br>({{ $otherApplication->pointB->name_ru }})
                                    </td>
                                    <td>
                                        {{ $otherApplication->order_date }}
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </form>

    </div>
@endsection
