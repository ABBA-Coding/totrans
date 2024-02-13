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
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}"><i class="feather icon-home"></i></a></li>
                                    <li class="breadcrumb-item"><a href="javascript:">Пользователи</a></li>
                                </ul>
                            </div>
                            <a href="{{ route('admin.user.form') }}" class="btn btn-primary mr-0" onclick="updateUser(event, null)">Добавить</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <form action="" method="get" id="tableForm"></form>

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
                                    <th>имя</th>
                                    <th>email</th>
                                    <th>роль</th>
                                    <th>дата регистрации</th>
                                    <th class="w-100p">действие</th>
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
                                                {{ $item->name }}
                                            </td>
                                            <td>
                                                {{ $item->email ?? '--' }}
                                            </td>
                                            <td>
                                                {{ $item->role->role ?? '--' }}
                                            </td>
                                            <td>
                                                {{ $item->created_at->format('d.m.Y / H:i:s') }}
                                            </td>
                                            <td>
                                                <a href="javascript:"
                                                   onclick="updateUser(event, {{ $item->id }})"
                                                   class="label theme-bg text-white f-12 w-100 mb-0">Изменить
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="100" class="text-center">
                                            Нет данные
                                        </td>
                                    </tr>
                                @endif
                                </tbody>
                                @if ($data->hasPages())
                                    <tfoot>
                                        <tr>
                                            <td colspan="100">{{ $data->appends(request()->query())->links() }}</td>
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

@section('scripts')
    <script>
        function updateUser (event, id) {
            event.preventDefault();

            let modal = $('#update-user');
            modal.empty().append('<div class="loader-ui loader-ui--triangle">Loading...</div>');

            callModal('update-user');

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('admin.user.form') }}",
                method: 'get',
                dataType: 'json',
                data: {user_id: id},
                success: function (data) {
                    if (data.view) {
                        modal.empty().append(data.view);
                    }
                    modal.find('.select2').select2({
                        minimumResultsForSearch: -1,
                        placeholder: "Select",
                        width: '100%'
                    });
                },
                error: function (error) {
                    ajaxErrorMessage(error);
                }
            });
        }
    </script>
@endsection
