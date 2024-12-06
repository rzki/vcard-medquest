<!DOCTYPE html>
<html lang="en">
<head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite('resources/sass/app.scss')
    <style>
        .btn-primary-color{
        background-color: #111398;
        color: #f1f1f1;
        }
        .text-primary{
        color: #111398 !important;
        }
    </style>
</head>
<body>

<div class="row min-vh-100 g-0 auth-row">
    @yield('content')
</div>
</body>
</html>
