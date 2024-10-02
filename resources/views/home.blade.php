<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="/img/icon.png">
    <title>EduConnect: Inicio</title>

    @viteReactRefresh
    @vite('resources/Home/main.tsx')
</head>
<body>
    <div id="app"></div>
</body>
</html>
