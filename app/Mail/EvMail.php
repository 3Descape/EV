<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EvMail extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $from_address;
    public $name;
    public $body;

    public function __construct($from, $data)
    {
        $this->from_address = $from;
        $this->name = $data['name'];
        $this->body = trim(preg_replace("/\r\n|\r/", '<br />', $data['text']));
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->from_address)->view('emails.contact');
    }
}
