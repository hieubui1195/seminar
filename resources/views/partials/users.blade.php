<thead>
    <tr>
        <th></th>
        <th></th>
        <th>@lang('custom.email')</th>
        <th>@lang('custom.name')</th>
        <th>@lang('custom.role')</th>
        <th></th>
    </tr>
</thead>
<tbody>
    @foreach ($users as $user)
        <tr>
            <td>{{ $loop->index + 1 }}</td>
            <td>
                {!! html_entity_decode(
                    Html::linkRoute('user.show', '<image src="' . config('custom.path_avatar') . $user->avatar . '" class="user-image">', $user->id, ['title' => Lang::get('custom.detail')])
                ) !!}
            </td>
            <td>{{ $user->email }}</td>
            <td>
                {!! Html::linkRoute('user.show', $user->name, $user->id, ['title' => Lang::get('custom.detail')]) !!}
            </td>
            <td>
                @if ($user->level == 1)
                    @lang('custom.user')
                @else
                    @lang('custom.admin')
                @endif
            </td>
            <td>
                @if (Auth::id() != $user->id)
                    <a href="/user/video/{{ $user->id }}?caller={{ Auth::id() }}&receiver={{ $user->id }}" class="btn btn-success">
                        <i class="fa fa-phone"></i>
                    </a>
                @endif
                @if (Auth::user()->level== config('custom.admin') && Auth::id() != $user->id)
                    {!! html_entity_decode(Form::button('<i class="fa fa-trash"></i>', ['class' => 'btn btn-danger btn-delete', 'title' => Lang::get('custom.delete'), 'data-id' => $user->id])) !!}
                @endif
            </td>
        </tr>
    @endforeach
</tbody>
<tfoot>
    <tr>
        <th></th>
        <th></th>
        <th>@lang('custom.email')</th>
        <th>@lang('custom.name')</th>
        <th>@lang('custom.role')</th>
        <th></th>
    </tr>
</tfoot>
