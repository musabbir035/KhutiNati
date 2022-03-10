<?php

namespace App\Notifications;

use App\Events\AdminNotificationEvent;
use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use NotificationChannels\WebPush\WebPushChannel;
use NotificationChannels\WebPush\WebPushMessage;

class OrderPlacedNotification extends Notification
{
    use Queueable;

    private $customerName, $title, $message, $url;

    public function __construct(string $customerName, Order $order)
    {
        $this->title = $customerName . ' placed an order.';
        $this->message = 'Order total: ' . $order->total . '.';
        $this->url = route('admin.orders.show', ['order' => $order->id]);
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
