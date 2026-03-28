<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthManager;
use App\Http\Controllers\MemberController;
use Illuminate\Http\Request;
use App\Models\Gallery;


Route::get('/', function () {
    return view('welcome');
})->name('home');


Route::post('/upload', function (Request $request) {

    $request->validate([
        'title' => 'required|string|max:255',
        'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:10240'
    ]);

    $file = $request->file('image');
    $filename = time() . '_' . $file->getClientOriginalName();

    $file->move(public_path('images'), $filename);

    Gallery::create([
        'title' => $request->title,
        'image' => 'images/' . $filename
    ]);

    return redirect()->route('gallery')->with('success', 'Slika uspješno dodana!');
    
})->name('upload')->middleware('auth');



Route::get('/gallery', function () {
    $images = Gallery::latest()->get();
    return view('gallery', compact('images'));
})->name('gallery');

Route::get('/login', [AuthManager::class, 'login'])->name('login');
Route::post('/login', [AuthManager::class, 'loginPost'])->name('login.post');

Route::get('/registration', [AuthManager::class, 'registration'])->name('registration');
Route::post('/registration', [AuthManager::class, 'registrationPost'])->name('registration.post');

Route::get('/logout', [AuthManager::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::resource('members', MemberController::class);
});