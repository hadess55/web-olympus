{{-- resources/views/components/companies.blade.php --}}
@php
  $companies = $companies ?? [
    ['imgSrc' => 'images/tools/tailwind.svg', 'alt' => 'Tailwind'],
    ['imgSrc' => 'images/tools/hostinger.svg', 'alt' => 'Hostinger'],
    ['imgSrc' => 'images/tools/javascript.svg', 'alt' => 'Javascript'],
    ['imgSrc' => 'images/tools/laravel.svg', 'alt' => 'Laravel'],
    ['imgSrc' => 'images/tools/react.svg', 'alt' => 'React'],
    ['imgSrc' => 'images/tools/figma.svg', 'alt' => 'Figma'],
    // ['imgSrc' => 'images/tools/bootstrap.svg', 'alt' => 'Bootstrap'],
  ];

  $prefix = $prefix ?? '';
@endphp

<section class="text-center">
  <div class="container mx-auto lg:max-w-screen-xl md:max-w-screen-md px-4 py-10">
    <h2 class="text-midnight_text text-2xl font-semibold">Tools trusted by the Olympus Project company</h2>

    <div class="py-14 relative">
      <div class="overflow-hidden">
        <ul class="flex items-center gap-8 animate-logo-scroll will-change-transform"
            aria-label="Trusted companies">
          @foreach([$companies, $companies] as $loopSet)
            @foreach($loopSet as $item)
              <li class="shrink-0 flex items-center justify-center w-[120px] md:w-[150px]">
                <img
                  src="{{ asset($prefix.$item['imgSrc']) }}"
                  alt="{{ $item['alt'] ?? 'Company logo' }}"
                  width="260" height="90"
                  class="h-16 w-auto opacity-90 hover:opacity-100 transition"
                  loading="lazy" decoding="async">
              </li>
            @endforeach
          @endforeach
        </ul>
      </div>
    </div>
  </div>

  <style>
    @keyframes logo-scroll {
      0%   { transform: translateX(0); }
      100% { transform: translateX(-50%); } /* Karena kita gandakan list-nya 2x */
    }
    .animate-logo-scroll {
      animation: logo-scroll 20s linear infinite;
    }

    /* Responsif: percepat/kurangi kecepatan di layar kecil */
    @media (max-width: 700px) {
      .animate-logo-scroll { animation-duration: 16s; }
    }
    @media (max-width: 500px) {
      .animate-logo-scroll { animation-duration: 14s; }
    }
  </style>
</section>
