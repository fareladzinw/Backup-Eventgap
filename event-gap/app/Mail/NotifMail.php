<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotifMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nama_rekening,$rekening,$tikets,$event,$total)
    {
        $this->nama_rekening = $nama_rekening;
        $this->rekening = $rekening;
        $this->tikets = $tikets;
        $this->event = $event;
        $this->total = $total;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('eventgap1@gmail.com')
        ->subject('Pengingat Pembayaran Tiket Event')
        ->view('emailNotif')
        ->with(
        [
            'nama_rekening' => $this->nama_rekening,
            'rekening' => $this->rekening,
            'tikets' => $this->tikets,
            'event' => $this->event,
            'total'=> $this->total
        ]);
    }
}
