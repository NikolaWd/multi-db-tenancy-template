<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1 align="center">Ovo je ruta "/" iz tenant.php routes.</h1>
    <br><br><br>
    <h3>Spisak svih klijenata</h3>
    <div>
        <ul>
            @foreach ($users as $user)
                <li>Ime: {{$user->name}}</li>
                <li>Email: {{$user->email}}</li>
                <li>Kreiran: {{$user->created_at}}</li>
            @endforeach
        </ul>
    </div>

    <h2>{{ tenant('name') }}</h2>

    <a href="{{url('/')}}">Nazad na glavni sajt</a>
</body>
</html>