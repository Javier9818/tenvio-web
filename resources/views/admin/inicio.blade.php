@extends('layouts.admin')
@section('title') Delivery - Admin @endsection
@section('nav')
    {{-- @include('admin.components.nav') --}}
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
        <div class="row">
            <div class="col-12">
                @can('edit-company')
                    <info-empresa editar=true></info-empresa>
                @else
                    <info-empresa editar=false></info-empresa>
                @endcan
            </div>
        </div>
    </section>
@endsection


@section('scripts')
    <script>
        let empresa = @json($empresa);
        let ciudades = @json($ciudades);
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
