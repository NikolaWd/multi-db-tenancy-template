<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <label for="name">Unesite ime</label>
        <input type="text" name="name" id="name" placeholder="Unesite ime"><br>
        <label for="email">Email adresa</label>
        <input type="email" name="email" id="email" value="{{tenant('email')}}" readonly><br>
        <label for="password">Unesite lozinku</label>
        <input type="password" name="password" id="password"><br>

        <input type="submit" name="create_user_tenant" id="create_user_tenant" value="Registruj se">
    </form>
</body>
</html>