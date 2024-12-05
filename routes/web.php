<?php

use App\Livewire\Dashboard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Livewire\Contacts\ContactIndex;
use App\Livewire\Contacts\ContactCreate;
use App\Livewire\Contacts\ContactEdit;
use App\Livewire\Public\BusinessCardDetail;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', Dashboard::class)->name('home');

Route::middleware('auth')->group(function () {
    Route::view('about', 'about')->name('about');
    Route::get('users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');
    Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::get('contacts', ContactIndex::class)->name('contacts.index');
    Route::get('contacts/create', ContactCreate::class)->name('contacts.create');
    Route::get('contacts/edit/{contactId}', ContactEdit::class)->name('contacts.edit');
    Route::get('contacts/detail/{contactId}', BusinessCardDetail::class)->name('contact-card.detail');
});
