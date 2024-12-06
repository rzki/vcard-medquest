<?php

use App\Livewire\Dashboard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Livewire\Contacts\ContactIndex;
use App\Livewire\Contacts\ContactCreate;
use App\Livewire\Contacts\ContactDetail;
use App\Livewire\Contacts\ContactEdit;
use App\Livewire\Public\BusinessCardDetail;
use App\Livewire\Roles\RoleCreate;
use App\Livewire\Roles\RoleEdit;
use App\Livewire\Roles\RoleIndex;
use App\Livewire\Users\UserCreate;
use App\Livewire\Users\UserEdit;
use App\Livewire\Users\UserIndex;

Route::middleware('guest')->group(function(){
    Route::get('/', function () {
        return view('auth.login');
    });
});
Auth::routes();
Route::middleware('auth')->group(function () {
    Route::get('/home', Dashboard::class)->name('home');
    Route::get('users', UserIndex::class)->name('users.index');
    Route::get('users/create', UserCreate::class)->name('users.create');
    Route::get('users/edit/{userId}', UserEdit::class)->name('users.edit');
    Route::get('roles', RoleIndex::class)->name('roles.index');
    Route::get('roles/create', RoleCreate::class)->name('roles.create');
    Route::get('roles/edit/{roleId}', RoleEdit::class)->name('roles.edit');
    Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::get('contacts', ContactIndex::class)->name('contacts.index');
    Route::get('contacts/create', ContactCreate::class)->name('contacts.create');
    Route::get('contacts/edit/{contactId}', ContactEdit::class)->name('contacts.edit');
    Route::get('contacts/detail/{contactId}', ContactDetail::class)->name('contacts.detail');
});
