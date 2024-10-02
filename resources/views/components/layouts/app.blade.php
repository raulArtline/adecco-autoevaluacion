<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, viewport-fit=cover">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}">
  <title>{{ $title ?? 'Autoevaluación Liderazgo inclusivo' }}</title>

  <!-- Etiquetas Open Graph -->
  <meta property="og:title" content="Autoevaluación Liderazgo inclusivo">
  <meta property="og:description" content="Reflexiona y evalúa tu liderazgo inclusivo o para la inclusión.">
  <meta property="og:image" content="{{ asset('img/portada.webp') }}">
  <meta property="og:type" content="website">

  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>


<body>
  <main>
    {{ $slot }}
  </main>
</body>

</html>
