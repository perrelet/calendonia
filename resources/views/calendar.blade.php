<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Calendonia</title>

        <link href='{{ url("/css/{$template}.css?v=1.0.2") }}' rel='stylesheet'>
        <link href='{{ url("/css/normalize.css") }}' rel='stylesheet'>
        
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">

    </head>
    <body>
        <x-events :args="$args" :events="$events" :grouped="$grouped" :component="$component" />
    </body>
</html>