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

Route::redirect('/', '/editais');

Route::middleware('auth')->group(function () {
    Route::get('/perfil', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/perfil', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/perfil', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('gerenciar-editais', [EditalController::class, 'gerenciar'])->name('editais.gerenciar');
Route::get('gerenciar-usuarios', [DashboardController::class, 'usuarios'])->name('dashboard.usuarios');
Route::get('manifestar/{id}/documentos', [ManifestarController::class, 'documentos'])->name('manifestar.documentos');

Route::resource('editais', EditalController::class);
Route::resource('manifestar', ManifestarController::class);
Route::resource('dashboard', DashboardController::class)->only(['index'])->names([
    'index' => 'dashboard',
]);

require __DIR__ . '/auth.php';
