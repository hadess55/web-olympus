{{-- resources/views/components/sections/faq.blade.php --}}
@once
  <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <style>[x-cloak]{ display:none !important; }</style>
@endonce

<section id="faq" class="relative py-16 bg-white scroll-mt-28">
  {{-- BACKDROP cantik (gradien + stripes tipis) --}}
  {{-- <div class="pointer-events-none absolute inset-0">
    <div class="absolute inset-0 bg-gradient-to-br from-purple-100/40 via-transparent to-indigo-100/40"></div>
    <div class="absolute inset-0 opacity-60 [background-image:repeating-linear-gradient(45deg,transparent_0_12px,rgba(255,255,255,.55)_12px_13px)]"></div>
    <div class="absolute -top-16 -left-16 h-56 w-56 rounded-full bg-purple-300/30 blur-3xl"></div>
    <div class="absolute -bottom-20 -right-12 h-64 w-64 rounded-full bg-pink-300/30 blur-3xl"></div>
  </div> --}}

  <div class="relative container mx-auto lg:max-w-screen-xl md:max-w-screen-md px-4">
    <div class="text-center mb-12 faq-reveal">
      <span class="text-primary text-sm font-semibold tracking-widest">FAQ</span>
      <h2 class="text-3xl md:text-4xl font-bold mt-2 text-gray-900">
        Pertanyaan yang sering ditanyakan
      </h2>
      <p class="mt-3 max-w-2xl mx-auto text-gray-600">
        Kalau masih ada yang belum jelas, hubungi saya kapan saja.
      </p>
    </div>

    {{-- KARTU FAQ --}}
    <div class="mx-auto max-w-3xl rounded-2xl bg-white border border-slate-200 shadow-[0_12px_30px_-12px_rgba(0,0,0,.18)] overflow-hidden faq-reveal">
      @foreach($faqs as $i => $f)
        <div
          x-data="{open: {{ $loop->first ? 'true' : 'false' }}}"
          class="group border-t first:border-t-0 border-slate-200"
        >
          <button
            class="w-full flex items-center justify-between gap-4 px-6 py-5 text-left
                   hover:bg-slate-50 transition-colors"
            @click="open = !open"
            :aria-expanded="open.toString()"
          >
            <div class="flex items-start gap-3">
              {{-- indikator aksen di kiri saat terbuka --}}
              <span class="mt-2 block h-3 w-3 rounded-full bg-gradient-to-tr from-blue-500 to-indigo-500
                           opacity-0 group-hover:opacity-60 transition-opacity"
                    :class="open ? 'opacity-100' : ''"></span>

              <span class="text-base md:text-lg font-medium text-gray-900">
                {{ $f['q'] }}
              </span>
            </div>

            {{-- Chevron animate --}}
            <svg class="h-5 w-5 text-gray-600 transition-transform"
                 :class="open ? 'rotate-180' : ''"
                 viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
              <path fill-rule="evenodd"
                    d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z"
                    clip-rule="evenodd"/>
            </svg>
          </button>

          {{-- Konten dengan transisi tinggi & opasitas --}}
          <div x-cloak x-show="open"
               x-transition:enter="transition ease-out duration-250"
               x-transition:enter-start="opacity-0 -translate-y-1"
               x-transition:enter-end="opacity-100 translate-y-0"
               x-transition:leave="transition ease-in duration-200"
               x-transition:leave-start="opacity-100 translate-y-0"
               x-transition:leave-end="opacity-0 -translate-y-1">
            <div class="px-6 pb-6 text-gray-600 leading-relaxed">
              {{ $f['a'] }}
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>

  {{-- REVEAL anim saat section terlihat --}}
  <style>
    @keyframes faq-in {
      0% { opacity: 0; transform: translateY(14px) scale(.98); }
      100% { opacity: 1; transform: translateY(0) scale(1); }
    }
    .faq-reveal { opacity: 0; }
    .faq-reveal.faq-show { animation: faq-in .6s ease-out forwards; }
  </style>
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const sec = document.querySelector('#faq');
      const io = new IntersectionObserver((entries) => {
        entries.forEach(e => {
          if (e.isIntersecting) {
            sec.querySelectorAll('.faq-reveal').forEach((el, idx) => {
              el.style.animationDelay = (idx * 100) + 'ms';
              el.classList.add('faq-show');
            });
            io.disconnect();
          }
        });
      }, { threshold: 0.2 });
      io.observe(sec);
    });
  </script>
</section>
