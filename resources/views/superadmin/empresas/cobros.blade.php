@extends('layouts.admin')
@section('title') Panel de control - TeLlevoPeru  @endsection
@section('nav')
    {{-- @include('admin.components.nav') --}}
@endsection

@section('sideNav')
    <x-side-nav-admin tab="1" selected='3'/>
@endsection

@section('header')
    <div class="content-header row">
        <div class="content-header-left col-md-4 col-12 mb-2">
            <h3 class="content-header-title">Pagos</h3>
        </div>
        <div class="content-header-right col-md-8 col-12">
            <div class="breadcrumbs-top float-md-right">
                <div class="breadcrumb-wrapper mr-1">
                    <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/intranet">Inicio</a>
                    </li>
                    <li class="breadcrumb-item active">Cobros
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
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Cobros</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body">
                        <cobros-component></cobros-component>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
