@foreach ($notifications as $notification)
    @if ($notification->notification_type == config('custom.call'))
        <a href="{{ route('user.show', $notification->notification->caller) }}" class="{{ $notification->viewed == 0 ? 'not-viewed' : '' }}" data-id="{{ $notification->id }}">
            <div class="btn btn-danger btn-circle"><i class="fa fa-phone"></i></div>
            <div class="mail-contnet">
                <h5>{{ config('custom.call') }}</h5> 
                <span class="mail-desc"></span> @lang('custom.noty_call_with', ['User' => $notification->userSend->name])
                <span class="time">{{ \Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}</span>
            </div>
        </a>
    @elseif ($notification->notification_type == config('custom.seminar'))
        <a href="{{ route('seminar.show', $notification->notification->id) }}" class="{{ $notification->viewed == 0 ? 'not-viewed' : '' }}" data-id="{{ $notification->id }}">
            <div class="btn btn-warning btn-circle"><i class="fa fa-comment"></i></div>
            <div class="mail-contnet">
                <h5>{{ config('custom.seminar') }}</h5> 
                <span class="mail-desc"></span> @lang('custom.noty_seminar', ['Seminar' => $notification->notification->name])
                <span class="time">{{ \Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}</span>
            </div>
        </a>
    @endif
@endforeach
