<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SeriesCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public string $seriesName;
    public int $serieId;
    public int $seriesSeasonQty;
    public int $seriesEpisodesPerSeason;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(string $seriesName, int $serieId, int $seriesSeasonQty, int $seriesEpisodesPerSeason)
    {
        // Inicializando as propriedades corretamente
        $this->seriesName = $seriesName;
        $this->serieId = $serieId;
        $this->seriesSeasonQty = $seriesSeasonQty;
        $this->seriesEpisodesPerSeason = $seriesEpisodesPerSeason;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
