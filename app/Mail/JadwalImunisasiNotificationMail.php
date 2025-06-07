<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class JadwalImunisasiNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */

    public $jadwal;
    public $namaAnak;
    public function __construct($jadwal, $namaAnak)
    {
        $this->jadwal = $jadwal;
        $this->namaAnak = $namaAnak;
    }

    public function build()
    {
        return $this->subject('Notifikasi Jadwal Imunisasi')
                    ->view('emails.jadwal-imunisasi')
                    ->with([
                        'jadwal' => $this->jadwal,
                        'namaAnak' => $this->namaAnak,
                    ]);
    }
}
