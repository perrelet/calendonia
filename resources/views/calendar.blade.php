<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Calendonia</title>

        <link href='{{ url("/css/{$template}.css?v=1.0.5") }}' rel='stylesheet'>
        <link href='{{ url("/css/normalize.css") }}' rel='stylesheet'>
        
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/iframe-resizer/4.3.2/iframeResizer.contentWindow.js" integrity="sha512-cJ7aOLpXbec1Km9craM6xL6UOdlWf9etIz7f+cwQv2tuarLm3PLb3dv3ZqIK++SE4ui+EE0nWqKB0dOaAOv9gQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        @includeIf("components.event.scripts.{$template}_scripts")

    </head>
    <body class='align-{{$args['align']}}'>
        @if(View::exists("components.events.{$template}"))
            @include("components.events.{$template}")
        @else
            <x-events :events="$events" :grouped="$grouped" :component="$component" />
        @endif
    </body>
</html>