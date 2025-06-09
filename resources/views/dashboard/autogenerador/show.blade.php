@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="bg-gradient-primary-to-secondary p-3 rounded-3 mb-4 shadow-sm">
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="text-white mb-0"><i class="fas fa-magic me-2"></i>Detalle de Autogeneración</h1>
            <a href="{{ route('autogenerador.logs') }}" class="btn btn-light">
                <i class="fas fa-arrow-left"></i> Volver a la lista
            </a>
        </div>
    </div>
    
    <div class="card shadow border-0 rounded-3 overflow-hidden mb-4">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0 text-primary"><i class="fas fa-info-circle me-2"></i>Información del Registro</h5>
        </div>
        <div class="card-body p-4">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <h6 class="fw-bold text-primary"><i class="fas fa-tag me-1"></i> Título del Producto</h6>
                    <p class="mb-0">{{ $log->titulo }}</p>
                </div>
                <div class="col-md-6 mb-3">
                    <h6 class="fw-bold text-primary"><i class="fas fa-user me-1"></i> Trabajador</h6>
                    <p class="mb-0">{{ $log->trabajador?->usuario ?? 'N/A' }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <h6 class="fw-bold text-primary"><i class="fas fa-calendar-alt me-1"></i> Fecha de Creación</h6>
                    <p class="mb-0">{{ $log->created_at->format('d/m/Y H:i:s') }}</p>
                </div>
                <div class="col-md-6 mb-3">
                    <h6 class="fw-bold text-primary"><i class="fas fa-clock me-1"></i> Última Actualización</h6>
                    <p class="mb-0">{{ $log->updated_at->format('d/m/Y H:i:s') }}</p>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-12">
                    <h6 class="fw-bold text-primary"><i class="fas fa-align-left me-1"></i> Descripción Generada</h6>
                    <div class="p-3 bg-light rounded">
                        <p class="mb-0">{{ $log->descripcion }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="d-flex justify-content-between">
        <a href="{{ route('autogenerador.logs') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-1"></i> Volver a la lista
        </a>
        <a href="{{ route('productos.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i> Crear Nuevo Producto
        </a>
    </div>
</div>
@endsection