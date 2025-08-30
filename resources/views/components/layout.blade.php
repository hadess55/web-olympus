<!DOCTYPE html>
<html lang="{{ str_replace('_','-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>{{ config('app.name', 'Olympus Project') }}</title>

  {{-- 1) BOOT THEME LEBIH DULU: pasang class `dark` SEBELUM CSS agar tidak FOUC --}}
  <script>
    (function () {
    const saved = localStorage.getItem('theme');
    if (saved === 'dark') {
      document.documentElement.classList.add('dark');
    } else {
      document.documentElement.classList.remove('dark');
    }
  })();
  </script>

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

{{-- beri default warna berdasarkan token --}}
<body class="antialiased bg-bg text-text">
  <x-navbar />

  <main class="pt-18">
    {{ $slot }}
  </main>

  <x-footer />
</body>
</html>
