@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">Dashboard</h1>
    
    <!-- Tarjetas de estadísticas -->
    <div class="row mb-4">
        <div class="col-md-4 mb-3">
            <div class="card bg-primary text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Productos</h5>
                            <h2 class="display-4">{{ $stats['productos'] }}</h2>
                        </div>
                        <i class="fas fa-box fa-3x"></i>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a href="{{ route('dashboard.productos') }}" class="text-white">Ver detalles</a>
                    <i class="fas fa-angle-right"></i>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 mb-3">
            <div class="card bg-success text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Blogs</h5>
                            <h2 class="display-4">{{ $stats['blogs'] }}</h2>
                        </div>
                        <i class="fas fa-blog fa-3x"></i>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a href="{{ route('dashboard.blogs') }}" class="text-white">Ver detalles</a>
                    <i class="fas fa-angle-right"></i>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 mb-3">
            <div class="card bg-info text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Trabajadores</h5>
                            <h2 class="display-4">{{ $stats['trabajadores'] }}</h2>
                        </div>
                        <i class="fas fa-users fa-3x"></i>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a href="#" class="text-white">Ver detalles</a>
                    <i class="fas fa-angle-right"></i>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Contenido reciente -->
    <div class="row">
        <!-- Blogs recientes -->
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Blogs Recientes</h5>
                </div>
                <div class="card-body">
                    <div class="list-group">
                        @foreach($recentBlogs as $blog)
                            <a href="#" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">{{ $blog->titulo }}</h5>
                                    <small>{{ $blog->created_at->diffForHumans() }}</small>
                                </div>
                                <p class="mb-1">{{ Str::limit($blog->subtitulo, 100) }}</p>
                                <small>Por: {{ $blog->trabajador->nombre_completo }}</small>
                            </a>
                        @endforeach
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('dashboard.blogs') }}" class="btn btn-primary btn-sm">Ver todos los blogs</a>
                </div>
            </div>
        </div>
        
        <!-- Productos recientes -->
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Productos Recientes</h5>
                </div>
                <div class="card-body">
                    <div class="list-group">
                        @foreach($recentProductos as $producto)
                            <a href="#" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">{{ $producto->titulo }}</h5>
                                    <small>{{ $producto->categoria }}</small>
                                </div>
                                <p class="mb-1">{{ Str::limit($producto->descripcion, 100) }}</p>
                            </a>
                        @endforeach
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('dashboard.productos') }}" class="btn btn-success btn-sm">Ver todos los productos</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Podemos agregar scripts específicos para el dashboard aquí
    document.addEventListener('DOMContentLoaded', function() {
        console.log('Dashboard cargado correctamente');
    });
</script>
@endsection