<?php

namespace App\Events;

use App\Models\Imunisasi;
use App\Models\JadwalImunisasiModel;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class JadwalImunisasiEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $jadwal;

    public function __construct(JadwalImunisasiModel $jadwal)
    {
        $this->jadwal = $jadwal;
    }

    public function broadcastOn()
    {
        return new Channel('imunisasi-channel');
    }

    public function broadcastAs()
    {
        return 'jadwal-imunisasi';
    }
}
