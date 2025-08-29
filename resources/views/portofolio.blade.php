@php
    use Illuminate\Support\Facades\Storage;
    use Illuminate\Support\Str;
    use Illuminate\Support\Carbon;
@endphp
<x-layout>
<section class="bg-gray-100 py-12">
  <div class="container mx-auto lg:max-w-screen-xl md:max-w-screen-md px-4">
    <h1 class="text-3xl md:text-4xl font-semibold mb-8">Project</h1>

    @if($portos->isEmpty())
      <div class="text-center text-gray-500 py-16">Belum ada data portofolio.</div>
    @else
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($portos as $p)
          @php
            $cover = is_array($p->image) ? ($p->image[0] ?? null) : $p->image;
            $coverUrl = $cover ? Storage::url($cover) : asset('images/placeholder.webp');

            $dateText = null;
            if (!empty($p->create_date)) {
                try { $dateText = Carbon::parse($p->create_date)->translatedFormat('d M Y'); } catch (\Exception $e) {}
            }
          @endphp

          <article class="relative flex w-full max-w-[26rem] flex-col rounded-xl bg-white bg-clip-border text-gray-700 shadow-lg">
            {{-- TOP IMAGE --}}
            <div class="relative mx-4 mt-4 overflow-hidden rounded-xl bg-blue-gray-500 bg-clip-border text-white shadow-lg shadow-blue-gray-500/40">
              <img src="{{ $coverUrl }}" alt="{{ $p->name }}" class="w-full h-60 object-cover" loading="lazy" decoding="async">
              <div class="to-bg-black-10 absolute inset-0 h-full w-full bg-gradient-to-tr from-transparent via-transparent to-black/60"></div>

              {{-- logo kecil di pojok kanan atas --}}
              <button
                class="!absolute top-4 right-4 h-8 max-h-[32px] w-8 max-w-[32px] select-none rounded-full text-center align-middle font-sans text-xs font-medium uppercase text-purple-500 transition-all hover:bg-purple-500/10 active:bg-purple-500/30"
                type="button">
                <span class="absolute top-1/5 left-1/5 -translate-y-1/5 -translate-x-1/5 transform">
                  <img src="{{ asset('default/logo2.png') }}" alt="logo" class="w-5 h-5 object-contain">
                </span>
              </button>
            </div>

            {{-- BODY --}}
            <div class="p-6">
              <div class="mb-3 flex items-center justify-between">
                <h5 class="block font-sans text-xl font-medium leading-snug tracking-normal text-blue-gray-900 antialiased">
                  {{ $p->name }}
                </h5>

                @if($dateText)
                  <p class="flex items-center gap-1.5 font-sans text-base font-normal leading-relaxed text-blue-gray-900 antialiased">
                    {{-- star icon (inline svg) --}}
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                         fill="currentColor" aria-hidden="true"
                         class="-mt-0.5 h-5 w-5 text-yellow-700">
                      <path fill-rule="evenodd"
                        d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z"
                        clip-rule="evenodd"></path>
                    </svg>
                    {{ $dateText }}
                  </p>
                @endif
              </div>

              @if(!empty($p->description))
                <p class="block font-sans text-base font-light leading-relaxed text-gray-700 antialiased">
                  {{ Str::limit(strip_tags($p->description), 200) }}
                </p>
              @endif
            </div>

            {{-- CTA --}}
            <div class="p-6 pt-3">
              <a href="{{ route('project.show', $p->id) }}"
                 class="block w-full select-none rounded-lg bg-blue-500 py-3.5 px-7 text-center align-middle font-sans text-sm font-bold uppercase text-white shadow-md shadow-blue-500/20 transition-all hover:shadow-lg hover:shadow-blue-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none">
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

