{{-- resources/views/components/hero.blade.php --}}
@php

  $prefix = $prefix ?? '';
@endphp

<section id="home-section" class="bg-blue-100">
  <div class="container mx-auto lg:max-w-screen-xl md:max-w-screen-md px-10 py-10">
    <div class="grid grid-cols-1 lg:grid-cols-12 space-x-1 items-center">
      {{-- Left: Text --}}
      <div class="col-span-6 flex flex-col gap-8">
        <div class="flex gap-2 mx-auto lg:mx-0 items-center">
          <iconify-icon icon="solar:verified-check-bold" class="text-success text-xl inline-block me-2"></iconify-icon>
          <p class="text-success text-sm font-semibold text-center lg:text-start">Get 30% off on first enroll</p>
        </div>

        <h1 class="text-midnight_text text-4xl sm:text-5xl font-semibold pt-5 lg:pt-0">
          Advance your engineering skills with us.
        </h1>
        <h3 class="text-black/70 text-lg pt-5 lg:pt-0">
          Build skills with our courses and mentor from world-class companies.
        </h3>

        {{-- Search --}}
        <div class="relative rounded-full pt-5 lg:pt-0 bg-white">
          <input
            type="email"
            name="q"
            class="py-6 lg:py-8 pl-8 pr-20 text-lg w-full text-black rounded-full focus:outline-none shadow-input-shadow"
            placeholder="search courses..."
            autocomplete="off"
          />
          <button class="bg-secondary p-5 rounded-full absolute right-2 top-2" aria-label="Search">
            <iconify-icon icon="solar:magnifer-linear" class="text-white text-4xl inline-block"></iconify-icon>
          </button>
        </div>

        {{-- Points --}}
        <div class="flex items-center justify-between pt-10 lg:pt-4">
          <div class="flex gap-2 items-center">
            <img src="{{ asset($prefix.'images/banner/check-circle.svg') }}" alt="check" width="30" height="30" class="smallImage">
            <p class="text-sm sm:text-lg font-normal text-black">Flexible</p>
          </div>
          <div class="flex gap-2 items-center">
            <img src="{{ asset($prefix.'images/banner/check-circle.svg') }}" alt="check" width="30" height="30" class="smallImage">
            <p class="text-sm sm:text-lg font-normal text-black">Learning path</p>
          </div>
          <div class="flex gap-2 items-center">
            <img src="{{ asset($prefix.'images/banner/check-circle.svg') }}" alt="check" width="30" height="30" class="smallImage">
            <p class="text-sm sm:text-lg font-normal text-black">Community</p>
          </div>
        </div>
      </div>

      {{-- Right: Image --}}
      <div class="col-span-6 flex justify-center">
        <img
          src="{{ asset($prefix.'images/banner/mahila.png') }}"
          alt="Hero image"
          width="1000"
          height="805"
          class="h-auto w-full max-w-[1000px]"
          loading="eager"
          decoding="async"
        >
      </div>
    </div>
  </div>
</section>
