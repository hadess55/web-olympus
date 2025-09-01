<?php

namespace App\Http\Controllers;

use App\Models\Portofolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;

class ProjectController extends Controller
{
    public function index()
    {
        $portos = Portofolio::query()
            ->select('id','name','image', 'tumbnail','create_date','description')
            ->orderByRaw('COALESCE(create_date, created_at, id) DESC')
            ->paginate(9);

        return view('portofolio', compact('portos'));
    }
    // app/Http/Controllers/ProjectController.php

    public function show($id)
    {
        $portofolio = Portofolio::findOrFail($id);

        // Cover dari thumbnail (handle berbagai ejaan)
        $thumb = $portofolio->tumbnail
            ?? $portofolio->tumbnail   // kalau ada yang typo
            ?? $portofolio->thumbnail
            ?? null;

        $coverUrl = $thumb
            ? Storage::url($thumb)
            : asset('images/placeholder.webp');

        // Gallery (json/array)
        $gallery = [];
        if ($portofolio->image) {
            $raw = is_array($portofolio->image) ? $portofolio->image : json_decode($portofolio->image, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($raw)) {
                $gallery = collect($raw)->filter()->map(fn($p) => Storage::url($p))->values()->all();
            }
        }

        // Tanggal
        $dateText = null;
        if (!empty($portofolio->create_date)) {
            try { $dateText = Carbon::parse($portofolio->create_date)->translatedFormat('d M Y'); } catch (\Exception $e) {}
        }

        // >>> Perbaikan di sini: jangan sebutkan kolom yang tidak pasti ada
        $others = Portofolio::where('id', '!=', $portofolio->id)
            ->orderByDesc('create_date')
            ->take(6)
            ->get(); // ambil semua kolom, aman untuk berbagai ejaan

        return view('show', compact('portofolio','coverUrl','gallery','dateText','others'));
    }


    /* =======================
     * Helpers
     * ======================= */

    /**
     * Tentukan URL cover/banner:
     * - pakai tumbnail jika ada,
     * - jika tidak, ambil gambar pertama dari galeri,
     * - fallback placeholder.
     */
    private function coverUrl(Portofolio $p): string
    {
        if (!empty($p->tumbnail)) {
            return $this->toUrl($p->tumbnail);
        }

        $first = $this->firstGalleryPath($p->image);
        if ($first) {
            return $this->toUrl($first);
        }

        return asset('default/Baner.png');
    }

    /**
     * Konversi path storage ke URL; kalau sudah http(s) biarkan.
     */
    private function toUrl(?string $path): ?string
    {
        if (!$path) return null;

        if (preg_match('/^https?:\/\//i', $path)) {
            return $path;
        }

        return Storage::url($path);
    }

    /**
     * Decode kolom image (JSON/array) menjadi array path bersih.
     */
    private function normalizeImages($imageField): array
    {
        if (is_array($imageField)) {
            return array_values(array_filter($imageField));
        }

        if (is_string($imageField) && trim($imageField) !== '') {
            $decoded = json_decode($imageField, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                return array_values(array_filter($decoded));
            }
        }

        return [];
    }

    /**
     * Ambil path gambar pertama dari galeri.
     */
    private function firstGalleryPath($imageField): ?string
    {
        $items = $this->normalizeImages($imageField);
        return $items[0] ?? null;
    }

    /**
     * Build galeri menjadi struktur [['url' => '...'], ...]
     * dan hilangkan item yang sama dengan thumbnail (kalau ada).
     */
    private function buildGallery($imageField, ?string $thumbnail = null): array
    {
        $items = $this->normalizeImages($imageField);

        if ($thumbnail) {
            $items = array_values(array_filter($items, fn ($p) => $p !== $thumbnail));
        }

        return array_map(fn ($p) => ['url' => $this->toUrl($p)], $items);
    }

    /**
     * Format tanggal aman (mis. "25 Apr 2010"), null jika gagal.
     */
    private function formatDate($date): ?string
    {
        if (!$date) return null;

        try {
            return Carbon::parse($date)->translatedFormat('d M Y');
        } catch (\Throwable $e) {
            return null;
        }
    }

}
