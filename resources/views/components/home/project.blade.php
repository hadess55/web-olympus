{{-- resources/views/components/portfolio-swiper.blade.php --}}
@php
    use Illuminate\Support\Str;
    use Illuminate\Support\Facades\Storage;
    use Illuminate\Support\Facades\Route;
    use Illuminate\Support\Carbon;

    // Judul section (opsional)
    $title = $title ?? 'Project';

    // ID unik untuk instance Swiper
    $swiperId = $swiperId ?? 'portfolio-swiper';

    // Normalisasi koleksi dari DB -> data kartu
    $cards = collect($portos ?? [])->map(function ($p) {
        $cover = is_array($p->image) ? ($p->image[0] ?? null) : $p->image;
        $coverUrl = $cover ? Storage::url($cover) : asset('images/placeholder.webp');

        // Format tanggal jika ada
        $date = null;
        if (!empty($p->create_date)) {
            try { $date = Carbon::parse($p->create_date)->translatedFormat('d M Y'); } catch (\Exception $e) {}
        }

        return [
            'id'        => $p->id,
            'title'     => $p->name,
            'subtitle'  => Str::limit(strip_tags($p->description ?? ''), 90),
            'cover'     => $coverUrl,
            'date'      => $date,
            'url'       => Route::has('portfolio.show') ? route('portfolio.show', $p->id) : '#',
        ];
    });
@endphp

@once
  {{-- Swiper + (opsional) Iconify untuk ikon kalender --}}
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
  <script defer src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <script defer src="https://code.iconify.design/iconify-icon/1.0.8/iconify-icon.min.js"></script>
@endonce

<section class="py-10">
  <div class="container mx-auto lg:max-w-screen-xl md:max-w-screen-md px-4">
    <div class="flex items-center justify-between mb-10">
      <h2 class="text-3xl md:text-4xl font-semibold">{{ $title }}</h2>
      @if(Route::has('home'))
        <a href="{{ route('home') }}" class="text-primary font-medium hover:tracking-widest transition">
          Lihat semua &gt;
        </a>
      @endif
    </div>

    @if($cards->isEmpty())
      <div class="text-center text-gray-500 py-16">Belum ada data portofolio.</div>
    @else
      <div class="swiper" id="{{ $swiperId }}">
        <div class="swiper-wrapper">
          @foreach($cards as $c)
            <div class="swiper-slide">
              <div class="relative p-2">
                {{-- floor shadow lembut di bawah kartu --}}
                <div class="pointer-events-none absolute inset-x-6 -bottom-4 h-8 rounded-2xl bg-black/10 blur-md"></div>

                <article class="relative bg-white rounded-3xl shadow-xl ring-1 ring-black/5 overflow-hidden hover:-translate-y-0.5 transition-transform">
                  {{-- COVER --}}
                  <div class="relative h-56 md:h-60 overflow-hidden">
                    <img src="{{ $c['cover'] }}" alt="cover" class="w-full h-full object-cover">
                    @if($c['date'])
                      <div class="absolute left-4 top-4 bg-white/90 text-black text-xs font-medium px-3 py-1 rounded-full shadow">
                        <iconify-icon icon="tabler:calendar" class="text-primary text-base mr-1 align-[-2px]"></iconify-icon>
                        {{ $c['date'] }}
                      </div>
                    @endif
                  </div>

                  {{-- BODY --}}
                  <div class="px-6 pt-6 pb-6">
                    <a href="{{ $c['url'] }}" class="block text-xl md:text-2xl font-extrabold leading-snug">
                      {{ $c['title'] }}
                    </a>

                    @if($c['subtitle'])
                      <p class="text-gray-600 mt-3">{{ $c['subtitle'] }}</p>
                    @endif

                    <div class="pt-6">
                      <a href="{{ $c['url'] }}"
                         class="inline-flex items-center gap-2 text-primary font-medium hover:gap-3 transition-all">
                        Lihat detail <span aria-hidden="true">›</span>
                      </a>
                    </div>
                  </div>
                </article>
              </div>
            </div>
          @endforeach
        </div>
      </div>

      {{-- Inisialisasi Swiper --}}
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
