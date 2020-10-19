@extends('layouts.landing_pages')

@section('title')
    TE ENVIO
@endsection

@section('styles')

@endsection

@section('content')
    <tenvio-padre-component></tenvio-padre-component>
@endsection

@section('clasesfooter')
    style-02 bg-blue
@endsection


@section('script')
    <script>
        let tiponegocios = @json($tiponegocios);
    </script>
@endsection



