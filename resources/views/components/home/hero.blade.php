@php $prefix = $prefix ?? ''; @endphp

<section id="home" class="relative overflow-hidden scroll-mt-28">
  {{-- ===== BACKGROUND ===== --}}
  <div class="absolute inset-0 -z-10">
    {{-- gradient dasar --}}
    <div class="absolute inset-0 bg-gradient-to-br from-indigo-600 via-indigo-300 to-indigo-600"></div>

    {{-- spotlight mengikuti kursor (dikontrol via CSS var) --}}
    <div id="spotlight"
         class="absolute inset-0 pointer-events-none opacity-90"
         style="--mx:50%; --my:40%;
                background:
                  radial-gradient(300px 300px at var(--mx) var(--my), rgba(255,255,255,.85), transparent 70%);">
    </div>

    {{-- garis diagonal halus --}}
    <div class="absolute inset-0 mix-blend-overlay opacity-30
         [background-image:repeating-linear-gradient(-45deg,rgba(255,255,255,.25)_0_1px,transparent_1px_12px)]"></div>
  </div>

  {{-- ===== CONTENT ===== --}}
  {{-- ===== CONTENT (Text + Image) ===== --}}
<div class="relative z-10 container mx-auto lg:max-w-screen-xl px-6 md:px-10 py-16 lg:py-24">
  <div class="grid grid-cols-1 lg:grid-cols-12 items-center gap-20">

    {{-- LEFT: TEXT --}}
    <div class="lg:col-span-6">
      <div class="inline-flex items-center gap-2 rounded-full bg-white/80 px-3 py-1 ring-1 ring-indigo-200">
        <iconify-icon icon="solar:verified-check-bold" class="text-green-600 text-lg"></iconify-icon>
        <span class="text-xs font-semibold text-indigo-700">Bangun Websitemu Sekarang</span>
      </div>

      <h1 class="mt-5 text-4xl sm:text-5xl xl:text-6xl font-extrabold leading-tight tracking-tight">
        <span class="bg-clip-text text-transparent bg-[linear-gradient(90deg,#0f172a,#1e40af,#0f172a)] bg-[length:200%_100%] animate-[shine_6s_linear_infinite]">
          OLYMPUS PROJECT
        </span>
      </h1>

      <p class="mt-4 text-gray-900/90 text-lg sm:text-xl max-w-3xl">
        Bangun website bisnismu dan tingkatkan jangkauannya dengan desain modern, performa cepat,
        praktik SEO yang tepat, dan <span class="font-semibold text-indigo-800"><span id="rotator" class="inline-block">UI elegan</span></span>.
      </p>

      <div class="mt-6 flex flex-wrap items-center gap-3">
        @foreach (['Website','Mobile','Landing Page','SEO Ready','Responsif'] as $chip)
          <span class="group inline-flex items-center gap-2 rounded-full bg-white/90 px-3 py-1 text-sm text-gray-900 ring-1 ring-indigo-200
                        hover:ring-indigo-300 hover:-translate-y-0.5 transition-all">
            <iconify-icon icon="tabler:circle-check" class="text-indigo-600"></iconify-icon>{{ $chip }}
          </span>
        @endforeach
      </div>

      <div class="mt-8 flex flex-wrap items-center gap-4">
        <a href="#contact"
           class="magnetic relative inline-flex items-center justify-center rounded-full bg-indigo-600 px-6 py-3 text-white font-semibold
                  shadow-lg shadow-indigo-400/30 overflow-hidden transition-transform">
          <span class="relative z-10">Mulai Project</span>
          <span class="ripple pointer-events-none absolute inset-0"></span>
          <iconify-icon icon="tabler:arrow-right" class="ml-2 text-xl relative z-10"></iconify-icon>
        </a>

        <a href="#portfolio"
           class="inline-flex items-center justify-center rounded-full bg-white/90 px-6 py-3 text-indigo-700 font-semibold ring-1 ring-indigo-200
                  hover:ring-indigo-300 hover:-translate-y-0.5 transition-all">
          Lihat Portofolio
        </a>
      </div>

      <div class="mt-10 grid grid-cols-2 sm:grid-cols-3 gap-6">
        <div class="rounded-2xl bg-white/80 px-5 py-4 ring-1 ring-indigo-200">
          <div class="text-3xl font-extrabold text-indigo-700"><span class="counter" data-to="98">0</span>%</div>
          <p class="mt-1 text-sm text-gray-700">Kepuasan Klien</p>
        </div>
        <div class="rounded-2xl bg-white/80 px-5 py-4 ring-1 ring-indigo-200">
          <div class="text-3xl font-extrabold text-indigo-700"><span class="counter" data-to="7">0</span> hari</div>
          <p class="mt-1 text-sm text-gray-700">Garansi Revisi</p>
        </div>
      </div>
    </div>

    {{-- RIGHT: IMAGE --}}
    <div class="lg:col-span-6">
      <figure class="relative mx-auto w-full max-w-[860px]">
        {{-- frame lembut --}}
        <div class="absolute -inset-6 rounded-[2rem] bg-white/25"></div>
        <div class="absolute inset-0 rounded-[2rem] ring-1 ring-white/50"></div>

        <img
          src="{{ asset($prefix.'images/banner/baner.png') }}"
          alt="Ilustrasi layanan Olympus Project"
          width="1000" height="760"
          class="relative h-auto w-full rounded-3xl shadow-2xl ring-1 ring-white/40"
          loading="eager" decoding="async">

        {{-- dekor titik sudut --}}
        <div class="pointer-events-none absolute -right-8 -bottom-8 opacity-70">
          <svg width="180" height="120" viewBox="0 0 180 120" fill="none" aria-hidden="true">
            <defs>
            <rect width="180" height="120" fill="url(#heroDots)"/>
          </svg>
        </div>
      </figure>
    </div>

  </div>
</div>


  {{-- ===== STYLES (Tailwind + keyframes custom) ===== --}}
  <style>
    @keyframes shine { 0%{background-position:0% 50%} 100%{background-position:200% 50%} }
    @keyframes marquee { 0% { transform: translateX(0); } 100% { transform: translateX(-50%);} }
    .marquee { animation: marquee 18s linear infinite; }
    .magnetic { transition: transform .2s ease; }
    .magnetic:hover { transform: translateY(-2px); }
    .ripple::before {
      content:""; position:absolute; inset:0; background:radial-gradient(120px 80px at var(--rx,50%) var(--ry,50%), rgba(255,255,255,.35), transparent 60%);
      transition: background .12s linear;
    }
  </style>

  {{-- ===== INTERACTIONS (JS ringan) ===== --}}
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

      // Spotlight follow
      const sp = document.getElementById('spotlight');
      if (sp && !reduce) {
        document.addEventListener('mousemove', (e) => {
          const x = (e.clientX / window.innerWidth) * 100;
          const y = (e.clientY / window.innerHeight) * 100;
          sp.style.setProperty('--mx', x + '%');
          sp.style.setProperty('--my', y + '%');
        });
      }

      // Ripple pada CTA utama
      const btn = document.querySelector('.magnetic');
      if (btn && !reduce) {
        btn.addEventListener('pointermove', (e) => {
          const rect = btn.getBoundingClientRect();
          const rx = ((e.clientX - rect.left) / rect.width) * 100;
          const ry = ((e.clientY - rect.top) / rect.height) * 100;
          btn.style.setProperty('--rx', rx + '%');
          btn.style.setProperty('--ry', ry + '%');
        });
      }

      // Counter angka
      document.querySelectorAll('.counter').forEach(el => {
        const end = parseInt(el.dataset.to, 10) || 0;
        const duration = 1200;
        const startTime = performance.now();
        const step = (now) => {
          const p = Math.min((now - startTime) / duration, 1);
          el.textContent = Math.floor(p * end);
          if (p < 1) requestAnimationFrame(step);
        };
        if (!reduce) requestAnimationFrame(step); else el.textContent = end;
      });

      // Rotator kata kunci
      const words = ['UI elegan','konversi tinggi','keamanan teruji','skala cepat'];
      const rot = document.getElementById('rotator');
      if (rot) {
        let i = 0;
        setInterval(() => {
          i = (i + 1) % words.length;
          rot.style.opacity = 0;
          setTimeout(() => { rot.textContent = words[i]; rot.style.opacity = 1; }, 180);
        }, 1800);
      }
    });
  </script>
</section>
