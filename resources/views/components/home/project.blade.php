{{-- resources/views/components/portfolio-swiper.blade.php --}}
@php
    use Illuminate\Support\Str;
    use Illuminate\Support\Facades\Storage;
    use Illuminate\Support\Carbon;
    use Illuminate\Support\Facades\Route;

    $title    = $title ?? 'Portfolio';
    $swiperId = $swiperId ?? 'portfolio-swiper';

    // Map data DB -> data kartu
    $cards = collect($portos ?? [])->map(function ($p) {
        $cover = is_array($p->image) ? ($p->image[0] ?? null) : $p->image;
        $coverUrl = $cover ? Storage::url($cover) : asset('images/placeholder.webp');

        $date = null;
        if (!empty($p->create_date)) {
            try { $date = Carbon::parse($p->create_date)->translatedFormat('d M Y'); } catch (\Exception $e) {}
        }

        return [
            'id'        => $p->id,
            'title'     => $p->name,
            'subtitle'  => Str::limit(strip_tags($p->description ?? ''), 160),
            'cover'     => $coverUrl,
            'date'      => $date,
            'url'       => Route::has('portfolio.show') ? route('portfolio.show', $p->id) : '#',
        ];
    });
@endphp

@once
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
  <script defer src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
@endonce

<section class="py-10 bg-gray-50">
  <div class="container mx-auto lg:max-w-screen-xl md:max-w-screen-md px-4">
    <div class="flex items-center justify-between mb-10">
      <h2 class="text-3xl md:text-4xl font-semibold">{{ $title }}</h2>
      @if(Route::has('home'))
        <a href="{{ route('project') }}" class="text-primary font-medium hover:tracking-widest transition">Lihat semua &gt;</a>
      @endif
    </div>

    @if($cards->isEmpty())
      <div class="text-center text-gray-500 py-16">Belum ada data portofolio.</div>
    @else
      <div class="swiper" id="{{ $swiperId }}">
        <div class="swiper-wrapper">
          @foreach($cards as $c)
            <div class="swiper-slide">
              <div class="relative flex w-full max-w-[26rem] flex-col rounded-xl bg-white bg-clip-border text-gray-700 shadow-lg">
                {{-- TOP IMAGE --}}
                <div class="relative mx-4 mt-4 overflow-hidden rounded-xl bg-blue-gray-500 bg-clip-border text-white shadow-lg shadow-blue-gray-500/40">
                  <img src="{{ $c['cover'] }}" alt="{{ $c['title'] }}" class="w-full h-60 object-cover" loading="lazy" decoding="async">
                  <div class="to-bg-black-10 absolute inset-0 h-full w-full bg-gradient-to-tr from-transparent via-transparent to-black/60"></div>

                  {{-- Small round button with logo --}}
                  <button
                    class="!absolute top-4 right-4 h-8 max-h-[32px] w-8 max-w-[32px] select-none rounded-full text-center align-middle font-sans text-xs font-medium uppercase text-purple-500 transition-all hover:bg-purple-500/10 active:bg-purple-500/30 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                    type="button">
                    <span class="absolute top-1/5 left-1/5 -translate-y-1/5 -translate-x-1/5 transform">
                      <img src="{{ asset('default/logo2.png') }}" alt="logo" class="w-5 h-5 object-contain">
                    </span>
                  </button>
                </div>

                {{-- BODY --}}
                <div class="p-6">
                  <div class="mb-3 flex items-center justify-between">
                    <h5 class="block font-sans text-xl font-medium leading-snug tracking-normal text-blue-gray-900 antialiased">
                      {{ $c['title'] }}
                    </h5>

                    <p class="flex items-center gap-1.5 font-sans text-base font-normal leading-relaxed text-blue-gray-900 antialiased">
                      {{-- Calendar icon (inline SVG) + tanggal --}}
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                           fill="currentColor" class="-mt-0.5 h-5 w-5 text-yellow-700">
                        <path d="M6 2a1 1 0 0 1 1 1v1h6V3a1 1 0 1 1 2 0v1h1.5A1.5 1.5 0 0 1 18 5.5V7H2V5.5A1.5 1.5 0 0 1 3.5 4H5V3a1 1 0 0 1 1-1Z"/>
                        <path d="M2 8h16v6.5A1.5 1.5 0 0 1 16.5 16h-13A1.5 1.5 0 0 1 2 14.5V8Z"/>
                      </svg>
                      {{ $c['date'] ?: '—' }}
                    </p>
                  </div>

                  @if($c['subtitle'])
                    <p class="block font-sans text-base font-light leading-relaxed text-gray-700 antialiased">
                      {{ $c['subtitle'] }}
                    </p>
                  @endif
                </div>

                {{-- CTA --}}
                <div class="p-6 pt-3">
                  <a href="{{ $c['url'] }}"
                     class="block w-full select-none rounded-lg bg-blue-500 py-3.5 px-7 text-center align-middle font-sans text-sm font-bold uppercase text-white shadow-md shadow-blue-500/20 transition-all hover:shadow-lg hover:shadow-blue-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none">
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
          new Swiper('#{{ $swiperId }}', {
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
