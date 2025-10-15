<?php


use Domain\Admin\Controllers\EpisodeAdminController;
use Domain\Episode\Controllers\EpisodeController;
use Domain\User\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/laravelpage', function () {
    return Inertia::render('LaravelPage', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/', function () {
    return Inertia::render('Guest/Home', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/', [EpisodeController::class, 'index'])->name('guest.index');
Route::get('/episode/{episode}', [EpisodeController::class, 'show'])->name('guest.episode.show');

Route::prefix('admin')
    ->name('admin.')
    // ->middleware(['auth']) // enable when you wire auth
    ->group(function () {
        Route::get('/episodes/create', [EpisodeAdminController::class, 'create'])->name('episodes.create');
        Route::post('/episodes', [EpisodeAdminController::class, 'store'])->name('episodes.store');
        Route::get('/episodes', [EpisodeAdminController::class, 'index'])->name('episodes.index');
        Route::get('/episodes/{episode}/edit', [EpisodeAdminController::class, 'edit'])->name('episodes.edit');
        Route::put('/episodes/{episode}', [EpisodeAdminController::class, 'update'])->name('episodes.update');
    });

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
