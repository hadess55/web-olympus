{{-- resources/views/components/sections/services.blade.php --}}
@once
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css">
  <script defer src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
  <script>document.addEventListener('DOMContentLoaded',()=>AOS.init({duration:700, once:true, offset:80}))</script>
  <script defer src="https://code.iconify.design/iconify-icon/1.0.8/iconify-icon.min.js"></script>
@endonce

<section id="services" class="py-16 bg-blue-100 dark:bg-neutral-900 scroll-mt-28">
  <div class="container mx-auto lg:max-w-screen-xl md:max-w-screen-md px-4">
    <div class="text-center mb-12" data-aos="fade-up">
      <span class="text-primary text-sm font-semibold tracking-widest">KEAHLIAN & LAYANAN</span>
      <h2 class="text-3xl md:text-4xl font-bold mt-2 text-gray-900 dark:text-gray-100">
        Apa yang bisa saya bantu
      </h2>
      <p class="mt-3 max-w-2xl mx-auto text-gray-600 dark:text-gray-300">
        Solusi end-to-end dari perencanaan, pengembangan hingga pengiriman.
      </p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
      @foreach($services as $s)
        <article
          class="group rounded-2xl border border-black/5 dark:border-white/10
                 bg-white dark:bg-neutral-800
                 text-gray-700 dark:text-gray-200
                 p-6 shadow-[0_10px_30px_-10px_rgba(0,0,0,0.15)]
                 transition-all hover:-translate-y-1 hover:shadow-xl"
          data-aos="fade-up" data-aos-delay="{{ $loop->index*80 }}"
        >
          <div class="flex items-center gap-3">
            <div class="grid h-12 w-12 place-items-center rounded-xl bg-primary/10 dark:bg-primary/20">
              @if(!empty($s['icon']))
                <iconify-icon icon="{{ $s['icon'] }}" class="text-primary text-2xl"></iconify-icon>
              @endif
            </div>
            <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100">{{ $s['title'] }}</h3>
          </div>

          @if(!empty($s['desc']))
            <p class="mt-4 leading-relaxed text-gray-600 dark:text-gray-300">{{ $s['desc'] }}</p>
          @endif

          @if(!empty($s['tags']) && is_array($s['tags']))
            <div class="mt-5 flex flex-wrap gap-2">
              @foreach($s['tags'] as $tag)
                <span
                  class="rounded-full px-3 py-1 text-xs font-medium
                         bg-blue-100 text-gray-700
                         dark:bg-white/10 dark:text-gray-200 dark:border dark:border-white/10">
                  #{{ $tag }}
                </span>
              @endforeach
            </div>
          @endif

          @if(!empty($s['link']))
            <a href="{{ $s['link'] }}"
               class="mt-6 inline-flex items-center gap-2 text-primary font-medium group-hover:gap-3 transition-all">
              Pelajari lebih lanjut <span aria-hidden="true">›</span>
            </a>
          @endif
        </article>
      @endforeach
    </div>
  </div>
</section>
