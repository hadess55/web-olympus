@once
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
  <script defer src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
@endonce
 
<section class="py-10 bg-gray-50">
  <div class="container mx-auto lg:max-w-screen-xl md:max-w-screen-md px-4">
    <div class="flex items-center justify-between mb-10">
      <h2 class="text-3xl md:text-4xl font-semibold">{{ $title ?? 'Portfolio' }}</h2>
      <a href="{{ $seeAllUrl ?? (Route::has('portfolio.index') ? route('portfolio.index') : url('/project')) }}"
         class="text-primary font-medium hover:tracking-widest transition">
        Lihat semua &gt;
      </a>
    </div>

    @if(!isset($portos) || $portos->isEmpty())
      <div class="text-center text-gray-500 py-16">Belum ada data portofolio.</div>
    @else
      <div class="swiper" id="{{ $swiperId ?? 'portfolio-swiper' }}">
        <div class="swiper-wrapper">
          @foreach($portos as $p)
            <div class="swiper-slide">
              <div class="relative flex w-full max-w-[26rem] flex-col rounded-xl bg-white bg-clip-border text-gray-700 shadow-lg">
                {{-- TOP IMAGE --}}
                <div class="relative mx-4 mt-4 overflow-hidden rounded-xl bg-clip-border text-white shadow-lg">
                  <img
                    src="{{ $p->cover_url }}"
                    alt="{{ $p->name }}"
                    width="768" height="480"
                    class="w-full h-60 object-cover" loading="lazy" decoding="async">
                  <div class="absolute inset-0 h-full w-full bg-gradient-to-tr from-transparent via-transparent to-black/60"></div>

                  <button
                    class="!absolute top-4 right-4 h-8 w-8 select-none rounded-full text-purple-500 transition-all hover:bg-purple-500/10 active:bg-purple-500/30"
                    type="button" aria-label="Brand">
                    <span class="absolute top-1/5 left-1/5 -translate-y-1/5 -translate-x-1/5 transform">
                      <img src="{{ asset('default/logo2.png') }}" alt="logo" class="w-5 h-5 object-contain">
                    </span>
                  </button>
                </div>

                {{-- BODY --}}
                <div class="p-6">
                  <div class="mb-3 flex items-center justify-between">
                    <h5 class="text-xl font-medium text-blue-gray-900">{{ $p->name }}</h5>
                    <p class="flex items-center gap-1.5 text-base text-blue-gray-900">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                           fill="currentColor" class="-mt-0.5 h-5 w-5 text-yellow-700">
                        <path d="M6 2a1 1 0 0 1 1 1v1h6V3a1 1 0 1 1 2 0v1h1.5A1.5 1.5 0 0 1 18 5.5V7H2V5.5A1.5 1.5 0 0 1 3.5 4H5V3a1 1 0 0 1 1-1Z"/>
                        <path d="M2 8h16v6.5A1.5 1.5 0 0 1 16.5 16h-13A1.5 1.5 0 0 1 2 14.5V8Z"/>
                      </svg>
                      {{ $p->formatted_date ?? '—' }}
                    </p>
                  </div>

                  @if($p->excerpt)
                    <p class="text-base font-light leading-relaxed text-gray-700">{{ $p->excerpt }}</p>
                  @endif
                </div>

                {{-- CTA --}}
                <div class="p-6 pt-3">
                  <a href="{{ Route::has('portfolio.show') ? route('portfolio.show', $p->id) : '#' }}"
                     class="block w-full rounded-lg bg-blue-500 py-3.5 px-7 text-center text-sm font-bold uppercase text-white shadow-md shadow-blue-500/20 transition-all hover:shadow-lg hover:shadow-blue-500/40">
                    Detail
                  </a>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>

      <script>
        document.addEventListener('DOMContentLoaded', function () {
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
        });
      </script>
    @endif
  </div>
</section>
