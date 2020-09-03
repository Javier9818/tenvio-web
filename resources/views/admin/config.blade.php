@extends('layouts.admin')
@section('title') Configuraciones  @endsection
@section('nav')
    {{-- @include('admin.components.nav') --}}
@endsection

@section('sideNav')
    <x-side-nav tab="7" selected='1'/>
@endsection

@section('header')
{{$isAdmin = Auth::user()->isAdmin}}
    <div class="content-header row">
        <div class="content-header-left col-md-4 col-12 mb-2">
            <h3 class="content-header-title">Configuraciones</h3>
        </div>
        <div class="content-header-right col-md-8 col-12">
            <div class="breadcrumbs-top float-md-right">
                <div class="breadcrumb-wrapper mr-1">
                    <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/intranet">Inicio</a>
                    </li>
                    <li class="breadcrumb-item active">Configuraciones
                    </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('content')
<section>
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-header mb-0">
                    <h4 class="card-title">Tipos de entrega</h4>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body">
                        <tipo-entrega></tipo-entrega>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-content collapse show">
                    <div class="card-body">
                        <h4 class="card-title">Nombre público del negocio</h4>
                        <p>El nombre público del negocio es el nombre que aparece en el enlace de la web del negocio.</p>
                        <nombre-publico></nombre-publico>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-5">
            <div class="card">
                <div class="card-content collapse show">
                    <div class="card-body">
                        <h4 class="card-title">Autenticación Chatbot Facebook</h4>
                        <p>El token de autenticación permite el acceso a datos de productos y precios desde un ChatBot en Facebook.</p>
                        <token-red-social></token-red-social>
                    </div>
                </div>
            </div>
        </div>        
        <div class="col-12 col-md-12">
            <div class="card">
                <div class="card-header mb-0">
                    <h4 class="card-title">Tipos de pago</h4>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body">
                        <tipo-pago></tipo-pago>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
    <script>
        let isAdmin = @json($isAdmin);
    </script>

    <script>
        let empresa = @json($empresa);
    </script>
@endsection
