@extends('layouts.app')

@section('title', 'Métricas del Chatbot')

@section('content')
<div class="container py-4">
    <div class="row">
        <!-- Tarjetas de métricas -->
        <div class="col-md-3 mb-4">
            <div class="card bg-primary text-white h-100 shadow-sm hover-card">
                <div class="card-body text-center">
                    <h5 class="card-title fw-bold">Total Interacciones</h5>
                    <h2 class="display-4 mb-0">{{ $totalInteracciones }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card bg-success text-white h-100 shadow-sm hover-card">
                <div class="card-body text-center">
                    <h5 class="card-title fw-bold">Interacciones Hoy</h5>
                    <h2 class="display-4 mb-0">{{ $interaccionesHoy }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card bg-info text-white h-100 shadow-sm hover-card">
                <div class="card-body text-center">
                    <h5 class="card-title fw-bold">Preguntas Únicas</h5>
                    <h2 class="display-4 mb-0">{{ $preguntasUnicas }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card bg-warning text-white h-100 shadow-sm hover-card">
                <div class="card-body text-center">
                    <h5 class="card-title fw-bold">Tiempo Promedio</h5>
                    <h2 class="display-4 mb-0">{{ round($tiempoPromedioRespuesta, 2) }}s</h2>
                </div>
            </div>
        </div>

        <!-- Tabla de logs -->
        <div class="col-12">
            <div class="card shadow-lg rounded-3 border-0">
                <div class="card-header bg-white py-3 border-0">
                    <h3 class="card-title mb-0 d-flex align-items-center">
                        <i class="fas fa-history me-2 text-primary"></i>
                        <span class="fw-bold">Historial de Interacciones</span>
                    </h3>
                </div>
                <div class="card-body p-0">
                    @if(isset($chatbotLogs) && count($chatbotLogs) > 0)
                    <div class="table-responsive">
                        <table class="table table-hover mb-0 align-middle">
                            <thead class="bg-light">
                                <tr>
                                    <th class="px-4 py-3">ID</th>
                                    <th class="px-4 py-3">Trabajador</th>
                                    <th class="px-4 py-3">Pregunta</th>
                                    <th class="px-4 py-3">Respuesta</th>
                                    <th class="px-4 py-3">Fecha de Creación</th>
                                    <th class="px-4 py-3">Última Actualización</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($chatbotLogs as $log)
                                <tr>
                                    <td class="px-4">{{ $log->id }}</td>
                                    <td class="px-4">
                                        <span class="badge bg-light text-dark">
                                            <i class="fas fa-user me-1"></i>
                                            {{ $log->trabajador ? $log->trabajador->nombre : 'Usuario Anónimo' }}
                                        </span>
                                    </td>
                                    <td class="px-4">
                                        <span class="text-primary fw-medium">{{ $log->pregunta }}</span>
                                    </td>
                                    <td class="px-4">
                                        <div class="d-flex align-items-center">
                                            <div class="text-truncate me-2" style="max-width: 300px;">
                                                {{ substr($log->respuesta, 0, 100) }}
                                                @if(strlen($log->respuesta) > 100)...
                                                @endif
                                            </div>
                                            <button type="button" 
                                                class="btn btn-sm btn-outline-primary" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#respuestaModal{{ $log->id }}">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>

                                        <!-- Modal para la respuesta completa -->
                                        <div class="modal fade" id="respuestaModal{{ $log->id }}" tabindex="-1" aria-labelledby="respuestaModalLabel{{ $log->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-light">
                                                        <h5 class="modal-title" id="respuestaModalLabel{{ $log->id }}">
                                                            <i class="fas fa-comment-dots me-2 text-primary"></i>
                                                            Respuesta Completa
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="p-3 bg-light rounded">
                                                            <p class="mb-0">{{ $log->respuesta }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4">
                                        <span class="text-muted">
                                            <i class="far fa-calendar-alt me-1"></i>
                                            {{ $log->created_at->format('d/m/Y H:i:s') }}
                                        </span>
                                    </td>
                                    <td class="px-4">
                                        <span class="text-muted">
                                            <i class="far fa-clock me-1"></i>
                                            {{ $log->updated_at->format('d/m/Y H:i:s') }}
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="text-center py-5">
                        <i class="fas fa-robot fa-4x text-muted mb-3"></i>
                        <p class="h5 text-muted">No hay registros de interacciones con el chatbot</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .hover-card {
        transition: transform 0.2s ease-in-out;
    }
    
    .hover-card:hover {
        transform: translateY(-5px);
    }

    .table td {
        vertical-align: middle;
    }
    
    .modal-body {
        max-height: 500px;
        overflow-y: auto;
    }

    .text-truncate {
        display: inline-block;
    }

    .badge {
        font-size: 0.9rem;
        padding: 0.5rem 0.75rem;
    }
</style>
@endsection