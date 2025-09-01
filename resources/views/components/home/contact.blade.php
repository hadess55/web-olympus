{{-- resources/views/components/sections/contact.blade.php --}}
@once
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css">
  <script defer src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
  <script>document.addEventListener('DOMContentLoaded',()=>AOS.init({duration:700, once:true, offset:80}))</script>
  <script defer src="https://code.iconify.design/iconify-icon/1.0.8/iconify-icon.min.js"></script>
@endonce

<section id="contact" class="relative scroll-mt-28 py-16 bg-[#f6f8ff]">
  {{-- BACKDROP (gradien + stripes lembut) --}}
  {{-- <div class="pointer-events-none absolute inset-0">
    <div class="absolute inset-0 bg-gradient-to-br from-purple-200/40 via-transparent to-indigo-200/40"></div>
    <div class="absolute inset-0 opacity-60 [background-image:repeating-linear-gradient(45deg,transparent_0_12px,rgba(255,255,255,.55)_12px_13px)]"></div>
    <div class="absolute -top-16 -left-16 h-56 w-56 rounded-full bg-violet-300/30 blur-3xl"></div>
    <div class="absolute -bottom-20 -right-12 h-64 w-64 rounded-full bg-indigo-300/30 blur-3xl"></div>
  </div> --}}

  <div class="relative container mx-auto lg:max-w-screen-xl md:max-w-screen-md px-4">
    <div class="text-center mb-12" data-aos="fade-up">
      <span class="text-primary text-sm font-semibold tracking-widest">CONTACT</span>
      <h2 class="text-3xl md:text-4xl font-bold mt-2 text-gray-900">
        Ayo ngobrol tentang project kamu
      </h2>
      <p class="text-gray-600 mt-3 max-w-2xl mx-auto">
        Isi form di bawah atau hubungi saya lewat email/WhatsApp.
      </p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
      {{-- Kartu informasi --}}
      <div class="lg:col-span-5 space-y-4">
        {{-- <div class="flex items-start gap-4 rounded-2xl border border-slate-200 bg-white p-5 shadow-sm" data-aos="fade-right">
          <div class="grid h-12 w-12 place-items-center rounded-xl bg-primary/10">
            <iconify-icon icon="tabler:map-pin" class="text-primary text-2xl"></iconify-icon>
          </div>
          <div>
            <h3 class="font-semibold text-gray-900">Alamat</h3>
            <p class="text-gray-600">{{ $address ?? '925 Filbert Street, Pennsylvania 18072' }}</p>
          </div>
        </div> --}}

        <div class="flex items-start gap-4 rounded-2xl border border-slate-200 bg-white p-5 shadow-sm" data-aos="fade-right" data-aos-delay="80">
          <div class="grid h-12 w-12 place-items-center rounded-xl bg-primary/10">
            <iconify-icon icon="tabler:mail" class="text-primary text-2xl"></iconify-icon>
          </div>
          <div>
            <h3 class="font-semibold text-gray-900">Email</h3>
            <a class="text-primary hover:underline" href="mailto:{{ $email ?? 'info@gmail.com' }}">{{ $email ?? 'info@gmail.com' }}</a>
          </div>
        </div>

        <div class="flex items-start gap-4 rounded-2xl border border-slate-200 bg-white p-5 shadow-sm" data-aos="fade-right" data-aos-delay="140">
          <div class="grid h-12 w-12 place-items-center rounded-xl bg-primary/10">
            <iconify-icon icon="tabler:phone" class="text-primary text-2xl"></iconify-icon>
          </div>
          <div>
            <h3 class="font-semibold text-gray-900">Telepon</h3>
            <a class="text-primary hover:underline" href="tel:{{ ($phone ?? '+45 3411-4411') }}">{{ $phone ?? '+45 3411-4411' }}</a>
            @if(!empty($whatsapp))
              <div class="mt-2">
                <a href="https://wa.me/{{ preg_replace('/\D/','',$whatsapp) }}" target="_blank"
                   class="inline-flex items-center gap-2 text-sm text-green-600 hover:underline">
                  <iconify-icon icon="tabler:brand-whatsapp"></iconify-icon> WhatsApp
                </a>
              </div>
            @endif
          </div>
        </div>
      </div>

      {{-- Form kontak --}}
      <div class="lg:col-span-7" data-aos="fade-left">
        @if (session('success'))
          <div class="mb-4 rounded-xl bg-green-50 text-green-700 px-4 py-3">
            {{ session('success') }}
          </div>
        @endif

        @if ($errors->any())
          <div class="mb-4 rounded-xl bg-red-50 text-red-700 px-4 py-3">
            <ul class="list-disc ml-5">
              @foreach ($errors->all() as $err)
                <li>{{ $err }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <form method="POST" action="{{ route('contact.store') }}"
              class="rounded-2xl border border-slate-200 bg-white p-6 shadow-[0_10px_30px_-10px_rgba(0,0,0,0.15)]"
              novalidate>
          @csrf

          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label class="block text-sm font-medium mb-1 text-gray-800">Nama</label>
              <input type="text" name="name" value="{{ old('name') }}" required
                     class="w-full rounded-lg border border-slate-300 bg-white text-gray-900 placeholder-gray-400
                            px-4 py-3 outline-none focus:border-primary focus:ring-4 focus:ring-primary/15 transition">
            </div>

            <div>
              <label class="block text-sm font-medium mb-1 text-gray-800">Email</label>
              <input type="email" name="email" value="{{ old('email') }}" required
                     class="w-full rounded-lg border border-slate-300 bg-white text-gray-900 placeholder-gray-400
                            px-4 py-3 outline-none focus:border-primary focus:ring-4 focus:ring-primary/15 transition">
            </div>
          </div>

          <div class="mt-4">
            <label class="block text-sm font-medium mb-1 text-gray-800">Subjek</label>
            <input type="text" name="subject" value="{{ old('subject') }}"
                   class="w-full rounded-lg border border-slate-300 bg-white text-gray-900 placeholder-gray-400
                          px-4 py-3 outline-none focus:border-primary focus:ring-4 focus:ring-primary/15 transition">
          </div>

          <div class="mt-4">
            <label class="block text-sm font-medium mb-1 text-gray-800">Pesan</label>
            <textarea name="message" rows="6" required
                      class="w-full rounded-lg border border-slate-300 bg-white text-gray-900 placeholder-gray-400
                             px-4 py-3 outline-none focus:border-primary focus:ring-4 focus:ring-primary/15 transition">{{ old('message') }}</textarea>
          </div>

          {{-- Honeypot anti-spam --}}
          <div class="hidden">
            <label>Website</label>
            <input type="text" name="website" autocomplete="off">
          </div>

          <div class="mt-6 flex items-center justify-between gap-3">
            <button type="submit"
                    class="inline-flex items-center justify-center rounded-lg bg-indigo-500 px-6 py-3 font-semibold text-white
                           shadow-md transition hover:bg-indigo-600 hover:shadow-lg focus:ring-4 focus:ring-indigo-500/20">
              Kirim Pesan
            </button>
            <p class="text-xs text-gray-500">
              Dengan mengirimkan pesan ini, Anda setuju dengan kebijakan privasi.
            </p>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
