{{-- resources/views/components/sections/services.blade.php --}}
@once
  {{-- AOS untuk animasi masuk --}}
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css">
  <script defer src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
  <script>document.addEventListener('DOMContentLoaded',()=>AOS.init({duration:700, once:true, offset:80}))</script>

  {{-- Iconify --}}
  <script defer src="https://code.iconify.design/iconify-icon/1.0.8/iconify-icon.min.js"></script>

  {{-- ====== POLISH: Spotlight + Pattern + Gradient Border ====== --}}
  <style>
    /* Cahaya mengikuti kursor */
    .spotlight {
      position: relative;
      --x: 50%;
      --y: 50%;
      border-radius: 1rem; /* 2xl */
      overflow: hidden;
      isolation: isolate;
    }
    .spotlight::before{
      content:"";
      position:absolute; inset:-1px;
      border-radius: inherit;
      pointer-events:none;
      background: radial-gradient(220px circle at var(--x) var(--y),
                  rgba(59,130,246,.22), rgba(59,130,246,0) 45%);
      opacity:0; transition:opacity .28s ease;
      z-index:1;
    }
    .spotlight:hover::before{ opacity:1; }

    /* Pola lembut di dalam kartu */
    .pattern-soft{
      background-image:
        radial-gradient( rgba(2,6,23,0.05) 1px, transparent 1px );
      background-size: 12px 12px;
      background-position: -6px -6px;
    }

    /* Agar gradient border rapi */
    .card-wrap{ position:relative; border-radius:1rem; }
  </style>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      document.querySelectorAll('[data-spotlight]').forEach((el) => {
        el.addEventListener('mousemove', (e) => {
          const r = el.getBoundingClientRect();
          el.style.setProperty('--x', (e.clientX - r.left) + 'px');
          el.style.setProperty('--y', (e.clientY - r.top)  + 'px');
        });
      });
    });
  </script>
@endonce

<section id="services" class="py-16 bg-white scroll-mt-28">
  <div class="container mx-auto lg:max-w-screen-xl md:max-w-screen-md px-4">
    <div class="text-center mb-12" data-aos="fade-up">
      <span class="text-primary text-sm font-semibold tracking-widest">KEAHLIAN & LAYANAN</span>
      <h2 class="text-3xl md:text-4xl font-bold mt-2 text-gray-900">Apa yang bisa saya bantu</h2>
      <p class="mt-3 max-w-2xl mx-auto text-gray-600">
        Solusi end-to-end dari perencanaan, pengembangan hingga pengiriman.
      </p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
      @foreach($services as $s)
        {{-- GRADIENT BORDER WRAP --}}
        <div
          class="card-wrap p-[1px] bg-[conic-gradient(at_0%_0%,#60a5fa33,#c084fc33,#fb718533,#60a5fa33)]
                 hover:bg-[conic-gradient(at_0%_0%,#60a5fa66,#c084fc66,#fb718566,#60a5fa66)]
                 transition"
          data-aos="fade-up" data-aos-delay="{{ $loop->index*80 }}"
        >
          {{-- KARTU --}}
          <article
            data-spotlight
            class="spotlight group pattern-soft rounded-2xl bg-white text-gray-700 p-6
                   border border-white shadow-[0_12px_30px_-12px_rgba(0,0,0,.18)]
                   hover:shadow-[0_20px_50px_-20px_rgba(99,102,241,.45)]
                   transition-transform duration-300 hover:-translate-y-1"
          >
            <div class="relative z-[2] flex items-center gap-3">
              <div class="grid h-12 w-12 place-items-center rounded-xl
                          bg-gradient-to-br from-violet-300 to-indigo-300
                          shadow-inner">
                @if(!empty($s['icon']))
                  <iconify-icon icon="{{ $s['icon'] }}" class="text-primary text-2xl"></iconify-icon>
                @endif
              </div>
              <h3 class="text-xl font-semibold text-gray-900">{{ $s['title'] }}</h3>
            </div>

            @if(!empty($s['desc']))
              <p class="relative z-[2] mt-4 leading-relaxed text-gray-600">
                {{ $s['desc'] }}
              </p>
            @endif

            @if(!empty($s['tags']) && is_array($s['tags']))
              <div class="relative z-[2] mt-5 flex flex-wrap gap-2">
                @foreach($s['tags'] as $tag)
                  <span
                    class="rounded-full px-3 py-1 text-xs font-medium text-gray-700
                           bg-gradient-to-br from-violet-300 to-indigo-300
                           border border-indigo-100 shadow-sm">
                    #{{ $tag }}
                  </span>
                @endforeach
              </div>
            @endif

            @if(!empty($s['link']))
              <a href="{{ $s['link'] }}"
                 class="relative z-[2] mt-6 inline-flex items-center gap-2 text-primary font-medium
                        group-hover:gap-3 transition-all">
                Pelajari lebih lanjut <span aria-hidden="true">›</span>
              </a>
            @endif

            {{-- ACCENT BAR muncul saat hover --}}
            <div class="absolute bottom-0 left-0 right-0 h-1
                        bg-gradient-to-r from-blue-500/30 via-fuchsia-500/40 to-rose-500/30
                        opacity-0 group-hover:opacity-100 transition"></div>
          </article>
        </div>
      @endforeach
    </div>
  </div>
</section>
