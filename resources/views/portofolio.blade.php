@php
  $techMap = [
    'tailwind'  => ['label' => 'Tailwind CSS',     'icon' => 'tailwind',  'class' => 'bg-[#E0F2FE] text-[#0EA5E9] ring-[#BAE6FD]'],
    'bootstrap' => ['label' => 'Bootstrap',        'icon' => 'bootstrap', 'class' => 'bg-[#EFE2FF] text-[#7C3AED] ring-[#E9D5FF]'],
    'react'     => ['label' => 'React',            'icon' => 'react',     'class' => 'bg-[#E8F9FF] text-[#06B6D4] ring-[#CFFAFE]'],
    'flutter'   => ['label' => 'Flutter',          'icon' => 'flutter',   'class' => 'bg-[#E6F1FF] text-[#1E88E5] ring-[#C7E0FF]'],
    'wordpress' => ['label' => 'WordPress',        'icon' => 'wordpress', 'class' => 'bg-[#E9F2FF] text-[#1A76B8] ring-[#CDE2FA]'],
    'alpine'    => ['label' => 'Alpine.js',        'icon' => 'alpine',    'class' => 'bg-[#E8EDFF] text-[#1C3FAA] ring-[#D5DEFF]'],
    'laravel'   => ['label' => 'Laravel',          'icon' => 'laravel',   'class' => 'bg-[#FEE2E2] text-[#E11D48] ring-[#FECACA]'],
    'javascript' => ['label' => 'JavaScript',      'icon'  => 'javascript','class' => 'bg-[#FFF9C4] text-[#000000] ring-[#F7DF1E]',],
    'nextjs'    => ['label' => 'Next.js',          'icon' => 'nextjs',    'class' => 'bg-gray-100 text-gray-900 ring-gray-200'],
  ];
@endphp
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
                <div class="flex items-center justify-between">
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

                {{-- @if(!empty($p->technologies))
                  <div class="mt-2 flex flex-wrap gap-2">
                    @foreach($p->technologies as $key)
                      @php
                        $m = $techMap[$key] ?? ['label' => ucfirst($key), 'icon' => null, 'class' => 'bg-gray-100 text-gray-700 ring-gray-200'];
                      @endphp
                      <span class="inline-flex items-center gap-1.5 px-2 py-1 rounded-md text-xs font-medium
                                  ring-1 ring-inset {{ $m['class'] }}">
                        @if($m['icon'])
                          <img src="{{ asset('tech-icons/'.$m['icon'].'.svg') }}" alt="{{ $m['label'] }}"
                              class="h-3.5 w-3.5 shrink-0" loading="lazy" decoding="async">
                        @endif
                        {{ $m['label'] }}
                      </span>
                    @endforeach
                  </div>
                @endif --}}

                @php $max = 3; @endphp
                  <div class="mt-2 flex flex-wrap gap-2">
                    @foreach(array_slice($p->technologies, 0, $max) as $key)
                      @php
                          $m = $techMap[$key] ?? ['label' => ucfirst($key), 'icon' => null, 'class' => 'bg-gray-100 text-gray-700 ring-gray-200'];
                        @endphp
                        <span class="inline-flex items-center gap-1.5 px-2 py-1 rounded-md text-xs font-medium
                                    ring-1 ring-inset {{ $m['class'] }}">
                          @if($m['icon'])
                            <img src="{{ asset('tech-icons/'.$m['icon'].'.svg') }}" alt="{{ $m['label'] }}"
                                class="h-3.5 w-3.5 shrink-0" loading="lazy" decoding="async">
                          @endif
                          {{ $m['label'] }}
                        </span>
                    @endforeach

                    @if(count($p->technologies) > $max)
                      <span class="px-2 py-1 rounded-md text-xs font-medium ring-1 ring-inset
                                  bg-gray-100 text-gray-700 ring-gray-200">
                        +{{ count($p->technologies) - $max }} lainnya
                      </span>
                    @endif
                  </div>

                @if($p->excerpt)
                  <p class="mt-2 text-base font-light leading-relaxed text-gray-700">
                    {{ $p->excerpt }}
                  </p>
                @endif
              </div>

              {{-- CTA --}}
              <div class="p-6 pt-3">
                <a a href="{{ route('project.show', $p->slug) }}"
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
