<!DOCTYPE html>
<html lang="{{ str_replace('_','-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>{{ config('app.name', 'Olympus Project') }}</title>



  {{-- Fonts (opsional) --}}
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

  {{-- Swiper & Iconify (boleh via CDN) --}}
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <script defer src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <script defer src="https://code.iconify.design/iconify-icon/1.0.8/iconify-icon.min.js"></script>

  {{-- 2) Vite assets (Tailwind v4 + JS kamu) --}}
  @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body class="antialiased overflow-x-hidden">

  <x-navbar />

  <main class="pt-18">
    {{ $slot }}
  </main>

  <x-footer />
</body>
</html>
