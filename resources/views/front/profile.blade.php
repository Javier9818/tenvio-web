<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Perfil  </title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <link href="assets/images/favicon/favicon2.ico"  rel="icon">
    {{-- <script src="{!! asset('assets/js/jquery-3.3.1.min.js') !!}"></script> --}}
    {{-- <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> --}}
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <style>
        .card-body{
            padding: 0px !important;
        }
        body{
            background: -webkit-linear-gradient(left, #3931af, #00c6ff);
            height: 100vh !important;
            padding: 30px !important;
        }
.emp-profile{
     padding: 3%;
    /* margin-bottom: 3%; */
    border-radius: 0.5rem;
    background: #fff;
    box-sizing:border-box; -moz-box-sizing:border-box; /* Firefox */ -webkit-box-sizing:border-box; /* Safari */
}
.profile-img{
    text-align: center;
}
.profile-img img{
    width: 70%;
    height: 100%;
}
.profile-img .file {
    position: relative;
    overflow: hidden;
    margin-top: -20%;
    width: 70%;
    border: none;
    border-radius: 0;
    font-size: 15px;
    background: #212529b8;
}
.profile-img .file input {
    position: absolute;
    opacity: 0;
    right: 0;
    top: 0;
}
.profile-head h5{
    color: #333;
}
.profile-head h6{
    color: #0062cc;
}
.profile-edit-btn{
    border: none;
    border-radius: 1.5rem;
    width: 70%;
    padding: 2%;
    font-weight: 600;
    color: #6c757d;
    cursor: pointer;
}
.proile-rating{
    font-size: 12px;
    color: #818182;
    margin-top: 5%;
}
.proile-rating span{
    color: #495057;
    font-size: 15px;
    font-weight: 600;
}
.profile-head .nav-tabs{
    margin-bottom:5%;
}
.profile-head .nav-tabs .nav-link{
    font-weight:600;
    border: none;
}
.profile-head .nav-tabs .nav-link.active{
    border: none;
    border-bottom:2px solid #0062cc;
}
.profile-work{
    padding: 14%;
    margin-top: -15%;
}
.profile-work p{
    font-size: 12px;
    color: #818182;
    font-weight: 600;
    margin-top: 10%;
}
.profile-work a{
    text-decoration: none;
    color: #495057;
    font-weight: 600;
    font-size: 14px;
}
.profile-work ul{
    list-style: none;
}
.profile-tab label{
    font-weight: 600;
}
.profile-tab p{
    font-weight: 600;
    color: #0062cc;
}

.avatar{
    position: relative !important;
    display: inline-block !important;
    vertical-align: bottom !important;
    white-space: nowrap !important;
    border-radius: 1000px !important;
    width: 80% !important;
}
.avatar img {
    width: 100%;
    max-width: 100%;
    height: auto;
    border: 0 none;
    border-radius: 1000px;
}
</style>
</head>
<body>
    <div class="container emp-profile" id="app">
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
    <script>

        let user = @json($user);

    </script>

    {{-- <script src="{!! asset('assets/js/plugins.js') !!}"></script> --}}
    <!-- <script src="assets/js/wow.min.js"></script> -->
    <script src="{!! asset('assets/js/main.js') !!}"></script>

    <script src="/js/app.js" type="text/javascript"></script>

    <script>
        $(function(){
            $('#myTab').click(function (e) {
                e.preventDefault()
                $(this).tab('show');
            });
        });

    </script>

</body>
</html>
