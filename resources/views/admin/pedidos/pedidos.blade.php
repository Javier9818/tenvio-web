@extends('layouts.admin')
@section('title') Pedidos  @endsection
@section('nav')
    @include('admin.components.nav')
@endsection

@section('sideNav')
    <x-side-nav tab="4" selected='1'/>
@endsection

@section('header')
    <div class="content-header row">
        <div class="content-header-left col-md-4 col-12 mb-2">
            <h3 class="content-header-title">Pedidos - Jornada 04/05/2020</h3>
        </div>
        <div class="content-header-right col-md-8 col-12">
            <div class="breadcrumbs-top float-md-right">
                <div class="breadcrumb-wrapper mr-1">
                    <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Inicio</a>
                    </li>
                    <li class="breadcrumb-item active">Pedidos
                    </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
<section id="chartjs-bar-charts">
    <div class="row">
        <pedido-component></pedido-component>
    </div>
</section>
@endsection
