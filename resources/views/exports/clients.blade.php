<table class="table table-hover">
    <thead>
    <tr>
        <th class="w-50p">№</th>
        <th>имя</th>
        <th>логин (ID)</th>
        <th>телефон</th>
        <th>email</th>
        <th>компания</th>
        <th>менеджер</th>
        <th>дата регистрации</th>
    </tr>
    </thead>
    <tbody>
    @if (count($data) > 0)
        @foreach($data as $key => $item)
            <tr>
                <td>
                    {{ $key + 1 }}
                </td>
                <td>
                    {{ $item->name }}
                </td>
                <td>
                    {{ $item->login }}
                </td>
                <td>
                    {{ $item->phone ?? '--' }}
                </td>
                <td>
                    {{ $item->email ?? '--' }}
                </td>
                <td>
                    {{ $item->company_name }}
                </td>
                <td>
                    {{ $item->manager->name_ru }}
                </td>
                <td>
                    {{ $item->created_at->format('d.m.Y / H:i:s') }}
                </td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>
