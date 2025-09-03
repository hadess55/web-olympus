@once
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
  <script defer src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
@endonce

@php
  $techMap = [
    'tailwind'  => ['label' => 'Tailwind CSS',     'icon' => 'tailwind',  'class' => 'bg-[#E0F2FE] text-[#0EA5E9] ring-[#BAE6FD]'],
    'bootstrap' => ['label' => 'Bootstrap',        'icon' => 'bootstrap', 'class' => 'bg-[#EFE2FF] text-[#7C3AED] ring-[#E9D5FF]'],
    'react'     => ['label' => 'React',            'icon' => 'react',     'class' => 'bg-[#E8F9FF] text-[#06B6D4] ring-[#CFFAFE]'],
    'flutter'   => ['label' => 'Flutter',          'icon' => 'flutter',   'class' => 'bg-[#E6F1FF] text-[#1E88E5] ring-[#C7E0FF]'],
    'wordpress' => ['label' => 'WordPress',        'icon' => 'wordpress', 'class' => 'bg-[#E9F2FF] text-[#1A76B8] ring-[#CDE2FA]'],
    'alpine'    => ['label' => 'Alpine.js',        'icon' => 'alpine',    'class' => 'bg-[#E8EDFF] text-[#1C3FAA] ring-[#D5DEFF]'],
    'laravel'   => ['label' => 'Laravel',          'icon' => 'laravel',   'class' => 'bg-[#FEE2E2] text-[#E11D48] ring-[#FECACA]'],
    'javascript' => ['label' => 'JavaScript',      'icon'  => 'javascript','class' => 'bg-[#FFF9C4] text-[#000000] ring-[#F7DF1E]',],
    'nextjs'    => ['label' => 'Next.js',          'icon' => 'nextjs',    'class' => 'bg-gray-100 text-gray-900 ring-gray-200'],
  ];
@endphp

<section id="portfolio" class="py-16 bg-[#f6f8ff] scroll-mt-28">
  <div class="container mx-auto lg:max-w-screen-xl md:max-w-screen-md px-4">
    <div class="flex items-center justify-between mb-10">
      <h2 class="text-3xl md:text-4xl font-semibold text-gray-900">
        Project
      </h2>
      <a href="{{ $seeAllUrl ?? (Route::has('portfolio.index') ? route('portfolio.index') : url('/project')) }}"
         class="text-primary font-medium hover:tracking-widest transition">
        Lihat semua &gt;
      </a>
    </div>

    @if(!isset($portos) || $portos->isEmpty())
      <div class="text-center text-gray-500 py-16">Belum ada data Project.</div>
    @else
      <div class="swiper" id="{{ $swiperId ?? 'portfolio-swiper' }}">
        <div class="swiper-wrapper">
          @foreach($portos as $p)
            <div class="swiper-slide">
              {{-- GRADIENT BORDER WRAP --}}
              <div
                class="pf-wrap"
              >
                <article
                  class="pf-card pf-reveal relative w-full max-w-[26rem] flex-col rounded-2xl
                         bg-white text-gray-700 shadow-[0_12px_30px_-12px_rgba(0,0,0,.18)]
                         hover:shadow-[0_22px_60px_-22px_rgba(99,102,241,.35)]
                         transition-transform duration-300 hover:-translate-y-[6px]"
                  style="--delay: {{ $loop->index * 90 }}ms"
                >
                  {{-- TOP IMAGE --}}
                  <div class="pf-img relative mx-4 mt-2 overflow-hidden rounded-xl bg-clip-border">
                    <img
                      src="{{ $p->cover_url }}"
                      alt="{{ $p->name }}"
                      width="768" height="480"
                      class="w-full h-60 object-cover" loading="lazy" decoding="async">
                    {{-- overlay gradient halus --}}
                    <div class="absolute inset-0 bg-gradient-to-tr from-transparent via-transparent to-black/20"></div>
                    {{-- shine sweep --}}
                    <span class="pf-shine"></span>

                    <button
                      class="absolute top-4 right-4 h-8 w-8 select-none rounded-full text-purple-500 transition
                             hover:bg-purple-500/10 active:bg-purple-500/30"
                      type="button" aria-label="Brand"
                    >
                      <img src="{{ asset('default/logo2.png') }}" alt="logo" class="w-5 h-5 object-contain mx-auto">
                    </button>
                  </div>

                  {{-- BODY --}}
                  <div class="p-6">
                    <div class="flex items-center justify-between">
                      <h5 class="text-xl font-semibold text-gray-900">
                        {{ $p->name }}
                      </h5>
                      
                      <p class="flex items-center gap-1.5 text-base text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                             fill="currentColor" class="-mt-0.5 h-5 w-5 text-indigo-600">
                          <path d="M6 2a1 1 0 0 1 1 1v1h6V3a1 1 0 1 1 2 0v1h1.5A1.5 1.5 0 0 1 18 5.5V7H2V5.5A1.5 1.5 0 0 1 3.5 4H5V3a1 1 0 0 1 1-1Z"/>
                          <path d="M2 8h16v6.5A1.5 1.5 0 0 1 16.5 16h-13A1.5 1.5 0 0 1 2 14.5V8Z"/>
                        </svg>
                        {{ $p->formatted_date ?? '—' }}
                      </p>
                    </div>

                  @php $max = 3; @endphp
                  <div class="mt-2 flex flex-wrap gap-2">
                    @foreach(array_slice($p->technologies, 0, $max) as $key)
                      @php
                          $m = $techMap[$key] ?? ['label' => ucfirst($key), 'icon' => null, 'class' => 'bg-gray-100 text-gray-700 ring-gray-200'];
                        @endphp
                        <span class="inline-flex items-center gap-1.5 px-2 py-1 rounded-md text-xs font-medium
                                    ring-1 ring-inset {{ $m['class'] }}">
                          @if($m['icon'])
                            <img src="{{ asset('tech-icons/'.$m['icon'].'.svg') }}" alt="{{ $m['label'] }}"
                                class="h-3.5 w-3.5 shrink-0" loading="lazy" decoding="async">
                          @endif
                          {{ $m['label'] }}
                        </span>
                    @endforeach

                    @if(count($p->technologies) > $max)
                      <span class="px-2 py-1 rounded-md text-xs font-medium ring-1 ring-inset
                                  bg-gray-100 text-gray-700 ring-gray-200">
                        +{{ count($p->technologies) - $max }} lainnya
                      </span>
                    @endif
                  </div>

                    @if($p->excerpt)
                      <p class="text-base leading-relaxed text-gray-700 mt-2">
                        {{ $p->excerpt }}
                      </p>
                    @endif
                  </div>

                  {{-- CTA --}}
                  <div class="p-6 pt-3">
                    <a href="{{ route('project.show', $p->slug) }}"
                       class="block w-full rounded-lg bg-indigo-500 py-3.5 px-7 text-center text-sm font-bold uppercase
                              text-white shadow-md shadow-indigo-500/20 transition hover:shadow-lg hover:shadow-indigo-500/40">
                      Detail
                    </a>
                  </div>
                </article>
              </div>
            </div>
          @endforeach
        </div>
      </div>

      <style>
        /* Reveal berurutan */
        @keyframes pf-in {
          0% { opacity: 0; transform: translateY(14px) scale(.98); }
          100% { opacity: 1; transform: translateY(0) scale(1); }
        }
        .pf-reveal { opacity: 0; }
        .pf-reveal.pf-show { animation: pf-in .6s ease-out forwards; animation-delay: var(--delay, 0ms); }

        /* Shine di gambar */
        .pf-img { position: relative; }
        .pf-img .pf-shine{
          position:absolute; inset:0; pointer-events:none;
          background: linear-gradient(100deg, transparent 0%, rgba(255,255,255,.22) 12%, transparent 24%);
          transform: translateX(-120%);
          transition: transform .7s ease;
        }
        .pf-card:hover .pf-shine{ transform: translateX(120%); }
      </style>

      <script>
        document.addEventListener('DOMContentLoaded', function () {
          // Swiper
          new Swiper('#{{ $swiperId ?? 'portfolio-swiper' }}', {
            loop: true,
            speed: 600,
            grabCursor: true,
            autoplay: { delay: 2500, disableOnInteraction: false },
            spaceBetween: 28,
            slidesPerView: 3,
            breakpoints: {
              0:   { slidesPerView: 1, spaceBetween: 16 },
              768: { slidesPerView: 2, spaceBetween: 22 },
              1280:{ slidesPerView: 3, spaceBetween: 28 },
            },
          });

          // Reveal saat section masuk viewport
          const sec = document.querySelector('#portfolio');
          const io = new IntersectionObserver((entries) => {
            entries.forEach(e => {
              if (e.isIntersecting) {
                sec.querySelectorAll('.pf-reveal').forEach((el) => el.classList.add('pf-show'));
                io.disconnect();
              }
            });
          }, { threshold: 0.2 });
          io.observe(sec);
        });
      </script>
    @endif
  </div>
</section>
