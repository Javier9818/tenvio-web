@extends('layouts.admin')
@section('title') Delivery - Admin @endsection
@section('nav')
    @include('admin.components.nav')
@endsection

@section('sideNav')
    <x-side-nav tab="1" selected='1'/>
@endsection

@section('header')
    <div class="content-header row">
        <div class="content-header-left col-md-4 col-12 mb-2">
            <h3 class="content-header-title">Inicio</h3>
        </div>
        <div class="content-header-right col-md-8 col-12">
            <div class="breadcrumbs-top float-md-right">
                <div class="breadcrumb-wrapper mr-1">
                    <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Inicio</a>
                    </li>
                    {{-- <li class="breadcrumb-item active">Charts
                    </li> --}}
                    </ol>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <section id="chartjs-bar-charts">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Información de la empresa</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a href="/"><i class="ft-edit"></i> Editar</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <div class="container">
                                <div class="row">
                                    <div class="col-6 mt-2"> <h4 class="d-inline label">Nombre de la empresa: </h4><h4 class="d-inline">{{$empresa->nombre}}</h4></div>
                                    <div class="col-6 mt-2"> <h4 class="d-inline label">RUC: </h4><h4 class="d-inline">{{$empresa->ruc}}</h4></div>
                                    <div class="col-6 mt-2"> <h4 class="d-inline label">Gerente: </h4><h4 class="d-inline"> Briceño Montaño Javier</h4></div>
                                    <div class="col-6 mt-2"> <h4 class="d-inline label">Categoría:</h4><h4 class="d-inline"> {{$empresa->categoria}}</h4></div>
                                    <div class="col-12 mt-2"> <h4 class="label">Descripción del negocio: </h4><h4>{{$empresa->descripcion ?? '-'}}</h4></div>
                                    <div class="col-6 mt-2"> <h4 class="d-inline label">Dirección:</h4><h4 class="d-inline"> {{$empresa->direccion}}</h4></div>
                                    <div class="col-6 mt-2"> <h4 class="d-inline label">Celular: </h4><h4 class="d-inline">{{$empresa->celular}}</h4></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('styles')
    <style>
        .label{
            color: rgb(51, 49, 49);
            font-weight: bold;
        }
    </style>
@endsection
