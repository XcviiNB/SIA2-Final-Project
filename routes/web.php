<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\GameController;
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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum', config('jetstream.auth_session'), 'verified', ])->group(function () {
        Route::get('/dashboard', function () {return Inertia::render('Dashboard');})->name('dashboard');

        Route::get('/games', [GameController::class, 'index'])->name('games');
        Route::get('/games/create', [GameController::class, 'create'])->name('games.create');
        Route::post('/games', [GameController::class, 'store'])->name('games.store');
        Route::get('/games/{game}', [GameController::class, 'show'])->name('game.show');
        Route::get('/games/edit/{game}', [GameController::class , 'edit'])->name('game.edit');
        Route::patch('/games/{game}', [GameController::class, 'update'])->name('game.update');
        Route::delete('/games/{game}', [GameController::class, 'destroy'])->name('game.delete');
        Route::get('/games/search/{searchKey}', [GameController::class, 'search'])->name('game.search');

        Route::get('/admin', [AdminController::class, 'index'])->name('admin');
        Route::post('/admin/email', [AdminController::class, 'sendEmailToAll'])->name('admin.email');

        Route::post('/games/toggle/{game}', [GameController::class, 'toggleActive'])->name('toggleAvailability');
});
