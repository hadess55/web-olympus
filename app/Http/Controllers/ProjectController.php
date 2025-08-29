<?php

namespace App\Http\Controllers;

use App\Models\Portofolio;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $portos = Portofolio::query()
            ->select('id','name','image','create_date','description')
            ->orderByRaw('COALESCE(create_date, created_at, id) DESC')
            ->paginate(9);

        return view('portofolio', compact('portos'));
    }
    public function show(Portofolio $portofolio)
    {
        return view('show', compact('portofolio'));
    }
}
