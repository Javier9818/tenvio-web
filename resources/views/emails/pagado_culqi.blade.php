<!DOCTYPE html>
<html>
<head>
<title>Page Title</title>
</head>
<style>
* {
	font: 101% sans-serif;
}
</style>
<body>
<div style="text-align: center">
	<img src="https://beta.tenvioperu.com/assets/images/logo/logo-v8.png" height="100">
	<h3>¡Gracias por tu compra!</h3>
</div>
<div style="text-align: center;">
  <table style="margin: auto;">
      <tr style="padding: 0.5em;">
        <td>Usuario:</td>
        <td>{{$obj->nombre}}</td>
      </tr>
	   <tr style="padding: 0.5em;">
	     <td>Email:</td>
	     <td>{{$obj->email}}</td>
	   </tr>
      <tr style="padding: 0.5em;">
        <td>Empresa:</td>
        <td>{{$obj->empresa}}</td>
      </tr>
      <tr style="padding: 0.5em;">
        <td>Descripción de la compra:</td>
        <td>{{$obj->descripcion}}</td>
      </tr>
      <tr style="padding: 0.5em;">
        <td>Id del pedido</td>
        <td>{{$obj->idPedido}}</td>
      </tr>
      <tr style="padding: 0.5em;">
        <td>Importe:</td>
        <td>s/{{$obj->precio}}</td>
      </tr>
      <tr style="padding: 0.5em;">
        <td>Tipo de pago:</td>
        <td>{{$obj->tipopago}}</td>
      </tr>
      <tr style="padding: 0.5em;">
        <td>Código de transacción:</td>
        <td>{{$obj->codTransact}}</td>
      </tr>
  </table>
</div>
<div style="text-align: center">
	<h5>En los próximos minutos, la empresa {{''}} se contactará contigo</h5>
	<h6>Si tuviste inconvenientes con tu pedido, Infórmanos al 956504624</h6>
</div>
</body>
</html>


{{--
	<style>
	* {
		font: 101% sans-serif;
	}
	ul {
		list-style-type: none;
	}
	</style>
	<div style="text-align: center">
		<img src="https://beta.tenvioperu.com/assets/images/logo/logo-v8.png" height="100">
		<h3>¡Gracias por tu compra!</h3>
		<li>Usuario: {{''}}</li>
		<li>Empresa: {{''}}</li>
		<li>Descripción de la compra: {{''}}</li>
		<li>Id del pedido {{''}}</li>
		<li>Importe: s/{{''}}</li>
		<li>Tipo de pago: {{''}}</li>
		<li>Código de transacción: {{''}}</li>
		<h5>En los próximos minutos, la empresa {{''}} se contactará contigo</h5>
		<h6>Si tuviste inconvenientes con tu pedido, Infórmanos al 956504624</h6>
	</div>
--}}

{{--
	<!DOCTYPE html>
	<html>
	<head>
	<title>Page Title</title>
	</head>
	<style>
	* {
		font: 101% sans-serif;
	}
	table {
	  border-collapse: collapse;
	}

	table, th, td {
		border: 1px solid grey;
		margin: 5px;
	}
	th, td {
	   padding-left: 2.4em;
	   padding-right: 2.4em;
	   padding-top: 0.7em;
	   padding-bottom: 0.7em;
	   /*padding: 0.5em;*/
	}
	</style>
	<body>
	<div style="text-align: center">
		<img src="https://beta.tenvioperu.com/assets/images/logo/logo-v8.png" height="100">
		<h3>¡Gracias por tu compra!</h3>
	</div>
	<div style="text-align: center;">
	  <table style="margin: auto; border: 1px solid grey;">
	      <tr style="padding: 0.5em;">
	        <td>Usuario:</td>
	        <td>{{''}}</td>
	      </tr>
	      <tr style="padding: 0.5em;">
	        <td>Empresa:</td>
	        <td>{{''}}</td>
	      </tr>
	      <tr style="padding: 0.5em;">
	        <td>Descripción de la compra:</td>
	        <td>{{''}}</td>
	      </tr>
	      <tr style="padding: 0.5em;">
	        <td>Id del pedido</td>
	        <td>{{''}}</td>
	      </tr>
	      <tr style="padding: 0.5em;">
	        <td>Importe:</td>
	        <td>s/{{''}}</td>
	      </tr>
	      <tr style="padding: 0.5em;">
	        <td>Tipo de pago:</td>
	        <td>{{''}}</td>
	      </tr>
	      <tr style="padding: 0.5em;">
	        <td>Código de transacción:</td>
	        <td>{{''}}</td>
	      </tr>
	  </table>
	</div>
	<div style="text-align: center">
		<h5>En los próximos minutos, la empresa {{''}} se contactará contigo</h5>
		<h6>Si tuviste inconvenientes con tu pedido, Infórmanos al 956504624</h6>
	</div>
	</body>
	</html>
--}}
