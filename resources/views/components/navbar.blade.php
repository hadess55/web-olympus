<header
  x-data="{
    navbarOpen:false,
    isSignInOpen:false,
    isSignUpOpen:false,
    sticky:false,

    init(){
      // sticky header
      const onScroll = () => this.sticky = window.scrollY >= 80;
      window.addEventListener('scroll', onScroll);

      // lock body scroll ketika menu/modal terbuka
      this.$watch('navbarOpen', this.toggleBodyOverflow);
      this.$watch('isSignInOpen', this.toggleBodyOverflow);
      this.$watch('isSignUpOpen', this.toggleBodyOverflow);

      // scroll ke anchor jika URL memuat hash saat tiba di home
      if (location.hash && document.querySelector(location.hash)) {
        setTimeout(() => this.scrollTo(location.hash), 10);
      }
    },

    toggleBodyOverflow(){
      document.body.style.overflow = (this.navbarOpen || this.isSignInOpen || this.isSignUpOpen) ? 'hidden' : '';
    },

    // NAV ke section: smooth di halaman sekarang; kalau tidak ada target → pindah ke home#id
    handleNav(e, href){
      if (!href || !href.startsWith('#')) return; // link normal
      const target = document.querySelector(href);

      if (target) {
        e.preventDefault();
        this.scrollTo(href);
        return;
      }

      // lagi di halaman lain (mis. /project) → redirect ke home + hash
      window.location.href = '{{ url('/') }}' + href;
    },

    scrollTo(sel){
      const t = document.querySelector(sel); if (!t) return;
      const offset = this.$root.offsetHeight + 12; // tinggi header + sedikit spasi
      const y = t.getBoundingClientRect().top + window.pageYOffset - offset;
      window.scrollTo({ top:y, behavior:'smooth' });
      this.navbarOpen = false;
    }
  }"
  class="fixed top-0 z-40 w-full pb-5 transition-all duration-300 bg-white"
  :class="sticky ? 'shadow-lg py-5' : 'shadow-none py-6'"
>
  @php
    // Menu menuju section di landing
    $headerData = $headerData ?? [
      ['label' => 'Home',      'href' => '#home'],
      ['label' => 'Tools',     'href' => '#tools'],
      ['label' => 'Project', 'href' => '#portfolio'],
      ['label' => 'Services',  'href' => '#services'],
      ['label' => 'FAQ',       'href' => '#faq'],
      ['label' => 'Contact',   'href' => '#contact'],
    ];
  @endphp

  <div class="lg:py-0 py-2">
    <div class="container mx-auto lg:max-w-screen-xl md:max-w-screen-md flex items-center justify-between px-4">
      {{-- Logo --}}
      <a href="{{ url('/') }}" class="flex items-center gap-2">
        <img src="{{ asset('default/logo2.png') }}" alt="Logo" class="h-12 w-auto">
      </a>

      {{-- Desktop Nav --}}
      <nav class="hidden lg:flex flex-grow items-center gap-8 justify-center">
        @foreach($headerData as $item)
          <a href="{{ $item['href'] }}"
             @click="handleNav($event, '{{ $item['href'] }}')"
             class="text-base font-medium text-gray-700 hover:text-violet-500 transition">
            {{ $item['label'] }}
          </a>
        @endforeach
      </nav>

      {{-- Actions (desktop) --}}
      <div class="flex items-center gap-4">
        {{-- CTA Project --}}
        <a href="{{ function_exists('route') && Route::has('project') ? route('project') : url('/project') }}"
           class="hidden md:block bg-indigo-500 text-white hover:bg-indigo-600 px-12 py-3 rounded-full text-lg font-medium transition">
          Project
        </a>

        {{-- Hamburger --}}
        <button
          @click="navbarOpen = !navbarOpen"
          class="block lg:hidden p-2 rounded-lg"
          aria-label="Toggle mobile menu"
        >
          <span class="block w-6 h-0.5 bg-black"></span>
          <span class="block w-6 h-0.5 bg-black mt-1.5"></span>
          <span class="block w-6 h-0.5 bg-black mt-1.5"></span>
        </button>
      </div>
    </div>

    {{-- Backdrop --}}
    <template x-if="navbarOpen">
      <div class="fixed inset-0 bg-black/50 z-40" @click="navbarOpen = false"></div>
    </template>

    {{-- Mobile Drawer (light) --}}
    <div
      class="lg:hidden fixed top-0 right-0 h-full w-full max-w-xs bg-white text-gray-900 shadow-lg z-50
             transform transition-transform duration-300"
      :class="navbarOpen ? 'translate-x-0' : 'translate-x-full'"
      @keydown.escape.window="navbarOpen = false"
    >
      <div class="flex items-center justify-between p-4 relative border-b border-gray-200">
        <a href="{{ url('/') }}" class="flex items-center gap-2">
          <img src="{{ asset('default/logo2.png') }}" alt="Logo" class="h-8 w-auto">
        </a>
        <button
          @click="navbarOpen = false"
          class="w-5 h-5 absolute top-0 right-0 mr-8 mt-8"
          aria-label="Close menu Modal"
        >✕</button>
      </div>

      <nav class="flex flex-col items-start p-4">
        @foreach($headerData as $item)
          <a href="{{ $item['href'] }}"
             @click="handleNav($event, '{{ $item['href'] }}')"
             class="w-full text-left px-3 py-2 rounded-lg mb-1 transition hover:bg-gray-100">
            {{ $item['label'] }}
          </a>
        @endforeach

        <div class="mt-4 flex flex-col space-y-4 w-full">
          <a href="{{ function_exists('route') && Route::has('project') ? route('project') : url('/project') }}"
             class="border border-primary text-primary px-4 py-2 rounded-lg text-center hover:bg-blue-50 transition">
            Project
          </a>
        </div>
      </nav>
    </div>
  </div>
</header>

<style>html{scroll-behavior:smooth}</style>
