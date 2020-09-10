<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Email_PagadoCulqi extends Mailable
{
	use Queueable, SerializesModels;

	public $obj;

	public function __construct($obj)
	{
		$this->obj = $obj;
	}

	public function build(){
		return $this->from('contacto@tenvioperu.com')
		->view('emails.pagado_culqi')
		->subject('Comprobante de pago - Tenvioperu');
	}
}
