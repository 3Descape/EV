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
    public $data;
    public function __construct($from, $data)
    {
        $this->from_address = $from;
        $this->data = $data;
        //dd($this->from_address);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('miclack30@gmail.com')->view('emails.contact');
    }
}