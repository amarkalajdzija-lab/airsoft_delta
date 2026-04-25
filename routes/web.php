<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthManager;
use App\Http\Controllers\MemberController;
use Illuminate\Http\Request;
use App\Models\Gallery;
use App\Http\Controllers\GalleryController;

Route::get('/', function () {
    return view('welcome');
})->name('home');


Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');
Route::post('/upload', [GalleryController::class, 'upload'])->name('upload')->middleware('auth');

Route::delete('/gallery/{id}', [GalleryController::class, 'destroy'])->name('gallery.destroy')->middleware('auth');

Route::get('/login', [AuthManager::class, 'login'])->name('login');
Route::post('/login', [AuthManager::class, 'loginPost'])->name('login.post');

Route::get('/registration', [AuthManager::class, 'registration'])->name('registration');
Route::post('/registration', [AuthManager::class, 'registrationPost'])->name('registration.post');

Route::get('/logout', [AuthManager::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::resource('members', MemberController::class);
});