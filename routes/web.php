<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubDomainController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\Profiler\Profile;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    

    Route::controller(SubDomainController::class)->group(function() {

        Route::get('/domains', 'index');
        Route::get('/domain', 'create');
        Route::post('/domain', 'store');
        Route::delete('/domains/{id}', 'destroy')->name('domains.destroy');
        Route::get('accept/{token}', 'accept')->name('accept');

    });

});


require __DIR__.'/auth.php';



