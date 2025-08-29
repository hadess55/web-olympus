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
        $portos = Portofolio::orderByRaw('COALESCE(create_date, created_at, id) DESC')->take(12)->get();
        return view('welcome', compact('portos'));

    }
}
