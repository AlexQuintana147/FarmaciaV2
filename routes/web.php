<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\TrabajadorAuthController;
use App\Http\Controllers\DashboardController;


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

//Trabajadores
Route::middleware('guest:trabajador')->group(function () {
    Route::get('/login', [TrabajadorAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [TrabajadorAuthController::class, 'login']);
});
Route::post('/logout', [TrabajadorAuthController::class, 'logout'])->name('logout');

//Auth
Route::middleware(['auth:trabajador'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    //Blogs
    Route::get('/dashboard/blogs', [App\Http\Controllers\BlogController::class, 'index'])->name('dashboard.blogs');
    Route::get('/dashboard/blogs/create', [App\Http\Controllers\BlogController::class, 'create'])->name('blogs.create');
    Route::post('/dashboard/blogs', [App\Http\Controllers\BlogController::class, 'store'])->name('blogs.store');
    Route::get('/dashboard/blogs/{blog}', [App\Http\Controllers\BlogController::class, 'show'])->name('blogs.show');
    Route::get('/dashboard/blogs/{blog}/edit', [App\Http\Controllers\BlogController::class, 'edit'])->name('blogs.edit');
    Route::put('/dashboard/blogs/{blog}', [App\Http\Controllers\BlogController::class, 'update'])->name('blogs.update');
    Route::delete('/dashboard/blogs/{blog}', [App\Http\Controllers\BlogController::class, 'destroy'])->name('blogs.destroy');
    
    //Productos
    Route::get('/dashboard/productos', [App\Http\Controllers\ProductoController::class, 'index'])->name('dashboard.productos');
    Route::get('/dashboard/productos/create', [App\Http\Controllers\ProductoController::class, 'create'])->name('productos.create');
    
    //Trabajadores-Dash
    Route::get('/dashboard/trabajadores', [App\Http\Controllers\TrabajadorController::class, 'index'])->name('dashboard.trabajadores');
    Route::get('/dashboard/trabajadores/create', [App\Http\Controllers\TrabajadorController::class, 'create'])->name('trabajadores.create');
    Route::post('/dashboard/trabajadores', [App\Http\Controllers\TrabajadorController::class, 'store'])->name('trabajadores.store');
    Route::get('/dashboard/trabajadores/{trabajador}', [App\Http\Controllers\TrabajadorController::class, 'show'])->name('trabajadores.show');
    Route::get('/dashboard/trabajadores/{trabajador}/edit', [App\Http\Controllers\TrabajadorController::class, 'edit'])->name('trabajadores.edit');
    Route::put('/dashboard/trabajadores/{trabajador}', [App\Http\Controllers\TrabajadorController::class, 'update'])->name('trabajadores.update');
    Route::delete('/dashboard/trabajadores/{trabajador}', [App\Http\Controllers\TrabajadorController::class, 'destroy'])->name('trabajadores.destroy');
    //Productos-Dash
    Route::post('/dashboard/productos', [App\Http\Controllers\ProductoController::class, 'store'])->name('productos.store');
    Route::get('/dashboard/productos/{producto}', [App\Http\Controllers\ProductoController::class, 'show'])->name('productos.show');
    Route::get('/dashboard/productos/{producto}/edit', [App\Http\Controllers\ProductoController::class, 'edit'])->name('productos.edit');
    Route::put('/dashboard/productos/{producto}', [App\Http\Controllers\ProductoController::class, 'update'])->name('productos.update');
    Route::delete('/dashboard/productos/{producto}', [App\Http\Controllers\ProductoController::class, 'destroy'])->name('productos.destroy');
});
