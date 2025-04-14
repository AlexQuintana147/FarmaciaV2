<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\TrabajadorAuthController;
use App\Http\Controllers\DashboardController;

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
    return view('home');
});

Route::get('/productos', function () {
    $productos = App\Models\Producto::all();
    return view('productos', compact('productos'));
});

Route::get('/blog', function () {
    $blogs = App\Models\Blog::with('trabajador')->latest()->get();
    return view('blog', compact('blogs'));
});

// Rutas de autenticación para trabajadores
Route::get('/login', [TrabajadorAuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [TrabajadorAuthController::class, 'login']);
Route::post('/logout', [TrabajadorAuthController::class, 'logout'])->name('logout');

// Rutas del dashboard protegidas por autenticación
Route::middleware(['auth:trabajador'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/blogs', [DashboardController::class, 'blogs'])->name('dashboard.blogs');
    
    // Rutas para productos
    Route::get('/dashboard/productos', [App\Http\Controllers\ProductoController::class, 'index'])->name('dashboard.productos');
    Route::get('/dashboard/productos/create', [App\Http\Controllers\ProductoController::class, 'create'])->name('productos.create');
    Route::post('/dashboard/productos', [App\Http\Controllers\ProductoController::class, 'store'])->name('productos.store');
    Route::get('/dashboard/productos/{producto}', [App\Http\Controllers\ProductoController::class, 'show'])->name('productos.show');
    Route::get('/dashboard/productos/{producto}/edit', [App\Http\Controllers\ProductoController::class, 'edit'])->name('productos.edit');
    Route::put('/dashboard/productos/{producto}', [App\Http\Controllers\ProductoController::class, 'update'])->name('productos.update');
    Route::delete('/dashboard/productos/{producto}', [App\Http\Controllers\ProductoController::class, 'destroy'])->name('productos.destroy');
});
