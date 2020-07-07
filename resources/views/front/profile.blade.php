@extends('layouts.front')

@section('title')
 {{'Perfil'}}
@endsection
@section('nav')
    @include('front.nav')
@endsection
@section('contenido')
 
<link rel="stylesheet" href="{!! asset('assets/css/profile_styles.css') !!}">
    <div class="container emp-profile"  >
        <form method="post">
            <div class="row">
                <div class="col-md-4">
                    <div class="card card-cascade">

                        <!-- Card image -->
                        <div class="view view-cascade overlay">
                          {{-- <img class="card-img-top" src="https://mdbootstrap.com/img/Photos/Others/men.jpg" alt="Card image cap"> --}}
                          <foto-perfil></foto-perfil>
                          <a>
                            <div class="mask rgba-white-slight"></div>
                          </a>
                        </div>

                        <!-- Card content -->
                        <div class="card-body card-body-cascade text-center">



                          <!-- Title -->
                        <h4 class="card-title"><strong>
                            {{-- @foreach ($user as $item)
                            {{$item->nombres. ' '.$item->appaterno.' '.$item->apmaterno}}
                        @endforeach --}}
                    </strong></h4>
                          <!-- Subtitle -->
                          <h6 class="font-weight-bold indigo-text py-2 d-none">Usuario</h6>
                          <!-- Text -->
                          <p class="card-text">
                              <clave-perfil></clave-perfil>
                          </p>

                          <!-- Facebook -->
                          <a type="button" class="btn-floating btn-small btn-fb"><i class="fab fa-facebook-f"></i></a>
                          <!-- Twitter -->
                          <a type="button" class="btn-floating btn-small btn-tw"><i class="fab fa-twitter"></i></a>
                          <!-- Google + -->
                          <a type="button" class="btn-floating btn-small btn-dribbble"><i class="fab fa-dribbble"></i></a>

                        </div>

                        <!-- Card footer -->
                        <div class="card-footer text-muted text-center">
                            __
                        </div>

                      </div>
                      <!-- Card Regular -->
                </div>
                <div class="col-md-6">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                          <a class="nav-link active" id="home-tab"  data-toggle="tab" href="#home" role="tab" aria-controls="home"
                            aria-selected="true">Informacion</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" id="pedidos-tab" data-toggle="tab" href="#pedidos" role="tab" aria-controls="profile"
                            aria-selected="false">Pedidos</a>
                        </li>
                        <li class="nav-item d-none">
                          <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact"
                            aria-selected="false">Otro</a>
                        </li>
                      </ul>
                      <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <user-perfil></user-perfil>
                        </div>
                        <div class="tab-pane fade active" id="pedidos" role="tabpanel" aria-labelledby="profile-tab">
                            <front-pedidos-component></front-pedidos-component>
                        </div>
                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                            sfsf.</div>
                      </div>
                </div>
                {{-- <div class="col-md-2">
                    <input type="submit" class="profile-edit-btn" name="btnAddMore" value="Editar Perfil"/>
                </div> --}}
            </div>



        </form>
    </div>
   

    
<!-- 
    <script>
        $(function(){
            $('#myTab').click(function (e) {
                e.preventDefault()
                $(this).tab('show');
            });
        });

    </script> -->
 
@endsection
<script>

let user = @json($user);

</script>

<!-- <script src="assets/js/wow.min.js"></script> -->
<script src="{!! asset('assets/js/main.js') !!}"></script>

