<?php

namespace App\Notifications;

use App\Events\OrderPlacedEvent;
use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\WebPush\WebPushChannel;
use NotificationChannels\WebPush\WebPushMessage;

class OrderPlacedNotification extends Notification
{
    use Queueable;

    private $customerName, $order, $title, $message, $url;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(string $customerName, Order $order)
    {
        $this->title = $customerName . ' placed an order.';
        $this->message = 'Order total: ' . $order->total . '.';
        $this->url = route('admin.orders.show', ['order' => $order->id]);
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
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
            ->data(['url' => $this->url]);
        // return (new WebPushMessage)
        //     ->title('Hello from Laravel!')
        //     ->icon('/notification-icon.png')
        //     ->body('Thank you for using our application.')
        //     ->action('View app', 'view_app')
        //     ->data(['id' => $notification->id]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        event(new OrderPlacedEvent($this->title, $this->message, $this->url, $this->id));

        return [
            'title' => $this->title,
            'message' => $this->message,
            'url' => $this->url
        ];
    }
}
