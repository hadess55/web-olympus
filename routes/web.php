<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;



Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/project', [ProjectController::class, 'index'])->name('project');
Route::get('/project/{project}', [ProjectController::class, 'show'])->name('project.show');
Route::post('/contact', [HomeController::class, 'store'])->name('contact.store');
// Route::get('/project', function () {
//     return view('portofolio');
// });