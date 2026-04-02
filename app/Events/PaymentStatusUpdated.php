<?php

namespace App\Events;


use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PaymentStatusUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(public $user, public $subscriptionId, public $paymentId) {}

    // /**
    //  * Create a new event instance.
    //  */
    // public function __construct(public User $user, public $paymentId, public $subscriptionId)
    // {
    //     //
    // }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('payments.' . $this->subscriptionId . '.' . $this->paymentId),
        ];
    }

    //  public function broadcastOn(): array
    // {
    //     return [
    //         new PrivateChannel('payments'.$this->paymentId."/".$this->subscriptionId),
    //     ];
    // }
}
