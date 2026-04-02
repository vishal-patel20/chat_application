<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', function () {
        $users = User::where('id', '!=', auth()->id())->get();
        return view('dashboard', ['users' => $users]);
    })->name('dashboard');

    Route::get('/chat/{id}', function ($id) {
        return view('chat', ['id' => $id]);
    })->name('chat');

    Route::get('/group-chat', function () {
        return view('group-chat');
    })->name('group-chat');

});

require __DIR__.'/settings.php';
