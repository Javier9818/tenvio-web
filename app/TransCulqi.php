<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use DB;
use App\PedidosUsers;
use App\Contrato;

class TransCulqi extends Model
{
	protected $table = 'transacciones_culqi';
	protected $fillable = [
		'id',
		'transId',
		'amount',
		'transfer_amount',
		'email',
		'description',
		'card_number',
		'card_brand',
		'card_type',
		'reference_code',
		'authorization_code',
		'ip',
		'device_type',
		'created_at',
		'updated_at'
	];

	public static function pagar($token, $email, $description){
		$culqi = new \Culqi\Culqi(array('api_key' => "sk_test_kGwRa6VcTAQBVb0F"));
		//$culqitokens = new \Culqi\Tokens($culqi);
		//dd($culqitokens->create(true));
		try {
			$charge = $culqi->Charges->create(
				array(
					"amount" => 1000,
					"capture" => true,
					"currency_code" => "PEN",
					"description" => $description,
					"email" => $email,
					"installments" => 0,
					"source_id" => $token
				)
			);
			//dd(json_encode($charge));
			/*
			//$charge = '{"duplicated":false,"object":"charge","id":"chr_test_Jx4XZMGaxXxmrDD2","creation_date":1598390007000,"amount":1000,"amount_refunded":0,"current_amount":1000,"installments":1,"installments_amount":1000,"currency_code":"PEN","email":"jaironavezaroca@gmail.com","description":"Venta de prueba","source":{"object":"token","id":"tkn_test_MFecSs9l2FBBmAnO","type":"card","creation_date":1598390001000,"email":"jaironavezaroca@gmail.com","card_number":"411111******1111","last_four":"1111","active":true,"iin":{"object":"iin","bin":"411111","card_brand":"Visa","card_type":"credito","card_category":"Cl\u00e1sica","issuer":{"name":"BBVA","country":"PERU","country_code":"PE","website":null,"phone_number":null},"installments_allowed":[2,4,6,8,10,12,3,5,7,9,24,48]},"client":{"ip":"2800:200:f000:2a51:99fa:311b:113d:768e","ip_country":"Peru","ip_country_code":"PE","browser":"UNKNOWN","device_fingerprint":null,"device_type":"Escritorio"},"metadata":{"installments":"1"}},"outcome":{"type":"venta_exitosa","code":"AUT0000","merchant_message":"La operaci\u00f3n de venta ha sido autorizada exitosamente","user_message":"Su compra ha sido exitosa."},"fraud_score":3,"dispute":false,"capture":true,"reference_code":"AFFLuwuSNO","authorization_code":"sPN9ie","metadata":{},"total_fee":47,"fee_details":{"fixed_fee":{},"variable_fee":{"currency_code":"PEN","commision":0.0399,"total":40}},"total_fee_taxes":7,"transfer_amount":953,"paid":false,"statement_descriptor":"CULQI*","transfer_id":null,"capture_date":1598390007000}';
			*/
			//$charge = json_decode($charge);
			//dd($charge);
			//dd(TransCulqi::registrar($charge));
			return [
				'success' => true,
				'obj' => TransCulqi::registrar($charge)
			];
		} catch (\Exception $e) {
			$json_mensaje = json_decode($e->getMessage());
			//dd($json_mensaje);
			return [
				'success' => false,
				'msj' => $json_mensaje->user_message
			];
		}
	}
	public static function registrar($charge){
		//dd(['amount' => $charge->amount / 100,'transfer_amount' => $charge->transfer_amount / 100]);
		return TransCulqi::create([
			'transId' => $charge->id,
			'amount' => $charge->amount / 100,
			'transfer_amount' => $charge->transfer_amount / 100,
			'email' => $charge->email,
			'description' => $charge->description,
			'card_number' => $charge->source->card_number,
			'card_brand' => $charge->source->iin->card_brand,
			'card_type' => $charge->source->iin->card_type,
			'reference_code' => $charge->reference_code,
			'authorization_code' => $charge->authorization_code,
			'ip' => $charge->source->client->ip,
			'device_type' => $charge->source->client->device_type
		]);
	}
}

/*

USE delivery;
drop table transacciones_culqi;
CREATE TABLE transacciones_culqi(
	id INT PRIMARY KEY AUTO_INCREMENT,
	transId VARCHAR(30) NOT NULL,
	amount DECIMAL(9,2) NOT NULL,
	transfer_amount DECIMAL(9,2) NOT NULL,
	email VARCHAR(100) NOT NULL,
	description VARCHAR(80) NULL,
	card_number VARCHAR(16) NULL,
	card_brand VARCHAR(20) NULL,
	card_type VARCHAR(20) NULL,
	reference_code VARCHAR(15) NOT NULL, -- 10
	authorization_code VARCHAR(10) NOT NULL, -- 6
	ip VARCHAR(60) NULL,
	device_type VARCHAR(20) NULL,
	created_at TIMESTAMP NULL DEFAULT NULL,
	updated_at TIMESTAMP NULL DEFAULT NULL
);

*/
