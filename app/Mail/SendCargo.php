<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendCargo extends Mailable
{
    use Queueable, SerializesModels;
    public $names; 
    public $url; 
    public $email; 
    public $mensaje;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($names, $url, $email, $mensaje)
    {
        $this->names = $names;        
        $this->url = $url;        
        $this->email = $email;       
        $this->mensaje=$mensaje;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email');
    }
}
