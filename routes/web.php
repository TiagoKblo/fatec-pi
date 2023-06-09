<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EditalController;
use App\Http\Controllers\ManifestarController;
use App\Http\Controllers\ProfileController;
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
    return redirect(route('editais.index'));
});



Route::middleware('auth')->group(function () {
    Route::get('/perfil', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/perfil', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/perfil', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('editais', EditalController::class);
Route::resource('manifestar', ManifestarController::class);

Route::get('gerenciar-editais', [EditalController::class, 'gerenciar'])->name('editais.gerenciar');
Route::get('gerenciar-usuarios', [DashboardController::class, 'usuarios'])->name('dashboard.usuarios');


Route::resource('dashboard', DashboardController::class)->name('dashboard.index', 'dashboard');

require __DIR__ . '/auth.php';
