@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Detalles del Trabajador</h5>
                    <div>
                        <a href="{{ route('dashboard.trabajadores') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left me-1"></i> Volver
                        </a>
                        @if(Auth::guard('trabajador')->user()->usuario === 'admin')
                            <a href="{{ route('trabajadores.edit', $trabajador) }}" class="btn btn-warning btn-sm text-white ms-1">
                                <i class="fas fa-edit me-1"></i> Editar
                            </a>
                            @if($trabajador->usuario !== 'admin')
                                <button type="button" class="btn btn-danger btn-sm ms-1" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                    <i class="fas fa-trash me-1"></i> Eliminar
                                </button>
                            @endif
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">ID:</div>
                        <div class="col-md-8">{{ $trabajador->id }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Usuario:</div>
                        <div class="col-md-8">{{ $trabajador->usuario }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Nombre Completo:</div>
                        <div class="col-md-8">{{ $trabajador->nombre_completo }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Apellidos:</div>
                        <div class="col-md-8">{{ $trabajador->apellidos }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">DNI:</div>
                        <div class="col-md-8">{{ $trabajador->dni }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Fecha de Registro:</div>
                        <div class="col-md-8">{{ $trabajador->created_at->format('d/m/Y H:i:s') }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Última Actualización:</div>
                        <div class="col-md-8">{{ $trabajador->updated_at->format('d/m/Y H:i:s') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de confirmación para eliminar -->
@if(Auth::guard('trabajador')->user()->usuario === 'admin' && $trabajador->usuario !== 'admin')
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirmar eliminación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ¿Está seguro que desea eliminar al trabajador <strong>{{ $trabajador->nombre_completo }}</strong>?
                <p class="text-danger mt-2">Esta acción no se puede deshacer.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <form action="{{ route('trabajadores.destroy', $trabajador) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endif
@endsection