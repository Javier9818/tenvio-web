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
		if ($this->obj->accion == 'Pagó')
			$asunto = 'Comprobante de pago - Tenvioperu';
		if ($this->obj->accion == 'Devolución')
			$asunto = 'Su pedido ha sido denegado';
		return $this->from('contacto@tenvioperu.com')
		->view('emails.pagado_culqi')
		->subject($asunto);
	}
}
