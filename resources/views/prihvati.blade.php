<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
</head>
<body>
    
<div class="grid h-screen place-items-center">
    <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow">
        <a href="#">
            <img class="rounded-t-lg w-fit mx-auto" style="max-width: 280px;" src="{{ asset('images/nummus.png') }}" alt="" />
        </a>
        <div class="p-5">
            <a href="#">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">Pozivnica za registraciju na sajtu za računovođe, "Nummus".</h5>
            </a>
            <br>
            <p class="mb-3 font-medium text-gray-700 mt-4"><span class="mb-3 font-bold text-red-700">Upozorenje: </span><br><u>Ovaj link se može iskoristiti samo jednom i automatski će se uništiti.</u></p><br>
            <div 
                style="cursor: pointer;" 
                class="mx-auto px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300" 
                onclick="window.location.assign('http:'+ '/' + '/' + '{{$invite->subdomain}}.localhost:8000/users/create')">
                Registracija
            </div>
        </div>
    </div>
</div>
</body>
</html>