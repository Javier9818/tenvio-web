<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis carros</title>
</head>
<body>   
    @foreach ($carros as $car)
        <p>{{$car->nombre}}</p>
        <p>{{$car->color}}</p>
        <a href="/car/{{$car->id}}">Editar</a>
        <br>
    @endforeach
    <a href="/crear-carro">Nuevo</a>
</body>
</html>