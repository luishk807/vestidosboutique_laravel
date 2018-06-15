<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TestEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        //
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $address = "Vestidos Boutique";
        $subject = "Email Question";
        $name = "info@vestidosboutique.com";
        $message ="Client Information:\r\n";
        $message .="Name:".$data["first_name"]." ".$data["last_name"]."\r\n";
        $message .="Email:".$data["email"]."\r\n";
        $message .="Phone:".$data["phone"]."\r\n";
        $message .="Country:".$data["country"]."\r\n";
        $message .="Message:\r\n";
        $message .=$data["message"];

        return $this->view('mails.thankyou')
                    ->from($address, $name)
                    ->replyTo($address, $name)
                    ->subject($subject)
                    ->with([ 'message' => $message ]);
    }
}
