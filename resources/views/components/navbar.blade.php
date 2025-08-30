<header
  x-data="{
    navbarOpen:false,
    isSignInOpen:false,
    isSignUpOpen:false,
    sticky:false,

    // THEME
    isDark:false,
    applyTheme(){ document.documentElement.classList.toggle('dark', this.isDark); },
    toggleTheme(){ this.isDark = !this.isDark; localStorage.setItem('theme', this.isDark ? 'dark' : 'light'); this.applyTheme(); },

    // INIT
    init(){
      // sticky header
      const onScroll = () => this.sticky = window.scrollY >= 80;
      window.addEventListener('scroll', onScroll);

      // lock body scroll ketika menu/modal terbuka
      this.$watch('navbarOpen', this.toggleBodyOverflow);
      this.$watch('isSignInOpen', this.toggleBodyOverflow);
      this.$watch('isSignUpOpen', this.toggleBodyOverflow);

      // inisialisasi tema dari localStorage / system
      const saved = localStorage.getItem('theme');
      this.isDark = saved ? (saved === 'dark') : window.matchMedia('(prefers-color-scheme: dark)').matches;
      this.applyTheme();

      // scroll ke anchor jika URL memuat hash saat tiba di home
      if (location.hash && document.querySelector(location.hash)) {
        setTimeout(() => this.scrollTo(location.hash), 10);
      }

      // ikuti perubahan system jika user belum memilih
      if(!saved){
        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', e=>{
          this.isDark = e.matches; this.applyTheme();
        });
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
  class="fixed top-0 z-40 w-full pb-5 transition-all duration-300 bg-white dark:bg-neutral-900"
  :class="sticky ? 'shadow-lg py-5' : 'shadow-none py-6'"
>
  @php
    // Menu menuju section di landing
    $headerData = $headerData ?? [
      ['label' => 'Home',      'href' => '#home'],
      ['label' => 'Tools',     'href' => '#tools'],
      ['label' => 'Portfolio', 'href' => '#portfolio'],
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
             class="text-base font-medium text-gray-700 dark:text-gray-200 hover:text-primary transition">
            {{ $item['label'] }}
          </a>
        @endforeach
      </nav>

      {{-- Actions (desktop) --}}
      <div class="flex items-center gap-4">
        {{-- Theme toggle --}}
        <button
          @click="toggleTheme()"
          class="hidden md:inline-flex items-center gap-2 rounded-full border border-gray-200 dark:border-gray-700 bg-white dark:bg-neutral-800 text-gray-800 dark:text-gray-200 px-4 py-2 shadow-sm hover:bg-primary/10 transition"
          aria-label="Toggle theme"
          :title="isDark ? 'Switch to Light' : 'Switch to Dark'">
          <!-- moon -->
          <svg x-show="!isDark" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
            <path d="M21 12.79A9 9 0 1111.21 3a7 7 0 109.79 9.79z"/>
          </svg>
          <!-- sun -->
          <svg x-show="isDark" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
            <path d="M6.76 4.84l-1.8-1.79L3.17 4.84l1.79 1.79 1.8-1.79zm10.48 0l1.79-1.79 1.79 1.79-1.79 1.79-1.79-1.79zM12 5a7 7 0 100 14 7 7 0 000-14zm0-3h-1v3h1V2zm0 20h-1v-3h1v3zM2 11H5v1H2v-1zm17 0h3v1h-3v-1zM4.84 19.16l-1.79 1.79 1.79 1.79 1.79-1.79-1.79-1.79zm14.32 0l1.79 1.79-1.79 1.79-1.79-1.79 1.79-1.79z"/>
          </svg>
          <span class="text-sm hidden xl:inline" x-text="isDark ? 'Light' : 'Dark'"></span>
        </button>

        {{-- CTA Project --}}
        <a href="{{ route('project') }}"
           class="hidden md:block bg-blue-100 text-black hover:bg-blue-200 px-12 py-3 rounded-full text-lg font-medium transition">
          Project
        </a>

        {{-- Hamburger --}}
        <button
          @click="navbarOpen = !navbarOpen"
          class="block lg:hidden p-2 rounded-lg"
          aria-label="Toggle mobile menu"
        >
          <span class="block w-6 h-0.5 bg-black dark:bg-white"></span>
          <span class="block w-6 h-0.5 bg-black dark:bg-white mt-1.5"></span>
          <span class="block w-6 h-0.5 bg-black dark:bg-white mt-1.5"></span>
        </button>
      </div>
    </div>

    {{-- Backdrop --}}
    <template x-if="navbarOpen">
      <div class="fixed inset-0 bg-black/50 z-40" @click="navbarOpen = false"></div>
    </template>

    {{-- Mobile Drawer --}}
    <div
      class="lg:hidden fixed top-0 right-0 h-full w-full max-w-xs bg-neutral-900 text-white shadow-lg z-50
             transform transition-transform duration-300"
      :class="navbarOpen ? 'translate-x-0' : 'translate-x-full'"
      @keydown.escape.window="navbarOpen = false"
    >
      <div class="flex items-center justify-between p-4 relative">
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
             class="w-full text-left px-3 py-2 rounded-lg mb-1 transition hover:bg-white/10">
            {{ $item['label'] }}
          </a>
        @endforeach

        <div class="mt-4 flex flex-col space-y-4 w-full">
          <a href="{{ route('project') }}"
             class="bg-transparent border border-primary text-primary px-4 py-2 rounded-lg text-center hover:bg-gray-600 hover:text-white transition">
            Project
          </a>
        </div>

        {{-- Theme toggle (mobile) --}}
        <div class="mt-4 w-full px-3">
          <div class="flex items-center justify-between">
            <span>Dark mode</span>
            <button @click="toggleTheme()" class="relative h-7 w-12 rounded-full bg-white/10 transition" aria-label="Toggle theme">
              <span class="absolute top-0.5 left-0.5 h-6 w-6 rounded-full bg-white transform transition"
                    :class="isDark ? 'translate-x-5' : ''"></span>
            </button>
          </div>
        </div>
      </nav>
    </div>
  </div>
</header>

<style>html{scroll-behavior:smooth}</style>
