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

Route::get('/nosotros', function () {
    return view('nosotros');
});

Route::get('/farmacovigilancia', function () {
    return view('farmacovigilancia');
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
    
    // Rutas para blogs
    Route::get('/dashboard/blogs', [App\Http\Controllers\BlogController::class, 'index'])->name('dashboard.blogs');
    Route::get('/dashboard/blogs/create', [App\Http\Controllers\BlogController::class, 'create'])->name('blogs.create');
    Route::post('/dashboard/blogs', [App\Http\Controllers\BlogController::class, 'store'])->name('blogs.store');
    Route::get('/dashboard/blogs/{blog}', [App\Http\Controllers\BlogController::class, 'show'])->name('blogs.show');
    Route::get('/dashboard/blogs/{blog}/edit', [App\Http\Controllers\BlogController::class, 'edit'])->name('blogs.edit');
    Route::put('/dashboard/blogs/{blog}', [App\Http\Controllers\BlogController::class, 'update'])->name('blogs.update');
    Route::delete('/dashboard/blogs/{blog}', [App\Http\Controllers\BlogController::class, 'destroy'])->name('blogs.destroy');
    
    // Rutas para productos
    Route::get('/dashboard/productos', [App\Http\Controllers\ProductoController::class, 'index'])->name('dashboard.productos');
    Route::get('/dashboard/productos/create', [App\Http\Controllers\ProductoController::class, 'create'])->name('productos.create');
    Route::post('/dashboard/productos', [App\Http\Controllers\ProductoController::class, 'store'])->name('productos.store');
    Route::get('/dashboard/productos/{producto}', [App\Http\Controllers\ProductoController::class, 'show'])->name('productos.show');
    Route::get('/dashboard/productos/{producto}/edit', [App\Http\Controllers\ProductoController::class, 'edit'])->name('productos.edit');
    Route::put('/dashboard/productos/{producto}', [App\Http\Controllers\ProductoController::class, 'update'])->name('productos.update');
    Route::delete('/dashboard/productos/{producto}', [App\Http\Controllers\ProductoController::class, 'destroy'])->name('productos.destroy');
});
