<?php

namespace App\Events;

use App\Models\Order;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OrderPlacedEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $id, $data;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(string $title, string $message, $url, $notifId)
    {
        // $this->url = route('admin.orders.show', ['order' => $order->id]);
        // $this->title = $customerName . ' placed an order.';
        // $this->message = 'Order total: ' . $order->total . '.';

        //format data for frontend
        $this->data = [
            'url' => $url,
            'title' =>  $title,
            'message' => $message,
        ];
        $this->id = $notifId;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('admin-notification');
        //return ['admin-notification'];
    }

    public function broadcastAs()
    {
        return 'admin-notification-event';
    }
}
