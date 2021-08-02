<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nama,$tikets,$event,$link)
    {
        $this->nama = $nama;
        $this->tikets = $tikets;
        $this->event = $event;
        $this->link = $link;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('eventgap1@gmail.com')
        ->subject('Pembelian Tiket Event')
        ->view('email')
        ->with(
        [
            'nama' => $this->nama,
            'tikets' => $this->tikets,
            'event' => $this->event,
            'link' => $this->link
        ]);
    }
}
