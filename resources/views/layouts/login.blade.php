<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
   
    <link rel="icon" href="{{ asset('images/favicon.ico')}}" type="image/x-icon">
    {{-- vite para incluir o css e js --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
   
    <title>Emprel</title>
  </head>

<body class="bg-danger">

  @yield('content')
  
</body>

</html>