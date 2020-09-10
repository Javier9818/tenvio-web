@extends('layouts.front')

@section('title')
    Compra
@endsection

@section('nav')
   @include('front.nav')
@endsection



@section('contenido')

<section id="page-title" class="page-title page-title-layout6 text-center bg-overlay bg-overlay-2 bg-parallax">
    <div class="bg-img"><img src="https://image.freepik.com/vector-gratis/servicio-entrega-concepto-mascaras_23-2148520404.jpg" alt="background"></div>
    <svg class="pagetitle__divider-shape" xmlns="http://www.w3.org/2000/svg" width="22" height="61"
      viewBox="0 0 22 61">
      <path
        d="M799,769h2v61h-2V769Zm8,24.8a0.969,0.969,0,0,0-1.911,0,3.012,3.012,0,0,1-.883,2.16,4.486,4.486,0,0,0,0,6.136,3.083,3.083,0,0,1,0,4.32,4.486,4.486,0,0,0,0,6.136,3.088,3.088,0,0,1,0,4.325,4.5,4.5,0,0,0,0,6.142,3.014,3.014,0,0,1,.884,2.163,0.969,0.969,0,0,0,1.911,0,4.414,4.414,0,0,0-1.213-3.07,3.091,3.091,0,0,1,0-4.328,4.491,4.491,0,0,0,0-6.14,3.08,3.08,0,0,1,0-4.319,4.488,4.488,0,0,0,0-6.137,3.081,3.081,0,0,1,0-4.32A4.407,4.407,0,0,0,807,793.8Zm0-20a0.969,0.969,0,0,0-1.911,0,3.014,3.014,0,0,1-.883,2.16,4.486,4.486,0,0,0,0,6.136,3.083,3.083,0,0,1,0,4.32,4.488,4.488,0,0,0,0,6.137,3.087,3.087,0,0,1,0,4.324,4.5,4.5,0,0,0,0,6.142,3.014,3.014,0,0,1,.884,2.163,0.969,0.969,0,0,0,1.911,0,4.414,4.414,0,0,0-1.213-3.07,3.089,3.089,0,0,1,0-4.327,4.491,4.491,0,0,0,0-6.14,3.081,3.081,0,0,1,0-4.32,4.488,4.488,0,0,0,0-6.137,3.081,3.081,0,0,1,0-4.32A4.409,4.409,0,0,0,807,773.8ZM793,793.8a0.969,0.969,0,0,1,1.911,0,3.012,3.012,0,0,0,.883,2.16,4.486,4.486,0,0,1,0,6.136,3.083,3.083,0,0,0,0,4.32,4.486,4.486,0,0,1,0,6.136,3.088,3.088,0,0,0,0,4.325,4.5,4.5,0,0,1,0,6.142,3.014,3.014,0,0,0-.884,2.163,0.969,0.969,0,0,1-1.911,0,4.414,4.414,0,0,1,1.213-3.07,3.091,3.091,0,0,0,0-4.328,4.491,4.491,0,0,1,0-6.14,3.08,3.08,0,0,0,0-4.319,4.488,4.488,0,0,1,0-6.137,3.081,3.081,0,0,0,0-4.32A4.407,4.407,0,0,1,793,793.8Zm0-20a0.969,0.969,0,0,1,1.911,0,3.014,3.014,0,0,0,.883,2.16,4.486,4.486,0,0,1,0,6.136,3.083,3.083,0,0,0,0,4.32,4.488,4.488,0,0,1,0,6.137,3.087,3.087,0,0,0,0,4.324,4.5,4.5,0,0,1,0,6.142,3.014,3.014,0,0,0-.884,2.163,0.969,0.969,0,0,1-1.911,0,4.414,4.414,0,0,1,1.213-3.07,3.089,3.089,0,0,0,0-4.327,4.491,4.491,0,0,1,0-6.14,3.081,3.081,0,0,0,0-4.32,4.488,4.488,0,0,1,0-6.137,3.081,3.081,0,0,0,0-4.32A4.409,4.409,0,0,1,793,773.8Zm-4,5.2h2v41h-2V779Zm20,0h2v41h-2V779Z"
        transform="translate(-789 -769)"></path>
    </svg>
    <div class="container">
      <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
          <span class="pagetitle__subheading">Te Envio</span>
          <h1 class="pagetitle__heading">Mi Carrito</h1>
          <nav aria-label="breadcrumb" >
            <ol class="breadcrumb justify-content-center">
              <li class="breadcrumb-item active">🥇 🇵🇪</li>
            </ol>
          </nav>
        </div><!-- /.col-lg-12 -->
      </div><!-- /.row -->
    </div><!-- /.container -->
  </section><!-- /.page-title -->

  <!-- =========================
              Shopping Cart
      =========================== -->
  <section id="ShoppinCcart" class="shop shopping-cart pb-50">
    <div class="container">
		@if(isset($data))
    	<cart-new databot="{{$data}}"></cart-new>
		@else
			<cart-new></cart-new>
		@endif				
      <!-- /.row -->
    </div><!-- /.container -->
  </section><!-- /.shopping-cart -->
@endsection


@section('script')
	<script src="https://checkout.culqi.com/js/v3"></script>
	<script type="text/javascript">
		Culqi.publicKey = 'pk_test_CSsdk4OiuyLGXyQm';
		Culqi.settings({
			title: 'Tenvio Perú',
			currency: 'PEN',
			description: 'Comida',
			amount: 100
		});
		Culqi.options({
			lang: 'es',
			modal: true,
			//customButton: 'Pagar S./'+'15'+'.00 soles',
			//customButton: 'Pagar pe cagada',
			style: {
				//logo: 'https://beta.tenvioperu.com/assets/images/favicon/favicon2.ico',
				logo: 'https://i.imgur.com/XnIjAws.png',
				maincolor: '#0898e7',
				buttontext: '#ffffff',
				maintext: '#4A4A4A',
				desctext: '#4A4A4A'
				//https://www.rgbtohex.net/rgb/
			}
		});
		function culqi() {
			if (Culqi.token) {
				console.log(Culqi);
				console.log(Culqi.token);
				console.log(Culqi.token.email);
				var token = Culqi.token.id;
				//alert('Se ha creado un token:' + token);
				var detail = {
					token: Culqi.token.id,
					email: Culqi.token.email
				}
				console.log(detail);
				console.log(detail);
				console.log(detail);
				var _eventoenviarpagoculqi = new CustomEvent('enviarpagoculqi', {detail:detail});
				document.dispatchEvent(_eventoenviarpagoculqi);
			}
			else {
				console.log(Culqi.error);
				//alert(Culqi.error.user_message);
			}
		};
	</script>
@endsection
