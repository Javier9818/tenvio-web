<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear</title>
</head>
<body>
    <form action="/car/{{$carro->id ?? ''}}" method="POST">
        @csrf
        @if(isset($carro))
            @method('put')
            <input type="text" placeholder="Nombre" name="nombre" id="nombre" value="{{$carro->nombre ?? ''}}">
            <input type="text" placeholder="Color" name="color" id="color" value="{{$carro->color ?? ''}}">
            <button type="submit">Actualizar</button>
        @else
            <input type="text" placeholder="Nombre" name="nombre" id="nombre">
            <input type="text" placeholder="Color" name="color" id="color">
            <button type="submit">Registrar</button>    
        @endif
    </form>
</body>
</html>