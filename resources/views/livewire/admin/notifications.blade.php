<div>
    @foreach ($norifications as $notification)
    <a class="notification-item @if(!$notification->read_at) unread @endif" href="{{ $notification->data->url }}"
        id="{{ $notification->id }}">
        <div class="notification-item-title">{{ $notification->data->title }}</div>
        <div class="notification-item-message">{{ $notification->data->message }}</div>
    </a>
    @endforeach
</div>