<?php

namespace App\Http\Controllers;

use App\Models\Portofolio;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class HomeController extends Controller
{
     public function index()
    {
        $services = [
            ['icon'=>'tabler:code','title'=>'Web App','desc'=>'Bangun aplikasi web performa tinggi (SPA/SSR).','tags'=>['Laravel','Tailwind','Alpine']],
            ['icon'=>'tabler:api','title'=>'REST/GraphQL API','desc'=>'API scalable, auth & rate-limit siap produksi.','tags'=>['Sanctum','JWT']],
            ['icon'=>'tabler:device-mobile','title'=>'Mobile','desc'=>'Aplikasi mobile cross-platform.','tags'=>['Flutter','PWA']],
            ['icon'=>'tabler:stack-2','title'=>'Integrasi','desc'=>'Payment, Notif, Cloud storage, 3rd party.','tags'=>['Midtrans','WA','S3']],
            ['icon'=>'tabler:rocket','title'=>'DevOps & Deploy','desc'=>'CI/CD, Docker, server, monitoring.','tags'=>['Forge','Docker','CI']],
            ['icon'=>'tabler:message-chatbot','title'=>'Konsultasi','desc'=>'Audit kode & arsitektur, rekomendasi best practice.'],
        ];

        $faqs = [
            ['q'=>'Berapa lama pengerjaan satu proyek?', 'a'=>'Tergantung cakupan. Rata-rata 2–6 minggu untuk fitur inti.'],
            ['q'=>'Teknologi apa yang digunakan?', 'a'=>'Laravel, Tailwind, Alpine, dan Flutter/PWA untuk mobile.'],
            ['q'=>'Apakah support setelah rilis?', 'a'=>'Ya. Tersedia paket maintenance bulanan & SLA.'],
            ['q'=>'Bagaimana alur kerja?', 'a'=>'Kickoff → desain → sprint dev → UAT → rilis → support.'],
        ];

        $portos = Portofolio::orderByRaw('COALESCE(create_date, created_at, id) DESC')->take(6)->get();
        return view('welcome', compact('portos', 'services', 'faqs'));

    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'    => ['required','string','max:120'],
            'email'   => ['required','email','max:150'],
            'subject' => ['nullable','string','max:150'],
            'message' => ['required','string','max:5000'],
            'website' => ['nullable','size:0'], // honeypot harus kosong
        ]);

        // TODO: kirim email / simpan DB
        // Mail::to(config('mail.from.address'))->send(new \App\Mail\ContactMessage($data));

        return back()->with('success', 'Terima kasih! Pesanmu sudah terkirim.');
    }
}
