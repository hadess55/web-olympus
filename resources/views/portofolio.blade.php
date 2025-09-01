<x-layout>
  <section class="bg-gray-100 py-12">
    <div class="container mx-auto lg:max-w-screen-xl md:max-w-screen-md px-4">
      <h1 class="text-3xl md:text-4xl font-semibold mb-8 text-gray-900">Project</h1>

      @if($portos->isEmpty())
        <div class="text-center text-gray-500 py-16">Belum ada data portofolio.</div>
      @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
          @foreach($portos as $p)
            <article
              class="relative flex w-full flex-col rounded-xl
                     bg-white text-gray-700
                     border border-black/5 shadow-lg transition
                     hover:-translate-y-1 hover:shadow-xl">

              {{-- TOP IMAGE --}}
              <div class="relative mx-4 mt-4 overflow-hidden rounded-xl bg-clip-border text-white shadow-lg">
                <img
                  src="{{ $p->cover_url }}"
                  alt="{{ $p->name }}"
                  width="768" height="480"
                  class="w-full h-60 object-cover"
                  loading="lazy" decoding="async">
                <div class="absolute inset-0 h-full w-full bg-gradient-to-tr from-transparent via-transparent to-black/60"></div>

                {{-- logo kecil --}}
                <button
                  class="!absolute top-4 right-4 h-8 max-h-[32px] w-8 max-w-[32px] select-none rounded-full
                         text-center align-middle text-purple-600 transition
                         hover:bg-purple-500/10 active:bg-purple-500/30"
                  type="button" aria-label="Brand">
                  <span class="absolute top-1/5 left-1/5 -translate-y-1/5 -translate-x-1/5 transform">
                    <img src="{{ asset('default/logo2.png') }}" alt="logo" class="w-5 h-5 object-contain">
                  </span>
                </button>
              </div>

              {{-- BODY --}}
              <div class="p-6">
                <div class="mb-3 flex items-center justify-between">
                  <h5 class="block text-xl font-medium leading-snug tracking-normal text-gray-900">
                    {{ $p->name }}
                  </h5>

                  @if($p->formatted_date)
                    <p class="flex items-center gap-1.5 text-base leading-relaxed text-gray-700">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                             fill="currentColor" class="-mt-0.5 h-5 w-5 text-indigo-600">
                          <path d="M6 2a1 1 0 0 1 1 1v1h6V3a1 1 0 1 1 2 0v1h1.5A1.5 1.5 0 0 1 18 5.5V7H2V5.5A1.5 1.5 0 0 1 3.5 4H5V3a1 1 0 0 1 1-1Z"/>
                          <path d="M2 8h16v6.5A1.5 1.5 0 0 1 16.5 16h-13A1.5 1.5 0 0 1 2 14.5V8Z"/>
                        </svg>
                      {{ $p->formatted_date }}
                    </p>
                  @endif
                </div>

                @if($p->excerpt)
                  <p class="text-base font-light leading-relaxed text-gray-700">
                    {{ $p->excerpt }}
                  </p>
                @endif
              </div>

              {{-- CTA --}}
              <div class="p-6 pt-3">
                <a href="{{ route('project.show', $p->id) }}"
                   class="block w-full select-none rounded-lg bg-indigo-500 py-3.5 px-7 text-center text-sm font-bold uppercase text-white
                          shadow-md shadow-indigo-600/20 transition-all hover:shadow-lg hover:shadow-blue-indigo/40 focus:opacity-[0.9]">
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
