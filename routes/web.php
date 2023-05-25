<?php

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $images = Image::all();

    return view('welcome', compact('images'));
})->name('homepage');

Route::post('/image/submit', function (Request $request) {
    $validated = $request->validate([
        'image' => 'image'
    ]);

    Image::create([
        'path' => $request->file('image')->store('public/images'),
    ]);

    return redirect(route('homepage'))->with('submitted', 'Hai inserito un\'immagine con successo');

})->name('image.store');
