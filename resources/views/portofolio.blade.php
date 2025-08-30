<x-layout>
  <section class="bg-gray-100 dark:bg-neutral-900 py-12">
    <div class="container mx-auto lg:max-w-screen-xl md:max-w-screen-md px-4">
      <h1 class="text-3xl md:text-4xl font-semibold mb-8 text-gray-900 dark:text-gray-100">Project</h1>

      @if($portos->isEmpty())
        <div class="text-center text-gray-500 dark:text-gray-400 py-16">Belum ada data portofolio.</div>
      @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
          @foreach($portos as $p)
            <article
              class="relative flex w-full max-w-[26rem] flex-col rounded-xl
                     bg-white dark:bg-neutral-800
                     text-gray-700 dark:text-gray-200
                     border border-black/5 dark:border-white/10
                     shadow-lg">
              {{-- TOP IMAGE --}}
              <div class="relative mx-4 mt-4 overflow-hidden rounded-xl bg-clip-border text-white shadow-lg">
                <img
                  src="{{ $p->cover_url }}"
                  alt="{{ $p->name }}"
                  width="768" height="480"
                  class="w-full h-60 object-cover"
                  loading="lazy" decoding="async">
                <div class="absolute inset-0 h-full w-full bg-gradient-to-tr from-transparent via-transparent to-black/60 dark:to-black/70"></div>

                {{-- logo kecil --}}
                <button
                  class="!absolute top-4 right-4 h-8 max-h-[32px] w-8 max-w-[32px] select-none rounded-full
                         text-center align-middle text-purple-500 transition-all
                         hover:bg-purple-500/10 active:bg-purple-500/30"
                  type="button" aria-label="Brand">
                  <span class="absolute top-1/5 left-1/5 -translate-y-1/5 -translate-x-1/5 transform">
                    <img src="{{ asset('default/logo2.png') }}" alt="logo" class="w-5 h-5 object-contain dark:invert">
                  </span>
                </button>
              </div>

              {{-- BODY --}}
              <div class="p-6">
                <div class="mb-3 flex items-center justify-between">
                  <h5 class="block text-xl font-medium leading-snug tracking-normal text-gray-900 dark:text-gray-100">
                    {{ $p->name }}
                  </h5>

                  @if($p->formatted_date)
                    <p class="flex items-center gap-1.5 text-base leading-relaxed text-gray-700 dark:text-gray-300">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                           fill="currentColor" class="-mt-0.5 h-5 w-5 text-yellow-700 dark:text-yellow-500">
                        <path fill-rule="evenodd"
                              d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z"
                              clip-rule="evenodd" />
                      </svg>
                      {{ $p->formatted_date }}
                    </p>
                  @endif
                </div>

                @if($p->excerpt)
                  <p class="text-base font-light leading-relaxed text-gray-700 dark:text-gray-300">
                    {{ $p->excerpt }}
                  </p>
                @endif
              </div>

              {{-- CTA --}}
              <div class="p-6 pt-3">
                <a href="{{ route('project.show', $p->id) }}"
                   class="block w-full select-none rounded-lg bg-blue-500 py-3.5 px-7 text-center text-sm font-bold uppercase text-white shadow-md shadow-blue-500/20 transition-all hover:shadow-lg hover:shadow-blue-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none">
                  Detail
                </a>
              </div>
            </article>
          @endforeach
        </div>

        {{-- Pagination --}}
        <div class="mt-10">
          {{ $portos->onEachSide(1)->links() }}
        </div>
      @endif
    </div>
  </section>
</x-layout>
