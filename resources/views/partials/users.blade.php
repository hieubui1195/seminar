<thead>
    <tr>
        <th></th>
        <th>@lang('custom.email')</th>
        <th>@lang('custom.name')</th>
        <th>@lang('custom.role')</th>
        @if (Auth::user()->level== config('custom.admin'))
            <th>@lang('custom.Change Role')</th>
        @endif
        <th></th>
    </tr>
</thead>
<tbody>
    @foreach ($users as $user)
        <tr>
            <td>
                <a href="{{ route('user.show', $user->id) }}" title="{{ Lang::get('custom.detail') }}">
                    @if ($user->avatar == config('custom.default_avatar'))
                        <img src="{{ config("custom.path_images") . config('custom.default_avatar') }}" class="user-image">
                    @else
                        <img src="{{ config("custom.path_avatar") . $user->avatar }}" class="user-image">
                    @endif
                </a>
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
            @if (Auth::user()->level== config('custom.admin'))
                <td>
                    <select class="form-control" data-id={{ $user->id }} data-current-role="{{ $user->level }}">
                        @if ($user->level == 1)
                            <option selected="selected" value="1">@lang('custom.user')</option>
                            <option value="2">@lang('custom.admin')</option>
                        @else
                            <option value="1">@lang('custom.user')</option>
                            <option selected="selected" value="2">@lang('custom.admin')</option>
                        @endif
                    </select>
                </td>
            @endif
            <td>
                @if (Auth::id() != $user->id)
                    <a href="/user/video/{{ $user->id }}?caller={{ Auth::id() }}&receiver={{ $user->id }}" class="btn btn-success call-from-users" title="{{ Lang::get('custom.call') }}">
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
        <th>@lang('custom.email')</th>
        <th>@lang('custom.name')</th>
        <th>@lang('custom.role')</th>
        @if (Auth::user()->level== config('custom.admin'))
            <th>@lang('custom.Change Role')</th>
        @endif
        <th></th>
    </tr>
</tfoot>
