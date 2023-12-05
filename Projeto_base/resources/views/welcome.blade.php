<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Celke</title>
        
    </head>
    <body>
        
        <h1>Meu projeto com Laravel</h1>

        <a href="{{ route('course.index')}}">Listar os Cursos</a>

    </body>
</html>
