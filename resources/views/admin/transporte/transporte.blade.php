@extends('layouts.admin')
@section('title') Transporte  @endsection
@section('nav')
    {{-- @include('admin.components.nav') --}}
@endsection

@section('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
    integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
    crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
    integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
    crossorigin=""></script>
@endsection

@section('sideNav')
    <x-side-nav tab="6" selected='1'/>
@endsection

@section('content')
<section>
    <div class="row" >
        <div class="col-12">
            <div class="card">
                <div class="card-content collapse show" >
                    <div class="card-body">
                        <transporte-component></transporte-component>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

{{--
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
    integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
    crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
    integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
    crossorigin=""></script>
</head>
<body>

    <div id="app">
        <mapa-interactivo height='90vh' width='100%' latlng='nada' ></mapa-interactivo>
    </div>

    <script src="/js/app.js" type="text/javascript"></script>
    <script>
        let coords = null;
    </script>

</body>
</html> --}}






