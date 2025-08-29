{{-- <header class="bg-white dark:bg-gray-800 shadow-lg mt-4 mx-5 rounded-4xl">
        <nav class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a href="/" class="text-2xl font-bold text-indigo-800 dark:text-white transition-colors duration-300">
                <img src="{{ asset('default/Logo.png') }}" alt="logo" class="w-16 h-auto">
            </a>
            <div class="hidden md:flex space-x-6">
                <a href="#" class="nav-link text-gray-700 dark:text-gray-200 hover:text-indigo-800 dark:hover:text-white transition-colors duration-300">Home</a>
                <a href="#" class="nav-link text-gray-700 dark:text-gray-200 hover:text-indigo-800 dark:hover:text-white transition-colors duration-300">About</a>
                <a href="#" class="nav-link text-gray-700 dark:text-gray-200 hover:text-indigo-800 dark:hover:text-white transition-colors duration-300">Services</a>
                <a href="#" class="nav-link text-gray-700 dark:text-gray-200 hover:text-indigo-800 dark:hover:text-white transition-colors duration-300">Contact</a>
            </div>
            <div class="hidden md:flex items-center space-x-4">
                <button id="darkModeToggle" class="text-gray-700 dark:text-gray-200 hover:text-indigo-800 dark:hover:text-white focus:outline-none transition-colors duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                    </svg>
                </button>
                <a href="#" class="bg-indigo-800 text-white px-4 py-2 rounded-lg hover:bg-blue-900 transition-colors duration-300">Sign Up</a>
            </div>
            <button id="mobileMenuButton" class="md:hidden text-gray-700 dark:text-gray-200 hover:text-indigo-800 dark:hover:text-white focus:outline-none transition-colors duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </nav>
        <div id="mobileMenu" class="mobile-menu md:hidden bg-white dark:bg-gray-800 shadow-lg absolute w-full left-0 transform -translate-y-full opacity-0">
            <div class="container mx-auto px-4 py-4 space-y-4">
                <a href="#" class="block text-gray-700 dark:text-gray-200 hover:text-indigo-800 dark:hover:text-white transition-colors duration-300">Home</a>
                <a href="#" class="block text-gray-700 dark:text-gray-200 hover:text-indigo-800 dark:hover:text-white transition-colors duration-300">About</a>
                <a href="#" class="block text-gray-700 dark:text-gray-200 hover:text-indigo-800 dark:hover:text-white transition-colors duration-300">Services</a>
                <a href="#" class="block text-gray-700 dark:text-gray-200 hover:text-indigo-800 dark:hover:text-white transition-colors duration-300">Contact</a>
                <a href="#" class="inline-block bg-indigo-800 text-white px-4 py-2 rounded-lg hover:bg-blue-900 transition-colors duration-300">Sign Up</a>
            </div>
        </div>
</header> --}}
<header
  x-data="{
    navbarOpen:false,
    isSignInOpen:false,
    isSignUpOpen:false,
    sticky:false,
    init() {
      // Sticky on scroll
      const onScroll = () => this.sticky = window.scrollY >= 80;
      window.addEventListener('scroll', onScroll);

      // Lock body scroll saat modal/menu terbuka
      this.$watch('navbarOpen', this.toggleBodyOverflow);
      this.$watch('isSignInOpen', this.toggleBodyOverflow);
      this.$watch('isSignUpOpen', this.toggleBodyOverflow);
    },
    toggleBodyOverflow() {
      document.body.style.overflow = (this.navbarOpen || this.isSignInOpen || this.isSignUpOpen) ? 'hidden' : '';
    }
  }"
  class="fixed top-0 z-40 w-full pb-5 transition-all duration-300 bg-white"
  :class="sticky ? 'shadow-lg py-5' : 'shadow-none py-6'"
>
  @php
    // Jika tidak di-pass dari controller, kita sediakan default
    $headerData = $headerData ?? [
      ['label' => 'Home', 'href' =>  '/'],
      ['label' => 'Features', 'href' => '#features'],
      ['label' => 'Pricing', 'href' => '#pricing'],
      ['label' => 'About', 'href' => '#about'],
    ];
  @endphp

  <div class="lg:py-0 py-2">
    <div class="container mx-auto lg:max-w-screen-xl md:max-w-screen-md flex items-center justify-between px-4">
      {{-- Logo --}}
      <a href="{{ url('/') }}" class="flex items-center gap-2">
        {{-- Ganti dengan komponen/logo kamu --}}
        <img src="{{ asset('default/logo2.png') }}" alt="Logo" class="h-12 w-auto">
      </a>

      {{-- Desktop Nav --}}
      <nav class="hidden lg:flex flex-grow items-center gap-8 justify-center">
        @foreach($headerData as $item)
          @php
            $active = url()->current() === $item['href'];
          @endphp
          <a href="{{ $item['href'] }}"
             class="text-base font-medium transition
                    {{ $active ? 'text-primary' : 'text-gray-700 hover:text-primary' }}">
            {{ $item['label'] }}
          </a>
        @endforeach
      </nav>

      {{-- Actions --}}
      <div class="flex items-center gap-4">
        <a href="{{ route('project') }}"
           class="hidden md:block bg-blue-100 hover:bg-primary text-primary hover:bg-blue-300 text-black px-12 py-3 rounded-full text-lg font-medium transition">
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

    {{-- Backdrop untuk mobile menu --}}
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
          <img src="{{ asset('default/logo.png') }}" alt="Logo" class="h-8 w-auto">
        </a>
        <button
          @click="navbarOpen = false"
          class="w-5 h-5 absolute top-0 right-0 mr-8 mt-8"
          aria-label="Close menu Modal"
        >
          ✕
        </button>
      </div>

      <nav class="flex flex-col items-start p-4">
        @foreach($headerData as $item)
          <a href="{{ $item['href'] }}"
             class="w-full text-left px-3 py-2 rounded-lg mb-1 transition
                    hover:bg-white/10">
            {{ $item['label'] }}
          </a>
        @endforeach

        <div class="mt-4 flex flex-col space-y-4 w-full">
          <a href="{{ route('project') }}"
             class="bg-transparent border border-primary text-primary px-4 py-2 rounded-lg text-center hover:bg-gray-600 hover:text-white transition">
            Project
          </a>
        </div>
      </nav>
    </div>
  </div>

  {{-- Modal Sign In --}}
  <template x-if="isSignInOpen">
    <div class="fixed inset-0 bg-black/50 flex items-center justify-center z-50"
         @keydown.escape.window="isSignInOpen = false">
      <div
        class="relative mx-auto w-full max-w-md overflow-hidden rounded-lg px-8 pt-14 pb-8 text-center bg-white"
        @click.outside="isSignInOpen = false"
        x-trap.noscroll="isSignInOpen"
      >
        <button
          @click="isSignInOpen = false"
          class="absolute top-0 right-0 mr-8 mt-8"
          aria-label="Close Sign In Modal"
        >✕</button>

        {{-- Ganti dengan partial/form kamu --}}
        @includeIf('auth.signin')
      </div>
    </div>
  </template>

  <template x-if="isSignUpOpen">
    <div class="fixed inset-0 bg-black/50 flex items-center justify-center z-50"
         @keydown.escape.window="isSignUpOpen = false">
      <div
        class="relative mx-auto w-full max-w-md overflow-hidden rounded-lg bg-white backdrop-blur-md px-8 pt-14 pb-8 text-center"
        @click.outside="isSignUpOpen = false"
        x-trap.noscroll="isSignUpOpen"
      >
        <button
          @click="isSignUpOpen = false"
          class="absolute top-0 right-0 mr-8 mt-8"
          aria-label="Close Sign Up Modal"
        >✕</button>

        {{-- Ganti dengan partial/form kamu --}}
        @includeIf('auth.signup')
      </div>
    </div>
  </template>
</header>
