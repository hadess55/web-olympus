{{-- resources/views/components/sections/faq.blade.php --}}
@once
  <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <style>[x-cloak]{ display:none !important; }</style>
@endonce

<section id="faq" class="py-16 bg-gray-50 dark:bg-neutral-900 scroll-mt-28">
  <div class="container mx-auto lg:max-w-screen-xl md:max-w-screen-md px-4">
    <div class="text-center mb-10" data-aos="fade-up">
      <span class="text-primary text-sm font-semibold tracking-widest">FAQ</span>
      <h2 class="text-3xl md:text-4xl font-bold mt-2 text-gray-900 dark:text-gray-100">
        Pertanyaan yang sering ditanyakan
      </h2>
      <p class="mt-3 max-w-2xl mx-auto text-gray-600 dark:text-gray-300">
        Kalau masih ada yang belum jelas, hubungi saya kapan saja.
      </p>
    </div>

    <div class="mx-auto max-w-3xl divide-y divide-gray-200 dark:divide-white/10
                rounded-2xl bg-white dark:bg-neutral-800 text-gray-700 dark:text-gray-200 shadow-sm"
         data-aos="fade-up">
      @foreach($faqs as $i => $f)
        <div x-data="{open: {{ $loop->first ? 'true' : 'false' }}}">
          <button
            class="w-full flex items-center justify-between gap-4 px-6 py-5 text-left
                   hover:bg-gray-50 dark:hover:bg-white/5 transition-colors"
            @click="open=!open" :aria-expanded="open.toString()">
            <span class="text-base md:text-lg font-medium text-gray-900 dark:text-gray-100">
              {{ $f['q'] }}
            </span>
            <svg :class="open ? 'rotate-180' : ''"
                 class="h-5 w-5 text-gray-600 dark:text-gray-300 transition-transform"
                 viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
              <path fill-rule="evenodd"
                d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z"
                clip-rule="evenodd"/>
            </svg>
          </button>

          <div x-cloak x-show="open" x-transition.opacity x-transition.duration.300ms>
            <div class="px-6 pb-6 text-gray-600 dark:text-gray-300 leading-relaxed">
              {{ $f['a'] }}
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>
