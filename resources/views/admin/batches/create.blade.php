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
                            <li class="breadcrumb-item"><a href="{{ route('admin.batches.index') }}">Партии</a></li>
                            <li class="breadcrumb-item"><a href="javascript:">Создать</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->

        <form action="{{ route('admin.batches.store') }}" method="post" enctype="multipart/form-data">
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
                                       value="{{ old('batch_number') ?? '' }}"
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
                                                <option value="{{ $innerState->id }}">
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
                                    <option value="{{ \App\Models\Batch::STATUS_WAITING }}">В ожидание</option>
                                    <option value="{{ \App\Models\Batch::STATUS_PROCESSING }}">В процессе</option>
                                    <option value="{{ \App\Models\Batch::STATUS_COMPLETED }}">Завершено</option>
                                    <option value="{{ \App\Models\Batch::STATUS_REJECTED }}">Отклонено</option>
                                </select>
                            </div>

                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>

            </div>
        </form>
    </div>
@endsection
