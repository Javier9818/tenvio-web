@extends('layouts.admin')
@section('title') Mi perfil @endsection
@section('nav')
    {{-- @include('admin.components.nav') --}}
@endsection

@section('sideNav')
    <x-side-nav tab="1" selected='1'/>
@endsection

@section('header')
    <div class="content-header row">
        <div class="content-header-left col-md-4 col-12 mb-2">
            <h3 class="content-header-title">Mi Perfil</h3>
        </div>
        <div class="content-header-right col-md-8 col-12">
            <div class="breadcrumbs-top float-md-right">
                <div class="breadcrumb-wrapper mr-1">
                    <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/intranet">Inicio</a>
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
        <div class="row justify-content-center ">
            <div class="col-12 col-md-3">
                <div class="row justify-content-around">
                    <div class="card col-10 col-md-12 col-xl-12">
                        <div class="card-content collapse show">
                            <div class="card-body">
                                <foto-perfil></foto-perfil>
                            </div>
                        </div>
                    </div>
                    <div class="card col-10 col-md-12 col-xl-12">
                        <div class="card-content collapse show">
                            <div class="card-body">
                                <clave-perfil></clave-perfil>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-9">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Perfil de usuario</h4>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <user-perfil></user-perfil>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


@section('scripts')
    <script>
        let user = @json($user);
    </script>
@endsection


@section('styles')
    <style>
        .label{
            color: rgb(51, 49, 49);
            font-weight: bold;
        }
    </style>
@endsection
