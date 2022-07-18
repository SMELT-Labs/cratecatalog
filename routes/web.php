<?php

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

Route::get('/box/{box}', function (\App\Models\Box $box) {
    $prices = $box->prices()->orderByDesc('price')->get();
    return view('detail', [
        'box' => $box,
        'prices' => $prices
    ]);
})->name('detail');

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
