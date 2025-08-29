{{-- resources/views/components/footer.blade.php --}}
@php
  // Data default (bisa di-override saat include)
  $headerData = $headerData ?? [
    ['label' => 'Home',     'href' => route('home') ?? url('/')],
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
    ['icon' => 'tabler:brand-facebook',  'href' => '#'],
    ['icon' => 'tabler:brand-twitter',   'href' => '#'],
    ['icon' => 'tabler:brand-instagram', 'href' => '#'],
  ];

  $address = $address ?? '925 Filbert Street Pennsylvania 18072';
  $phone   = $phone   ?? '+45 3411-4411';
  $email   = $email   ?? 'info@gmail.com';
  $year    = now()->year;
@endphp

<footer class="bg-blue-100 py-10">
  <div class="container mx-auto lg:max-w-screen-xl md:max-w-screen-md px-4">
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

        <div class="flex items-center gap-4 mt-4">
          @foreach($social as $s)
            <a href="{{ $s['href'] }}" class="hover:text-primary text-black text-3xl" target="_blank" rel="noopener">
              <iconify-icon icon="{{ $s['icon'] }}"></iconify-icon>
            </a>
          @endforeach
        </div>
      </div>

      {{-- Links dari headerData --}}
      <div class="col-span-2">
        <h3 class="mb-4 text-2xl font-medium">Links</h3>
        <ul>
          @foreach($headerData as $item)
            <li class="mb-2 text-black/50 hover:text-primary w-fit">
              <a href="{{ $item['href'] }}">{{ $item['label'] }}</a>
            </li>
          @endforeach
        </ul>
      </div>

      {{-- Other --}}
      <div class="col-span-2">
        <h3 class="mb-4 text-2xl font-medium">Other</h3>
        <ul>
          @foreach($otherLinks as $link)
            <li class="mb-2 text-black/50 hover:text-primary w-fit">
              <a href="{{ $link['href'] }}">{{ $link['label'] }}</a>
            </li>
          @endforeach
        </ul>
      </div>

      {{-- Kontak --}}
      <div class="col-span-4 md:col-span-4 lg:col-span-4">
        <div class="flex items-center gap-2">
          <iconify-icon icon="tabler:brand-google-maps" class="text-primary text-3xl"></iconify-icon>
          <h5 class="text-lg text-black/60">{{ $address }}</h5>
        </div>
        <div class="flex items-center gap-2 mt-10">
          <iconify-icon icon="tabler:phone" class="text-primary text-3xl"></iconify-icon>
          <h5 class="text-lg text-black/60">{{ $phone }}</h5>
        </div>
        <div class="flex items-center gap-2 mt-10">
          <iconify-icon icon="tabler:folder" class="text-primary text-3xl"></iconify-icon>
          <h5 class="text-lg text-black/60">{{ $email }}</h5>
        </div>
      </div>
    </div>

    <div class="mt-10 lg:flex items-center justify-between">
      <h4 class="text-black/50 text-sm text-center lg:text-start font-normal">
        © {{ $year }} Agency. All Rights Reserved by
        <a href="https://getnextjstemplates.com/" target="_blank" rel="noopener" class="hover:text-primary">
          GetNextJsTemplates.com
        </a>
      </h4>

      <div class="flex gap-5 mt-5 lg:mt-0 justify-center lg:justify-start">
        <a href="{{ url('/privacy') }}" class="text-black/50 text-sm font-normal hover:text-primary">Privacy policy</a>
        <a href="{{ url('/terms') }}" class="text-black/50 text-sm font-normal hover:text-primary">Terms &amp; conditions</a>
      </div>

      <h4 class="text-black/50 text-sm text-center lg:text-start font-normal">
        Distributed by
        <a href="https://themewagon.com/" target="_blank" rel="noopener" class="hover:text-primary">ThemeWagon</a>
      </h4>
    </div>
  </div>
</footer>
