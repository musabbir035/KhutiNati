<?php

namespace App\Notifications;

use App\Events\AdminNotificationEvent;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use NotificationChannels\WebPush\WebPushChannel;
use NotificationChannels\WebPush\WebPushMessage;

class UserRegisteredNotification extends Notification
{
    use Queueable;

    private $customerName, $title, $message, $url;

    public function __construct(string $customerName, int $customerId)
    {
        $this->title = 'A new customer registered.';
        $this->message = 'Customer name: ' . $customerName . '.';
        $this->url = route('admin.users.show', ['user' => $customerId]);
    }

    public function via($notifiable)
    {
        return ['database', WebPushChannel::class];
    }

    public function toWebPush($notifiable, $notification)
    {
        return (new WebPushMessage)
            ->title($this->title)
            ->icon(asset('img/logo.png'))
            ->body($this->message)
            ->action('View', 'view_app')
            ->data(['url' => $this->url  . '?notif_id=' . $this->id]);
    }

    public function toArray($notifiable)
    {
        event(new AdminNotificationEvent($this->title, $this->message, $this->url, $this->id));

        return [
            'title' => $this->title,
            'message' => $this->message,
            'url' => $this->url . '?notif_id=' . $this->id
        ];
    }
}
