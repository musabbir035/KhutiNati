<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;

class AdminNotificationEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $id, $data, $created_at;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(string $title, string $message, string $url, string $notifId)
    {
        //format data for frontend
        $this->data = [
            'url' => $url,
            'title' =>  $title,
            'message' => $message,
        ];
        $this->id = $notifId;
        $this->created_at = Carbon::now();
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
