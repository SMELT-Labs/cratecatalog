<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class Interaction
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    public Model $model;
    public Collection $data;
    public string $type;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(string $type, Model $model, array $data)
    {
        $this->model = $model;
        $this->data = collect($data)->merge([
            "created_at" => now()
        ]);
        $this->type = $type;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('interaction.'.$this->type);
    }
}
