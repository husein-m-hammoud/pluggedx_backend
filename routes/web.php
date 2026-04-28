<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PluginController;
use App\Http\Controllers\VpsPlanController;
use App\Http\Controllers\DedicatedServerController;




// Route::get('/', function () {
//     return view('plugins');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Homepage - show plugins
Route::get('/', [PluginController::class, 'index'])->name('home');


/*
|--------------------------------------------------------------------------
| Admin Routes (Protected)
|--------------------------------------------------------------------------
*/    

Route::resource('plugins', PluginController::class);
Route::resource('vps-plans', VpsPlanController::class);
Route::resource('dedicated-servers', DedicatedServerController::class);


Route::middleware(['auth'])->prefix('admin')->group(function () {

    Route::get('/dashboard', function () {
        return redirect()->route('plugins.index');
    })->name('admin.dashboard');

});