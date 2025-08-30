{{-- resources/views/components/sections/contact.blade.php --}}
@once
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css">
  <script defer src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
  <script>document.addEventListener('DOMContentLoaded',()=>AOS.init({duration:700, once:true, offset:80}))</script>
  <script defer src="https://code.iconify.design/iconify-icon/1.0.8/iconify-icon.min.js"></script>
@endonce

<section id="contact" class="scroll-mt-28 py-16 bg-white dark:bg-neutral-900">
  <div class="container mx-auto lg:max-w-screen-xl md:max-w-screen-md px-4">
    <div class="text-center mb-12" data-aos="fade-up">
      <span class="text-primary text-sm font-semibold tracking-widest">CONTACT</span>
      <h2 class="text-3xl md:text-4xl font-bold mt-2 text-gray-900 dark:text-gray-100">
        Ayo ngobrol tentang project kamu
      </h2>
      <p class="text-gray-600 dark:text-gray-300 mt-3 max-w-2xl mx-auto">
        Isi form di bawah atau hubungi saya lewat email/WhatsApp.
      </p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
      {{-- Kartu informasi --}}
      <div class="lg:col-span-5 space-y-4">
        <div class="flex items-start gap-4 rounded-2xl border border-black/5 dark:border-white/10 bg-white dark:bg-neutral-800 p-5 shadow-sm"
             data-aos="fade-right">
          <div class="grid h-12 w-12 place-items-center rounded-xl bg-primary/10 dark:bg-primary/20">
            <iconify-icon icon="tabler:map-pin" class="text-primary text-2xl"></iconify-icon>
          </div>
          <div>
            <h3 class="font-semibold text-gray-900 dark:text-gray-100">Alamat</h3>
            <p class="text-gray-600 dark:text-gray-300">{{ $address ?? '925 Filbert Street, Pennsylvania 18072' }}</p>
          </div>
        </div>

        <div class="flex items-start gap-4 rounded-2xl border border-black/5 dark:border-white/10 bg-white dark:bg-neutral-800 p-5 shadow-sm"
             data-aos="fade-right" data-aos-delay="80">
          <div class="grid h-12 w-12 place-items-center rounded-xl bg-primary/10 dark:bg-primary/20">
            <iconify-icon icon="tabler:mail" class="text-primary text-2xl"></iconify-icon>
          </div>
          <div>
            <h3 class="font-semibold text-gray-900 dark:text-gray-100">Email</h3>
            <a class="text-primary hover:underline" href="mailto:{{ $email ?? 'info@gmail.com' }}">
              {{ $email ?? 'info@gmail.com' }}
            </a>
          </div>
        </div>

        <div class="flex items-start gap-4 rounded-2xl border border-black/5 dark:border-white/10 bg-white dark:bg-neutral-800 p-5 shadow-sm"
             data-aos="fade-right" data-aos-delay="140">
          <div class="grid h-12 w-12 place-items-center rounded-xl bg-primary/10 dark:bg-primary/20">
            <iconify-icon icon="tabler:phone" class="text-primary text-2xl"></iconify-icon>
          </div>
          <div>
            <h3 class="font-semibold text-gray-900 dark:text-gray-100">Telepon</h3>
            <a class="text-primary hover:underline" href="tel:{{ ($phone ?? '+45 3411-4411') }}">
              {{ $phone ?? '+45 3411-4411' }}
            </a>
            @if(!empty($whatsapp))
              <div class="mt-2">
                <a href="https://wa.me/{{ preg_replace('/\D/','',$whatsapp) }}" target="_blank"
                   class="inline-flex items-center gap-2 text-sm text-green-600 dark:text-green-400 hover:underline">
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
          <div class="mb-4 rounded-xl px-4 py-3 bg-green-50 text-green-700 dark:bg-green-900/20 dark:text-green-300">
            {{ session('success') }}
          </div>
        @endif

        @if ($errors->any())
          <div class="mb-4 rounded-xl px-4 py-3 bg-red-50 text-red-700 dark:bg-red-900/20 dark:text-red-300">
            <ul class="list-disc ml-5">
              @foreach ($errors->all() as $err)
                <li>{{ $err }}</li>
              @endforeach
            </ul>
          </div>
        @endif>

        <form method="POST" action="{{ route('contact.store') }}"
              class="rounded-2xl border border-black/5 dark:border-white/10
                     bg-white dark:bg-neutral-800 p-6
                     shadow-[0_10px_30px_-10px_rgba(0,0,0,0.15)]">
          @csrf

          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label class="block text-sm font-medium mb-1 text-gray-800 dark:text-gray-200">Nama</label>
              <input type="text" name="name" value="{{ old('name') }}" required
                     class="w-full rounded-lg border border-gray-300 dark:border-white/10
                            bg-white dark:bg-neutral-800
                            text-gray-900 dark:text-gray-100
                            placeholder-gray-400 dark:placeholder-gray-400
                            px-4 py-3 outline-none focus:border-primary">
            </div>
            <div>
              <label class="block text-sm font-medium mb-1 text-gray-800 dark:text-gray-200">Email</label>
              <input type="email" name="email" value="{{ old('email') }}" required
                     class="w-full rounded-lg border border-gray-300 dark:border-white/10
                            bg-white dark:bg-neutral-800
                            text-gray-900 dark:text-gray-100
                            placeholder-gray-400 dark:placeholder-gray-400
                            px-4 py-3 outline-none focus:border-primary">
            </div>
          </div>

          <div class="mt-4">
            <label class="block text-sm font-medium mb-1 text-gray-800 dark:text-gray-200">Subjek</label>
            <input type="text" name="subject" value="{{ old('subject') }}"
                   class="w-full rounded-lg border border-gray-300 dark:border-white/10
                          bg-white dark:bg-neutral-800
                          text-gray-900 dark:text-gray-100
                          placeholder-gray-400 dark:placeholder-gray-400
                          px-4 py-3 outline-none focus:border-primary">
          </div>

          <div class="mt-4">
            <label class="block text-sm font-medium mb-1 text-gray-800 dark:text-gray-200">Pesan</label>
            <textarea name="message" rows="6" required
                      class="w-full rounded-lg border border-gray-300 dark:border-white/10
                             bg-white dark:bg-neutral-800
                             text-gray-900 dark:text-gray-100
                             placeholder-gray-400 dark:placeholder-gray-400
                             px-4 py-3 outline-none focus:border-primary">{{ old('message') }}</textarea>
          </div>

          {{-- honeypot anti-spam --}}
          <div class="hidden">
            <label>Website</label>
            <input type="text" name="website" autocomplete="off">
          </div>

          <div class="mt-6 flex items-center justify-between gap-3">
            <button type="submit"
                    class="inline-flex items-center justify-center rounded-lg bg-blue-500 px-6 py-3 font-semibold text-white
                           shadow-md transition hover:bg-blue-600 hover:shadow-lg">
              Kirim Pesan
            </button>
            <p class="text-xs text-gray-500 dark:text-gray-400">
              Dengan mengirimkan pesan ini, Anda setuju dengan kebijakan privasi.
            </p>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
