@extends('layouts.app')

@php
    use App\Models\ChatbotLog;
    use Carbon\Carbon;
@endphp

@section('title', 'Métricas del Chatbot')

@section('content')
<div class="container-fluid py-5 bg-light min-vh-100">
    <div class="container">
        <div class="row justify-content-center">
            <!-- Título de la sección -->
            <div class="col-12 text-center mb-5">
                <div class="bg-white p-4 rounded-4 shadow-sm border-0 d-inline-block">
                    <h2 class="text-primary fw-bold mb-2">
                        <i class="fas fa-chart-bar me-3 fs-1"></i>
                        Panel de Métricas
                    </h2>
                    <p class="text-muted fs-5 mb-0">Resumen completo de actividad del chatbot</p>
                </div>
            </div>

            <!-- Tarjetas de métricas -->
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card bg-primary text-white h-100 shadow-lg border-0 rounded-4 overflow-hidden position-relative">
                    <div class="position-absolute top-0 end-0 p-3" style="opacity: 0.2;">
                        <i class="fas fa-comments" style="font-size: 4rem;"></i>
                    </div>
                    <div class="card-body p-4 position-relative">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-white bg-opacity-25 rounded-circle p-3 me-3">
                                <i class="fas fa-comments fa-2x"></i>
                            </div>
                            <div>
                                <h5 class="card-title fw-bold mb-1">Total</h5>
                                <h6 class="card-subtitle mb-0" style="opacity: 0.8;">Interacciones</h6>
                            </div>
                        </div>
                        <h1 class="display-3 fw-bold mb-0 text-end">{{ $totalInteracciones ?? 0 }}</h1>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card bg-success text-white h-100 shadow-lg border-0 rounded-4 overflow-hidden position-relative">
                    <div class="position-absolute top-0 end-0 p-3" style="opacity: 0.2;">
                        <i class="fas fa-calendar-day" style="font-size: 4rem;"></i>
                    </div>
                    <div class="card-body p-4 position-relative">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-white bg-opacity-25 rounded-circle p-3 me-3">
                                <i class="fas fa-calendar-day fa-2x"></i>
                            </div>
                            <div>
                                <h5 class="card-title fw-bold mb-1">Hoy</h5>
                                <h6 class="card-subtitle mb-0" style="opacity: 0.8;">Interacciones</h6>
                            </div>
                        </div>
                        <h1 class="display-3 fw-bold mb-0 text-end">{{ $interaccionesHoy ?? 0 }}</h1>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card bg-info text-white h-100 shadow-lg border-0 rounded-4 overflow-hidden position-relative">
                    <div class="position-absolute top-0 end-0 p-3" style="opacity: 0.2;">
                        <i class="fas fa-question-circle" style="font-size: 4rem;"></i>
                    </div>
                    <div class="card-body p-4 position-relative">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-white bg-opacity-25 rounded-circle p-3 me-3">
                                <i class="fas fa-question-circle fa-2x"></i>
                            </div>
                            <div>
                                <h5 class="card-title fw-bold mb-1">Preguntas</h5>
                                <h6 class="card-subtitle mb-0" style="opacity: 0.8;">Únicas</h6>
                            </div>
                        </div>
                        <h1 class="display-3 fw-bold mb-0 text-end">{{ $preguntasUnicas ?? 0 }}</h1>
                    </div>
                </div>
            </div>

            <!-- Tarjeta de Usuarios Autenticados -->
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card bg-success text-white h-100 shadow-lg border-0 rounded-4 overflow-hidden position-relative">
                    <div class="position-absolute top-0 end-0 p-3" style="opacity: 0.2;">
                        <i class="fas fa-user-shield" style="font-size: 4rem;"></i>
                    </div>
                    <div class="card-body p-4 position-relative">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-white bg-opacity-25 rounded-circle p-3 me-3">
                                <i class="fas fa-user-shield fa-2x"></i>
                            </div>
                            <div>
                                <h5 class="card-title fw-bold mb-1">Usuarios Autenticados</h5>
                                <h6 class="card-subtitle mb-0" style="opacity: 0.8;">{{ $porcentajeAutenticados ?? 0 }}% del total</h6>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-end">
                            <div>
                                <span class="h6 mb-0" style="opacity: 0.8;">Total</span>
                                <h1 class="display-4 fw-bold mb-0">{{ $interaccionesAutenticadas ?? 0 }}</h1>
                            </div>
                            <div class="text-end">
                                <span class="h6 mb-0" style="opacity: 0.8;">Hoy</span>
                                <h3 class="mb-0">{{ ChatbotLog::where('es_autenticado', true)->whereDate('created_at', now())->count() }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tarjeta de Usuarios No Autenticados -->
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card bg-warning text-white h-100 shadow-lg border-0 rounded-4 overflow-hidden position-relative">
                    <div class="position-absolute top-0 end-0 p-3" style="opacity: 0.2;">
                        <i class="fas fa-user" style="font-size: 4rem;"></i>
                    </div>
                    <div class="card-body p-4 position-relative">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-white bg-opacity-25 rounded-circle p-3 me-3">
                                <i class="fas fa-user fa-2x"></i>
                            </div>
                            <div>
                                <h5 class="card-title fw-bold mb-1">Usuarios Invitados</h5>
                                <h6 class="card-subtitle mb-0" style="opacity: 0.8;">{{ 100 - ($porcentajeAutenticados ?? 0) }}% del total</h6>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-end">
                            <div>
                                <span class="h6 mb-0" style="opacity: 0.8;">Total</span>
                                <h1 class="display-4 fw-bold mb-0">{{ $interaccionesNoAutenticadas ?? 0 }}</h1>
                            </div>
                            <div class="text-end">
                                <span class="h6 mb-0" style="opacity: 0.8;">Hoy</span>
                                <h3 class="mb-0">{{ ChatbotLog::where('es_autenticado', false)->whereDate('created_at', now())->count() }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabla de logs -->
            <div class="col-12 mt-4">
                <div class="card shadow-lg rounded-4 border-0 overflow-hidden">
                    <div class="card-header bg-white py-4 border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="card-title mb-0 d-flex align-items-center">
                                    <div class="bg-primary bg-opacity-10 rounded-circle p-3 me-3">
                                        <i class="fas fa-history text-primary fa-lg"></i>
                                    </div>
                                    <div>
                                        <span class="fw-bold text-dark">Historial de Interacciones</span>
                                        <small class="d-block text-muted">Registro detallado de conversaciones</small>
                                    </div>
                                </h3>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-body p-0">
                        @if(isset($chatbotLogs) && count($chatbotLogs) > 0)
                        <div class="table-responsive">
                            <div class="d-flex justify-content-between align-items-center px-4 py-3 bg-primary bg-opacity-5 border-bottom border-primary border-opacity-10">
                                <h6 class="mb-0 text-primary fw-semibold">
                                    <i class="fas fa-list-ul me-2"></i>
                                    Mostrando {{ $chatbotLogs->firstItem() }} - {{ $chatbotLogs->lastItem() }} de {{ $chatbotLogs->total() }} registros
                                </h6>
                            </div>
                            
                            <table class="table table-hover mb-0 align-middle">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="px-4 py-4 fw-bold text-dark border-0">
                                            <i class="fas fa-user me-2 text-primary"></i>Usuario / Tipo
                                        </th>
                                        <th class="px-4 py-4 fw-bold text-dark border-0">
                                            <i class="fas fa-question me-2 text-success"></i>Pregunta
                                        </th>
                                        <th class="px-4 py-4 fw-bold text-dark border-0">
                                            <i class="fas fa-reply me-2 text-info"></i>Respuesta
                                        </th>
                                        <th class="px-4 py-4 fw-bold text-dark border-0">
                                            <i class="fas fa-clock me-2 text-warning"></i>Fecha
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($chatbotLogs as $log)
                                    <tr class="border-bottom border-light">
                                        <td class="px-4 py-3">
                                            <div class="d-flex align-items-center">
                                                <div class="bg-{{ $log->es_autenticado ? 'primary' : 'secondary' }} bg-opacity-10 rounded-circle p-2 me-3">
                                                    <i class="fas fa-user-{{ $log->es_autenticado ? 'shield' : 'alt' }} text-{{ $log->es_autenticado ? 'primary' : 'secondary' }}"></i>
                                                </div>
                                                <div>
                                                    <span class="fw-semibold text-dark d-block">
                                                        @if($log->trabajador)
                                                            {{ $log->trabajador->nombre }}
                                                        @else
                                                            {{ $log->es_autenticado ? 'Usuario' : 'Visitante' }}
                                                        @endif
                                                    </span>
                                                    <small class="text-{{ $log->es_autenticado ? 'primary' : 'secondary' }} fw-bold">
                                                        @if($log->trabajador)
                                                            Trabajador
                                                        @else
                                                            {{ $log->es_autenticado ? 'Usuario Autenticado' : 'No Autenticado' }}
                                                        @endif
                                                    </small>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3">
                                            <div class="bg-success bg-opacity-10 p-3 rounded-3 border border-success border-opacity-20">
                                                <span class="text-dark fw-medium">{{ $log->pregunta }}</span>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3">
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="flex-grow-1">
                                                    <div class="bg-light p-3 rounded-3 border">
                                                        <p class="mb-0 text-muted" style="max-width: 300px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                                            {{ substr($log->respuesta, 0, 100) }}
                                                            @if(strlen($log->respuesta) > 100)...@endif
                                                        </p>
                                                    </div>
                                                </div>
                                                <button type="button" 
                                                    class="btn btn-outline-primary btn-sm rounded-pill px-3" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#respuestaModal{{ $log->id }}">
                                                    <i class="fas fa-expand-alt me-2"></i>Ver completa
                                                </button>
                                            </div>

                                            <!-- Modal para la respuesta completa -->
                                            <div class="modal fade" id="respuestaModal{{ $log->id }}" tabindex="-1" aria-labelledby="respuestaModalLabel{{ $log->id }}" aria-hidden="true">
                                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                                    <div class="modal-content border-0 shadow-lg rounded-4">
                                                        <div class="modal-header bg-primary bg-opacity-10 border-0 rounded-top-4">
                                                            <h5 class="modal-title fw-bold text-primary" id="respuestaModalLabel{{ $log->id }}">
                                                                <i class="fas fa-comment-dots me-2"></i>
                                                                Respuesta Completa
                                                            </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body p-4">
                                                            <div class="bg-light p-4 rounded-3 border">
                                                                <p class="mb-0 text-dark lh-lg">{{ $log->respuesta }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer border-0 bg-light rounded-bottom-4">
                                                            <button type="button" class="btn btn-primary rounded-pill px-4" data-bs-dismiss="modal">
                                                                <i class="fas fa-check me-2"></i>Cerrar
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3">
                                            <div class="d-flex align-items-center">
                                                <div class="bg-warning bg-opacity-10 rounded-circle p-2 me-3">
                                                    <i class="fas fa-calendar-alt text-warning"></i>
                                                </div>
                                                <div>
                                                    <span class="fw-semibold text-dark d-block">
                                                        {{ $log->created_at->format('d/m/Y') }}
                                                    </span>
                                                    <small class="text-muted">
                                                        {{ $log->created_at->format('H:i:s') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="px-4 py-4 bg-light border-top">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="text-muted">
                                    <i class="fas fa-info-circle me-2"></i>
                                    Total de {{ $chatbotLogs->total() }} interacciones registradas
                                </div>
                                <div>
                                    {{ $chatbotLogs->links('pagination::bootstrap-5') }}
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="text-center py-5">
                            <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-4" style="width: 120px; height: 120px;">
                                <i class="fas fa-robot fa-4x text-muted opacity-50"></i>
                            </div>
                            <h4 class="text-muted fw-bold mb-3">No hay registros disponibles</h4>
                            <p class="text-muted fs-5 mb-4">Las interacciones con el chatbot aparecerán aquí</p>
                            <div class="bg-primary bg-opacity-10 p-3 rounded-3 d-inline-block">
                                <small class="text-primary fw-semibold">
                                    <i class="fas fa-lightbulb me-2"></i>
                                    Los registros se actualizan automáticamente
                                </small>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection