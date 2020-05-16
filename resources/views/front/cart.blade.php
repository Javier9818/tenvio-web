@extends('layouts.front')

@section('title')
    Compra
@endsection

@section('nav')
   @include('front.nav2')
@endsection



@section('contenido')
<section id="page-title" class="page-title page-title-layout7">
    <div class="container">
      <div class="row">
        <div class="col-sm-12 col-md-6 col-lg-6">
          <h1 class="pagetitle__heading color-dark">Cart</h1>
        </div><!-- /.col-lg-6 -->
        <div class="col-sm-12 col-md-6 col-lg-6 d-none">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-end">
              <li class="breadcrumb-item"><a href="index.html">Home</a></li>
              <li class="breadcrumb-item"><a href="shop.html">Shop</a></li>
              <li class="breadcrumb-item active" aria-current="page">Cart</li>
            </ol>
          </nav>
        </div><!-- /.col-lg-6 -->
      </div><!-- /.row -->
    </div><!-- /.container -->
  </section><!-- /.page-title -->

  <!-- =========================
              Shopping Cart
      =========================== -->
  <section id="ShoppinCcart" class="shop shopping-cart pb-50">
    <div class="container">
      <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
          <div class="cart-table table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Producto</th>
                  <th>Precio</th>
                  <th>Cantidad</th>
                  <th>Total</th>
                </tr>
              </thead>
              <tbody>
                <tr class="cart__product ">
                  <td class="cart__product-item">
                    <div class="cart__product-remove">
                      <i class="fa fa-close"></i>
                    </div>
                    <div class="cart__product-img">
                      <img src="assets/images/shop/grid/1.jpg" alt="product" />
                    </div>
                    <div class="cart__product-title">
                      <h6>Roast Sea Trout</h6>
                    </div>
                  </td>
                  <td class="cart__product-price">$ 10.00</td>
                  <td class="cart__product-quantity">
                    <div class="product-quantity">
                      <div class="quantity__input-wrap">
                        <i class="fa fa-minus decrease-qty"></i>
                        <input type="number" value="1" class="qty-input">
                        <i class="fa fa-plus increase-qty"></i>
                      </div>
                    </div>
                  </td>
                  <td class="cart__product-total">$ 10.00</td>
                </tr>

                <tr class="cart__product-action">
                  <td colspan="4">
                    <div class="row">
                      <div class="col-sm-12 col-md-12 col-lg-12 cart__product-action-content">
                        <form class="d-flex flex-wrap">
                          <input type="text" class="form-control mb-10 mr-10" placeholder="Cupon de descuento">
                          <button type="submit" class="btn btn-primary mb-10">Aplicar Cupon</button>
                        </form>
                        <div>
                          {{-- <a class="btn btn__secondary mr-10" href="#">update cart</a> --}}
                          <a class="btn btn-primary" href="#">Realizar Pedido</a>
                        </div>
                      </div><!-- /.col-lg-2  -->
                    </div><!-- /.row  -->
                  </td>
                </tr>
              </tbody>
            </table>
          </div><!-- /.cart-table -->
        </div><!-- /.col-lg-12 -->
        <div class="col-sm-12 col-md-6 col-lg-6">
          <div class="cart__shiping">
            <h6>A donde llevamos tu pedido ?</h6>
            <form class="row">
              <div class="col-md-12">
                AQUI VA EL MAPA
              </div>
            </form>
          </div><!-- /.cart__shiping -->
        </div><!-- /.col-lg-6 -->
        <div class="col-sm-12 col-md-6 col-lg-6">
          <div class="cart__total-amount">
            <h6>TOTAL:</h6>
            <ul class="list-unstyled mb-0">
              <li><span>Subtotal :</span><span>$ 140.00</span></li>
              <li><span>IGV :</span><span>S/. 45.2</span></li>
              <li><span>Order Total :</span><span>$ 140.00</span></li>
            </ul>
          </div><!-- /.cart__total-amount -->
        </div><!-- /.col-lg-6 -->
      </div><!-- /.row -->
    </div><!-- /.container -->
  </section><!-- /.shopping-cart -->
@endsection
