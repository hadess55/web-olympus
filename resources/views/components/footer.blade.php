{{-- resources/views/components/footer.blade.php --}}
@php
  // ====== Default props (bisa dioverride saat include) ======
  $headerData = $headerData ?? [
    ['label' => 'Home',    'href' => (\Illuminate\Support\Facades\Route::has('home') ? route('home') : url('/'))],
    ['label' => 'Tools',   'href' => '#tools'],
    ['label' => 'Services','href' => '#services'],
    ['label' => 'FAQ',     'href' => '#faq'],
    ['label' => 'Contact', 'href' => '#contact'],
  ];

  $otherLinks = $otherLinks ?? [
    ['label' => 'Project', 'href' => '/project'],
  ];

  $social = $social ?? [
    ['icon' => 'tabler:brand-instagram', 'href' => 'https://www.instagram.com/olympusproject5', 'label' => 'Instagram'],
  ];

  $address = $address ?? null;
  $phone   = $phone   ?? '+62 8594 7582 570';
  $email   = $email   ?? 'olympusproject5@gmail.com';
  $year    = now()->year;
@endphp

<footer class="relative isolate overflow-hidden">
  {{-- Background dekoratif + gradient halus (tema indigo) --}}
  <div class="pointer-events-none absolute inset-0 bg-gradient-to-b from-white to-indigo-200"></div>

  <div class="relative container mx-auto px-4 py-16 lg:py-20 lg:max-w-screen-xl">
    {{-- GRID UTAMA --}}
    <div class="grid grid-cols-1 gap-10 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-12">
      {{-- Brand + Sosial --}}
      <div class="lg:col-span-4 md:col-span-3">
        <a href="{{ url('/') }}" class="inline-flex items-center gap-3 group">
          <img src="{{ asset('default/logo2.png') }}" alt="OlympusProject"
               class="h-12 w-auto rounded-xl ring-1 ring-indigo-100 transition-transform group-hover:scale-[1.02]">
          <span class="sr-only">OlympusProject</span>
        </a>

        <p class="mt-4 text-slate-600 leading-relaxed">
          Bangun produk digital yang estetik, cepat, dan efektif bersama OlympusProject.
        </p>

        <div class="mt-6 flex items-center gap-3">
          @foreach($social as $s)
            <a
              href="{{ $s['href'] }}"
              target="_blank" rel="noopener"
              aria-label="{{ $s['label'] ?? 'Social' }}"
              class="inline-flex h-10 w-10 items-center justify-center rounded-full ring-1 ring-indigo-100 bg-white
                     hover:ring-indigo-300 hover:shadow-md hover:-translate-y-0.5 transition-all"
            >
              <iconify-icon icon="{{ $s['icon'] }}" class="text-xl text-slate-700"></iconify-icon>
            </a>
          @endforeach
        </div>
      </div>

      {{-- Links --}}
      <div class="lg:col-span-3 sm:col-span-1">
        <h3 class="mb-4 text-xl font-semibold text-slate-900">Links</h3>
        <ul class="space-y-2">
          @foreach($headerData as $item)
            <li>
              <a href="{{ $item['href'] }}"
                 class="group inline-flex items-center gap-2 text-slate-600 hover:text-indigo-600
                        focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-300 rounded transition-colors">
                <span class="h-1.5 w-1.5 rounded-full bg-slate-300 group-hover:bg-indigo-600 transition-colors"></span>
                {{ $item['label'] }}
              </a>
            </li>
          @endforeach
        </ul>
      </div>

      {{-- Project / Others --}}
      <div class="lg:col-span-2 sm:col-span-1">
        <h3 class="mb-4 text-xl font-semibold text-slate-900">Project</h3>
        <ul class="space-y-2">
          @foreach($otherLinks as $link)
            <li>
              <a href="{{ $link['href'] }}"
                 class="inline-block text-slate-600 hover:text-indigo-600 transition-colors
                        focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-300 rounded">
                {{ $link['label'] }}
              </a>
            </li>
          @endforeach
        </ul>
      </div>

      {{-- Kontak --}}
      <div class="lg:col-span-3 md:col-span-2">
        <h3 class="mb-4 text-xl font-semibold text-slate-900">Contact</h3>

        @if ($address)
          <div class="mb-5 flex items-start gap-3">
            <iconify-icon icon="tabler:map-pin" class="text-indigo-600 text-2xl"></iconify-icon>
            <p class="text-slate-700">{{ $address }}</p>
          </div>
        @endif

        <div class="mb-4 flex items-center gap-3">
          <iconify-icon icon="tabler:phone" class="text-indigo-600 text-2xl"></iconify-icon>
          <a href="tel:{{ preg_replace('/\s+/', '', $phone) }}"
             class="text-slate-700 hover:text-indigo-600 transition-colors">
            {{ $phone }}
          </a>
        </div>

        <div class="flex items-center gap-3">
          <iconify-icon icon="tabler:mail" class="text-indigo-600 text-2xl"></iconify-icon>
          <a href="mailto:{{ $email }}" class="text-slate-700 hover:text-indigo-600 transition-colors">
            {{ $email }}
          </a>
        </div>
      </div>
    </div>

    {{-- Garis pemisah --}}
    <div class="mt-12 border-t border-indigo-100"></div>

    {{-- Bottom bar --}}
    <div class="mt-6 flex flex-col-reverse items-center justify-between gap-4 md:flex-row">
      <p class="text-sm text-slate-600 text-center md:text-left">
        © {{ $year }} All Rights Reserved by
        <a href="https://olympusproject.com" target="_blank" rel="noopener"
           class="font-medium text-indigo-600 hover:underline">OlympusProject</a>
      </p>

      {{-- Back to top --}}
      <a href="#top"
         class="inline-flex items-center gap-2 rounded-full px-4 py-2 text-sm ring-1 ring-indigo-100 bg-white
                hover:ring-indigo-300 hover:-translate-y-0.5 transition-all">
        <iconify-icon icon="tabler:arrow-up" class="text-base text-indigo-700"></iconify-icon>
        Back to top
      </a>
    </div>
  </div>
</footer>
