@extends('layouts.admin')
@section('title') Panel de control - TeLlevoPeru  @endsection
@section('nav')
    @include('admin.components.nav')
@endsection

@section('sideNav')
    <x-side-nav-admin tab="1" selected='1'/>
@endsection

@section('header')
    <div class="content-header row">
        <div class="content-header-left col-md-4 col-12 mb-2">
            <h3 class="content-header-title">Mis empresas</h3>
        </div>
        <div class="content-header-right col-md-8 col-12">
            <div class="breadcrumbs-top float-md-right">
                <div class="breadcrumb-wrapper mr-1">
                    <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Inicio</a>
                    </li>
                    <li class="breadcrumb-item active">Mis empresas
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
                    <h4 class="card-title">Mis empresas</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>RUC</th>
                                        <th>Celular</th>
                                        <th>Distrito</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($empresas as $empresa)
                                        <tr>
                                            <td>{{$empresa->nombre}}</td>
                                            <td>{{$empresa->ruc}}</td>
                                            <td>{{$empresa->celular}}</td>
                                            <td>{{$empresa->distrito}}</td>
                                            <td>
                                                <a href="/admin/empresa/{{$empresa->id}}" class="mr-2" title="Editar"><i class="ft-edit success"></i></a>
                                                <a href="" title="Eliminar"><i class="ft-delete red"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#empresa">
                                Nueva Empresa
                             </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade " id="empresa" tabindex="-1" role="dialog" aria-labelledby="  " aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Nueva empresa</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form-empresa-register></form-empresa-register>
      </div>
    </div>
</div>

@endsection
