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
<x-layout>
  <section class="bg-gray-50 py-10">
    <div class="container mx-auto lg:max-w-screen-xl md:max-w-screen-md px-4">
      {{-- Breadcrumb / Back --}}
      <div class="mb-6">
        <a href="{{ route('project') }}" class="inline-flex items-center gap-2 text-sm text-primary hover:underline">
          ‹ Kembali
        </a>
      </div>

      {{-- GRID 2 KOLOM --}}
      <div class="grid lg:grid-cols-12 gap-8">

        {{-- ================= LEFT: KONTEN UTAMA ================= --}}
        <div class="lg:col-span-8">
          {{-- COVER (banner lebih pendek & responsif) --}}
          <div class="rounded-2xl bg-white border border-gray-200 p-6 shadow-sm">
            <div class="relative overflow-hidden rounded-2xl shadow-lg bg-white">
            <div class="h-[clamp(180px,32vh,420px)]">
              <img
                src="{{ $coverUrl }}"
                alt="{{ $portofolio->name }}"
                class="w-full h-full object-cover"
                loading="eager" decoding="async"
              >
              <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent"></div>
            </div>

            {{-- Date chip --}}
            @if(!empty($dateText))
              <div class="absolute bottom-3 right-3">
                <span class="inline-flex items-center gap-1 rounded-full bg-white/90 text-gray-700 text-xs px-3 py-1 shadow">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor"><path d="M6 2a1 1 0 0 1 1 1v1h6V3a1 1 0 1 1 2 0v1h1.5A1.5 1.5 0 0 1 18 5.5V7H2V5.5A1.5 1.5 0 0 1 3.5 4H5V3a1 1 0 0 1 1-1Z"/><path d="M2 8h16v6.5A1.5 1.5 0 0 1 16.5 16h-13A1.5 1.5 0 0 1 2 14.5V8Z"/></svg>
                  {{ $dateText }}
                </span>
              </div>
            @endif
          </div>

          {{-- Judul --}}
          <h1 class="mt-5 text-2xl md:text-3xl font-semibold text-gray-900">
            {{ $portofolio->name }}
          </h1>

         @if(!empty($technologies))
          <div class="mt-5 flex flex-wrap gap-2">
            @foreach($technologies as $key)
              @php
                $m = $techMap[$key] ?? ['label' => ucfirst($key), 'icon' => null, 'class' => 'bg-gray-100 text-gray-700 ring-gray-200'];
              @endphp
              <span class="inline-flex items-center gap-1.5 px-2 py-1 rounded-md text-sm font-medium ring-1 ring-inset {{ $m['class'] }}">
                @if($m['icon'])
                  <img src="{{ asset('tech-icons/'.$m['icon'].'.svg') }}" alt="{{ $m['label'] }}" class="h-3.5 w-3.5">
                @endif
                {{ $m['label'] }}
              </span>
            @endforeach
          </div>
        @endif

          {{-- GALERI (thumbnail -> popup, tidak pindah halaman) --}}
          @if(!empty($gallery) && count($gallery))
            <div class="mt-5">
              <h3 class="text-sm font-semibold text-gray-600 mb-3">Galeri</h3>
              <div class="grid grid-cols-3 sm:grid-cols-4 gap-3">
                @foreach($gallery as $url)
                  <button type="button" data-gl="{{ $url }}"
                          class="group relative overflow-hidden rounded-lg bg-gray-100 aspect-[4/3]">
                    <img src="{{ $url }}" alt="gallery"
                         class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
                    <span class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition"></span>
                  </button>
                @endforeach
              </div>
            </div>
          @endif

          {{-- Artikel / Deskripsi --}}
          @if(!empty($portofolio->description))
            <div class="mt-6 ">
              <h3 class="mb-2 text-base font-semibold text-gray-800">Deskripsi</h3>
              <div class="prose max-w-none text-gray-700 leading-relaxed">
                {!! nl2br(e($portofolio->description)) !!}
              </div>
            </div>
          @endif

        </div>
          </div>
          

        {{-- ================= RIGHT: SIDEBAR PROJECT LAIN ================= --}}
        <aside class="lg:col-span-4">
          <div class="lg:sticky lg:top-24 space-y-4">
            <div class="rounded-2xl bg-white border border-gray-200 shadow-sm p-4">
              <div class="flex items-center justify-between mb-3">
                <h3 class="text-base font-semibold text-gray-900">Project Lainnya</h3>
                <a href="{{ route('project') }}" class="text-primary text-sm hover:underline">Lihat semua</a>
              </div>

              @if($others->isEmpty())
                <p class="text-sm text-gray-500">Belum ada.</p>
              @else
                <ul class="space-y-3">
                  @foreach($others as $o)
                    @php
                      $oThumb = $o->tumbnail ?? $o->thumbnail ?? null;
                      $oThumbUrl = $oThumb ? \Illuminate\Support\Facades\Storage::url($oThumb) : asset('images/placeholder.webp');
                      $oDate = null;
                      if (!empty($o->create_date)) {
                        try { $oDate = \Illuminate\Support\Carbon::parse($o->create_date)->translatedFormat('d M Y'); } catch (\Exception $e) {}
                      }
                    @endphp

                    <li>
                      <a href="{{ route('project.show', $o->id) }}"
                         class="group flex gap-3 rounded-lg border border-gray-200 hover:border-blue-300 bg-white p-2 transition">
                        <div class="w-24 h-16 overflow-hidden rounded-md bg-gray-100 shrink-0">
                          <img src="{{ $oThumbUrl }}" alt="{{ $o->name }}" class="w-full h-full object-cover">
                        </div>
                        <div class="min-w-0">
                          <p class="text-sm font-medium text-gray-900 line-clamp-2 group-hover:text-blue-600">
                            {{ $o->name }}
                          </p>
                          @if($oDate)
                            <span class="mt-1 inline-block text-xs text-gray-500">{{ $oDate }}</span>
                          @endif
                        </div>
                      </a>
                    </li>
                  @endforeach
                </ul>
              @endif
            </div>
          </div>
        </aside>

      </div>
    </div>
  </section>

  {{-- LIGHTBOX POPUP UNTUK GALERI --}}
  <div id="gl-modal" class="fixed inset-0 hidden z-[80]">
    <div class="absolute inset-0 bg-black/70"></div>
    <div class="absolute inset-0 flex items-center justify-center p-4">
      <img src="" alt="preview" class="max-h-[85vh] max-w-[90vw] rounded-xl shadow-2xl">
    </div>
    <button type="button" aria-label="Close"
            class="absolute top-4 right-4 rounded-full bg-white/90 px-3 py-1 text-sm font-semibold shadow hover:bg-white">
      ✕
    </button>
  </div>

  <style>
    /* util sederhana utk clamp 2 baris tanpa plugin */
    .line-clamp-2{display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden}
  </style>

  <script>
    // Lightbox sederhana
    (function () {
      const overlay = document.getElementById('gl-modal');
      const img = overlay.querySelector('img');
      function open(src){ img.src = src; overlay.classList.remove('hidden'); }
      function close(){ overlay.classList.add('hidden'); img.src = ''; }

      document.querySelectorAll('[data-gl]').forEach(btn=>{
        btn.addEventListener('click', e=>{
          e.preventDefault();
          open(btn.dataset.gl);
        })
      });

      overlay.addEventListener('click', close);
      overlay.querySelector('button').addEventListener('click', close);
    })();
  </script>
</x-layout>
