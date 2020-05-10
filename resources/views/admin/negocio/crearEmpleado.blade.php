@extends('layouts.admin')
@section('title') Empleados  @endsection
@section('nav')
    @include('admin.components.nav')
@endsection

@section('sideNav')
    <x-side-nav tab="2" selected='1'/>
@endsection

@section('header')
    <div class="content-header row">
        <div class="content-header-left col-md-4 col-12 mb-2">
            <h3 class="content-header-title">Empleado</h3>
        </div>
        <div class="content-header-right col-md-8 col-12">
            <div class="breadcrumbs-top float-md-right">
                <div class="breadcrumb-wrapper mr-1">
                    <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/empleados">Empleados</a>
                    </li>
                    <li class="breadcrumb-item active">Nuevo empleado
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
                    <h4 class="card-title">Nuevo empleado</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body">
                        <form action="">
                            @csrf
                            @method('POST')
                            <div class="row">
                                <div class="col-md-6 mt-2">
                                    <label for="validationCustom01">Apellido Paterno</label>
                                     <input type="text" class="form-control is-invalid" placeholder="Ingrese apellidos paternos" required>
                                </div>
                                <div class="col-md-6 mt-2">
                                    <label for="validationCustom01">Apellido Materno</label>
                                     <input type="text" class="form-control" placeholder="Ingrese apellidos maternos" required>
                                </div>
                                <div class="col-md-12 mt-2">
                                    <label for="validationCustom01">Nombres</label>
                                     <input type="text" class="form-control" placeholder="Ingrese nombres" required>
                                </div>
                                <div class="col-md-6 mt-2">
                                    <label for="validationCustom01">Celular</label>
                                     <input type="text" class="form-control" placeholder="Ingrese su número de celular" required>
                                </div>
                                <div class="col-md-6 mt-2">
                                    <label for="validationCustom01">Dni</label>
                                     <input type="text" class="form-control" placeholder="IIngrese su número de DNI" required>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-icon btn-primary mt-2">Registrar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

