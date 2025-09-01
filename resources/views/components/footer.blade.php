{{-- resources/views/components/footer.blade.php --}}
@php
  // Data default (bisa di-override saat include)
  $headerData = $headerData ?? [
    ['label' => 'Home',     'href' => (\Illuminate\Support\Facades\Route::has('home') ? route('home') : url('/'))],
    ['label' => 'Features', 'href' => '#features'],
    ['label' => 'Pricing',  'href' => '#pricing'],
    ['label' => 'About',    'href' => '#about'],
  ];

  $otherLinks = $otherLinks ?? [
    ['label' => 'About Us', 'href' => '#'],
    ['label' => 'Our Team', 'href' => '#'],
    ['label' => 'Career',   'href' => '#'],
    ['label' => 'Services', 'href' => '#'],
    ['label' => 'Contact',  'href' => '#'],
  ];

  $social = $social ?? [
    ['icon' => 'tabler:brand-facebook',  'href' => '#', 'label' => 'Facebook'],
    ['icon' => 'tabler:brand-twitter',   'href' => '#', 'label' => 'Twitter/X'],
    ['icon' => 'tabler:brand-instagram', 'href' => '#', 'label' => 'Instagram'],
  ];

  $address = $address ?? null; // opsional
  $phone   = $phone   ?? '+45 3411-4411';
  $email   = $email   ?? 'info@gmail.com';
  $year    = now()->year;
@endphp

<footer class="relative overflow-hidden py-12 bg-white">
  {{-- Aksen lembut di background --}}
  {{-- <div class="pointer-events-none absolute inset-0">
    <div class="absolute -top-16 -left-16 h-56 w-56 rounded-full bg-blue-300/25 blur-3xl"></div>
    <div class="absolute -bottom-20 -right-12 h-64 w-64 rounded-full bg-indigo-300/25 blur-3xl"></div>
    <div class="absolute inset-0 opacity-50 [background-image:repeating-linear-gradient(45deg,transparent_0_12px,rgba(255,255,255,.6)_12px_13px)]"></div>
  </div> --}}

  <div class="relative container mx-auto lg:max-w-screen-xl md:max-w-screen-md px-4">
    <div class="grid grid-cols-1 gap-y-10 gap-x-16 sm:grid-cols-2 lg:grid-cols-12 xl:gap-x-8">
      {{-- Logo + Sosial --}}
      <div class="col-span-4 md:col-span-12 lg:col-span-4">
        @if (View::exists('components.logo'))
          @include('components.logo')
        @else
          <a href="{{ url('/') }}" class="inline-flex items-center gap-2 mb-4">
            <img src="{{ asset('default/logo2.png') }}" alt="Logo" class="h-12 w-auto">
          </a>
        @endif

        <div class="mt-4 flex items-center gap-4">
          @foreach($social as $s)
            <a href="{{ $s['href'] }}" target="_blank" rel="noopener"
               aria-label="{{ $s['label'] ?? 'Social' }}"
               class="group text-3xl text-slate-600 hover:text-primary transition-colors">
              <iconify-icon icon="{{ $s['icon'] }}" class="transition-transform group-hover:-translate-y-0.5"></iconify-icon>
            </a>
          @endforeach
        </div>
      </div>

      {{-- Links dari headerData --}}
      <div class="col-span-2">
        <h3 class="mb-4 text-2xl font-semibold text-slate-900">Links</h3>
        <ul>
          @foreach($headerData as $item)
            <li class="mb-2 w-fit">
              <a href="{{ $item['href'] }}"
                 class="text-slate-600 hover:text-primary transition-colors">
                {{ $item['label'] }}
              </a>
            </li>
          @endforeach
        </ul>
      </div>

      {{-- Other --}}
      <div class="col-span-2">
        <h3 class="mb-4 text-2xl font-semibold text-slate-900">Other</h3>
        <ul>
          @foreach($otherLinks as $link)
            <li class="mb-2 w-fit">
              <a href="{{ $link['href'] }}"
                 class="text-slate-600 hover:text-primary transition-colors">
                {{ $link['label'] }}
              </a>
            </li>
          @endforeach
        </ul>
      </div>

      {{-- Kontak --}}
      <div class="col-span-4 md:col-span-4 lg:col-span-4">
        @if ($address)
          <div class="flex items-start gap-2">
            <iconify-icon icon="tabler:map-pin" class="text-primary text-3xl"></iconify-icon>
            <p class="text-lg text-slate-700">{{ $address }}</p>
          </div>
        @endif
        <div class="mt-8 flex items-center gap-2">
          <iconify-icon icon="tabler:phone" class="text-primary text-3xl"></iconify-icon>
          <p class="text-lg text-slate-700">{{ $phone }}</p>
        </div>
        <div class="mt-8 flex items-center gap-2">
          <iconify-icon icon="tabler:mail" class="text-primary text-3xl"></iconify-icon>
          <p class="text-lg text-slate-700">{{ $email }}</p>
        </div>
      </div>
    </div>

    {{-- Bottom bar --}}
    <div class="relative mt-10 border-t border-white/70 pt-6 lg:flex items-center justify-between">
      <h4 class="text-sm font-normal text-slate-600 text-center lg:text-start">
        © {{ $year }} Agency. All Rights Reserved by
        <a href="https://getnextjstemplates.com/" target="_blank" rel="noopener" class="font-medium text-primary hover:underline">
          GetNextJsTemplates.com
        </a>
      </h4>

      <div class="mt-5 lg:mt-0 flex gap-5 justify-center lg:justify-start">
        <a href="{{ url('/privacy') }}" class="text-sm font-normal text-slate-600 hover:text-primary transition-colors">
          Privacy policy
        </a>
        <a href="{{ url('/terms') }}" class="text-sm font-normal text-slate-600 hover:text-primary transition-colors">
          Terms &amp; conditions
        </a>
      </div>
    </div>
  </div>
</footer>
