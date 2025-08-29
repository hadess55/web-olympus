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
        // Ambil data; urutkan dari yang terbaru (berdasarkan create_date)
        $portos = Portofolio::query()
            ->select(['id','name','image','create_date','description'])
            ->latest('create_date')
            ->get();

        return view('welcome', compact('portos'));
    }
}
