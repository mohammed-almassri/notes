<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>
    {{-- @vite(['resources/js/app.js', 'resources/sass/style.scss']) --}}
    <link rel="stylesheet" href="{{ mix('css/style.css') }}">
    <script type="module" src="{{ mix('js/app.js') }}"></script>
</head>

<body>
    <div id="app"></div>
</body>

</html>
