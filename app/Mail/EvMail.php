<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EvMail extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $from_address;
    public $intro;
    public $body;
    public $greeting;
    public function __construct($from, $data)
    {
        $this->from_address = $from;
        $this->greeting="Hallo!";
        $this->intro = '<b>'. $data['name'] . '</b> hat Ihnen folgendes geschrieben.';
        $this->body = $data['text'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->from_address)->markdown('emails.contact');
    }
}
