@php
    use Illuminate\Support\Facades\Storage;
    use Illuminate\Support\Carbon;

    // Siapkan cover & galeri dari kolom "image" (array)
    $images = is_array($portofolio->image) ? $portofolio->image : (array) $portofolio->image;
    $coverPath = $images[0] ?? null;
    $coverUrl  = $coverPath ? Storage::url($coverPath) : asset('images/placeholder.webp');

    // Tanggal
    $dateText = null;
    if (!empty($portofolio->create_date)) {
        try { $dateText = Carbon::parse($portofolio->create_date)->translatedFormat('d M Y'); } catch (\Exception $e) {}
    }
@endphp
<x-layout>
        <section class="bg-gray-100 py-12">
  <div class="container mx-auto lg:max-w-screen-xl md:max-w-screen-md px-4">
    {{-- Breadcrumb / Back --}}
    <div class="mb-6">
      <a href="{{ route('project') }}"
         class="inline-flex items-center gap-2 text-sm text-primary hover:underline">
        ‹ Kembali ke Project
      </a>
    </div>

    <article class="mx-auto max-w-4xl">
      {{-- Kartu utama --}}
      <div class="relative flex w-full flex-col rounded-xl bg-white bg-clip-border text-gray-700 shadow-lg">
        {{-- COVER --}}
        <div class="relative mx-4 mt-4 overflow-hidden rounded-xl bg-blue-gray-500 bg-clip-border text-white shadow-lg shadow-blue-gray-500/40">
          <img src="{{ $coverUrl }}" alt="{{ $portofolio->name }}" class="w-full h-80 object-cover" loading="eager" decoding="async">
          <div class="to-bg-black-10 absolute inset-0 h-full w-full bg-gradient-to-tr from-transparent via-transparent to-black/60"></div>

          {{-- Logo bulat kecil di kanan-atas --}}
          <button
            class="!absolute top-4 right-4 h-8 max-h-[32px] w-8 max-w-[32px] select-none rounded-full text-center align-middle font-sans text-xs font-medium uppercase text-purple-500 transition-all hover:bg-purple-500/10 active:bg-purple-500/30"
            type="button" aria-label="Brand">
            <span class="absolute top-1/5 left-1/5 -translate-y-1/5 -translate-x-1/5 transform">
              <img src="{{ asset('default/logo2.png') }}" alt="logo" class="w-5 h-5 object-contain">
            </span>
          </button>
        </div>

        {{-- BODY --}}
        <div class="p-6">
          <div class="mb-3 flex items-center justify-between">
            <h1 class="block font-sans text-2xl md:text-3xl font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased">
              {{ $portofolio->name }}
            </h1>

            @if($dateText)
              <p class="flex items-center gap-1.5 font-sans text-base font-normal leading-relaxed text-blue-gray-900 antialiased">
                {{-- ikon bintang kecil (sesuai card contoh) --}}
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

          @if(!empty($portofolio->description))
            <div class="prose max-w-none text-gray-700 leading-relaxed">
              {!! nl2br(e($portofolio->description)) !!}
            </div>
          @endif
        </div>

        {{-- CTA --}}
        <div class="p-6 pt-3">
          <a href="{{ url()->previous() }}"
             class="block w-full select-none rounded-lg bg-blue-500 py-3.5 px-7 text-center align-middle font-sans text-sm font-bold uppercase text-white shadow-md shadow-blue-500/20 transition-all hover:shadow-lg hover:shadow-blue-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none">
            Kembali
          </a>
        </div>
      </div>

      {{-- GALERI gambar tambahan (jika ada) --}}
      @if(count($images) > 1)
        <div class="mt-8 grid grid-cols-2 md:grid-cols-3 gap-4">
          @foreach($images as $idx => $imgPath)
            @continue($idx === 0)
            @php
              $url = $imgPath ? Storage::url($imgPath) : null;
            @endphp
            @if($url)
              <a href="{{ $url }}" target="_blank"
                 class="group overflow-hidden rounded-xl shadow hover:shadow-lg transition">
                <img src="{{ $url }}" alt="gallery {{ $idx }}"
                     class="w-full h-40 object-cover group-hover:scale-105 transition-transform duration-300">
              </a>
            @endif
          @endforeach
        </div>
      @endif
    </article>
  </div>
</section>
</x-layout>

