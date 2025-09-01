{{-- resources/views/components/companies.blade.php --}}
@php
  $companies = $companies ?? [
    ['imgSrc' => 'images/tools/tailwind.svg', 'alt' => 'Tailwind'],
    ['imgSrc' => 'images/tools/hostinger.svg', 'alt' => 'Hostinger'],
    ['imgSrc' => 'images/tools/javascript.svg', 'alt' => 'Javascript'],
    ['imgSrc' => 'images/tools/laravel.svg', 'alt' => 'Laravel'],
    ['imgSrc' => 'images/tools/react.svg', 'alt' => 'React'],
    ['imgSrc' => 'images/tools/figma.svg', 'alt' => 'Figma'],
  ];
  $prefix = $prefix ?? '';

  // untuk animasi stagger awal
  $i = 0;
@endphp

<section id="tools" class="relative text-center scroll-mt-28">
  <div class="pointer-events-none absolute inset-0 -z-10">
    <div class="absolute -top-16 -left-16 h-40 w-40 rounded-full bg-primary/20 blur-3xl dark:bg-primary/10"></div>
    <div class="absolute -bottom-16 -right-16 h-48 w-48 rounded-full bg-accent/20 blur-3xl dark:bg-accent/10"></div>
  </div>

  <div class="container mx-auto lg:max-w-screen-xl md:max-w-screen-md px-4 py-10">
    <h2 class="text-2xl font-semibold text-gray-900">
      Tools trusted by the Olympus Project company
    </h2>

    <div class="py-14 relative">
      <div class="overflow-hidden">
        {{-- Track: gandakan 2x agar loop mulus --}}
        <ul class="flex items-center gap-8 animate-logo-scroll will-change-transform"
            aria-label="Trusted companies">
          @foreach([$companies, $companies] as $loopSet)
            @foreach($loopSet as $item)
              <li class="logo-item shrink-0 flex items-center justify-center w-[120px] md:w-[150px]"
                  style="--d: {{ $i++ }}">
                <img
                  src="{{ asset($prefix.$item['imgSrc']) }}"
                  alt="{{ $item['alt'] ?? 'Company logo' }}"
                  width="260" height="90"
                  class="h-12 md:h-16 w-auto opacity-90 hover:opacity-100 transition
                         dark:opacity-90"
                  loading="lazy" decoding="async">
              </li>
            @endforeach
          @endforeach
        </ul>
      </div>
    </div>
  </div>

  <style>
    /* marquee */
    @keyframes logo-scroll {
      0%   { transform: translateX(0); }
      100% { transform: translateX(-50%); } /* karena list digandakan 2x */
    }
    .animate-logo-scroll { animation: logo-scroll 20s linear infinite; }
    @media (max-width: 700px) { .animate-logo-scroll { animation-duration: 16s; } }
    @media (max-width: 500px) { .animate-logo-scroll { animation-duration: 14s; } }

    /* fade-in berurutan saat mulai */
    @keyframes logo-fade-in {
      0%   { opacity: 0; transform: translateY(10px) scale(.98); }
      100% { opacity: 1; transform: translateY(0) scale(1); }
    }
    .logo-item {
      opacity: 0;
      animation: logo-fade-in .6s ease-out forwards;
      /* jeda per item (stagger) */
      animation-delay: calc(var(--d) * 90ms);
    }
  </style>
</section>
