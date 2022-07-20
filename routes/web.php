<?php

use App\Http\Controllers\BoxController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome', ["boxes" => \App\Models\Box::all()]);
})->name('boxes');

Route::get('/search', function () {
    return view('welcome', ["boxes" => \App\Models\Box::search(request()->q)->get()]);
});

Route::get('/dashboard-redirect', function () {
    return redirect('/dashboard');
//    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/boxes/{box}', [BoxController::class, 'showDetail'])->name('detail');
Route::get('/crates/{box}', [BoxController::class, 'showDetail'])->name('detail.2');
Route::get('/box/{box}', [BoxController::class, 'showDetail'])->name('detail.3');
Route::get('/crate/{box}', [BoxController::class, 'showDetail'])->name('detail.4');

Route::get('/template/{name}', function($name) {
//    session()->flash('template', $name);
//    \Illuminate\Support\Facades\Response::header('accept-template', true);
//    request()->header('accept-template', true);
    app('view')->share('template', $name);
//    dd(app('view')->getShared());
    return view("templates.$name", ["template" => $name]);
});

Route::get('/sitemap.xml', function () {
    return view('sitemap');
});

require __DIR__.'/auth.php';
require __DIR__.'/oauth.php';
