@php $prefix = $prefix ?? ''; @endphp

<section id="home" class="relative scroll-mt-28 overflow-hidden">
  {{-- BACKGROUND LAYER (z-0) --}}
  <div class="absolute inset-0 -z-10">
  <div class="absolute inset-0 bg-gradient-to-br from-indigo-600 via-indigo-200 to-indigo-600"></div>
  <div class="absolute inset-0 pointer-events-none
       [background:radial-gradient(700px_450px_at_32%_42%,rgba(255,255,255,.9),transparent_70%)]"></div>
  <div class="absolute inset-0 mix-blend-overlay opacity-40
       [background-image:repeating-linear-gradient(-45deg,rgba(255,255,255,.22)_0_1px,transparent_1px_12px)]"></div>


    {{-- mesh blobs --}}
    <div class="absolute -top-24 -left-24 h-72 w-72 rounded-full bg-primary/25 blur-3xl"></div>
    <div class="absolute -bottom-28 -right-20 h-80 w-80 rounded-full bg-accent/25 blur-3xl"></div>

    {{-- subtle diagonal stripes --}}
    <div class="absolute inset-0 mix-blend-overlay opacity-60
                [background-image:repeating-linear-gradient(45deg,transparent_0_10px,rgba(255,255,255,.18)_10px_11px)]"></div>

    {{-- dotted grid (kanan bawah) --}}
    <svg class="absolute bottom-6 right-6 hidden lg:block opacity-60"
         width="220" height="160" viewBox="0 0 220 160" fill="none" aria-hidden="true">
      <defs>
        <pattern id="dots" x="0" y="0" width="12" height="12" patternUnits="userSpaceOnUse">
          <circle cx="1.6" cy="1.6" r="1.6" class="fill-white/40"/>
        </pattern>
      </defs>
      <rect width="220" height="160" fill="url(#dots)"/>
    </svg>
  </div>

  {{-- CONTENT LAYER (z-10) --}}
  <div class="relative z-10 container mx-auto lg:max-w-screen-xl md:max-w-screen-md px-10 py-14">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
      {{-- Left: Text --}}
      <div class="col-span-6 flex flex-col gap-8" data-aos="fade-right">
        <div class="flex gap-2 mx-auto lg:mx-0 items-center">
          <iconify-icon icon="solar:verified-check-bold" class="text-green-600 text-xl"></iconify-icon>
          <p class="text-green-700 text-sm font-semibold">Bangun Websitemu Sekarang</p>
        </div>

        <h1 class="text-gray-900 text-4xl sm:text-5xl font-bold">
          OLYMPUS PROJECT
        </h1>
        <h3 class="text-gray-700 text-lg max-w-2xl">
          Bangun website bisnismu dan tingkatkan jangkauannya
        </h3>

        <div class="flex flex-wrap items-center gap-x-10 gap-y-4 pt-2">
          <div class="flex items-center gap-2">
            <img src="{{ asset($prefix.'images/banner/check-circle.svg') }}" alt="check" width="26" height="26">
            <p class="text-base sm:text-lg text-gray-900">Website</p>
          </div>
          <div class="flex items-center gap-2">
            <img src="{{ asset($prefix.'images/banner/check-circle.svg') }}" alt="check" width="26" height="26">
            <p class="text-base sm:text-lg text-gray-900">Mobile</p>
          </div>
          <div class="flex items-center gap-2">
            <img src="{{ asset($prefix.'images/banner/check-circle.svg') }}" alt="check" width="26" height="26">
            <p class="text-base sm:text-lg text-gray-900">Landing Page</p>
          </div>
        </div>
      </div>

      {{-- Right: Image --}}
      <div class="col-span-6 flex justify-center" data-aos="fade-left" data-aos-delay="120">
        <img
          src="{{ asset($prefix.'images/banner/baner.png') }}"
          alt="Hero image"
          width="1000" height="805"
          class="h-auto w-full max-w-[900px] rounded-2xl drop-shadow-2xl"
          loading="eager" decoding="async">
      </div>
    </div>
  </div>
</section>
