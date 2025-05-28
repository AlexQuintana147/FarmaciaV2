@extends('layouts.app')

@section('title', 'Métricas del Chatbot')

@section('content')
<div class="container py-4">
    <div class="row">
        <!-- Tarjetas de métricas -->
        <div class="col-md-3 mb-4">
            <div class="card bg-primary text-white h-100">
                <div class="card-body">
                    <h5 class="card-title">Total Interacciones</h5>
                    <h2 class="display-4">{{ $totalInteracciones }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card bg-success text-white h-100">
                <div class="card-body">
                    <h5 class="card-title">Interacciones Hoy</h5>
                    <h2 class="display-4">{{ $interaccionesHoy }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card bg-info text-white h-100">
                <div class="card-body">
                    <h5 class="card-title">Preguntas Únicas</h5>
                    <h2 class="display-4">{{ $preguntasUnicas }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card bg-warning text-white h-100">
                <div class="card-body">
                    <h5 class="card-title">Tiempo Promedio</h5>
                    <h2 class="display-4">{{ round($tiempoPromedioRespuesta, 2) }}s</h2>
                </div>
            </div>
        </div>

        <!-- Tabla de logs -->
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h3 class="card-title mb-0"><i class="fas fa-history me-2"></i>Historial de Interacciones</h3>
                </div>
                <div class="card-body">
                    @if(isset($chatbotLogs) && count($chatbotLogs) > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Trabajador</th>
                                    <th>Pregunta</th>
                                    <th>Respuesta</th>
                                    <th>Fecha de Creación</th>
                                    <th>Última Actualización</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($chatbotLogs as $log)
                                <tr>
                                    <td>{{ $log->id }}</td>
                                    <td>{{ $log->trabajador ? $log->trabajador->nombre : 'Usuario Anónimo' }}</td>
                                    <td>{{ $log->pregunta }}</td>
                                    <td>
                                        @if(strlen($log->respuesta) > 100)
                                            <div class="collapse" id="respuesta-{{ $log->id }}">
                                                {{ $log->respuesta }}
                                            </div>
                                            <button class="btn btn-link p-0" type="button" data-bs-toggle="collapse" data-bs-target="#respuesta-{{ $log->id }}" aria-expanded="false">
                                                {{ substr($log->respuesta, 0, 100) }}...
                                            </button>
                                        @else
                                            {{ $log->respuesta }}
                                        @endif
                                    </td>
                                    <td>{{ $log->created_at->format('d/m/Y H:i:s') }}</td>
                                    <td>{{ $log->updated_at->format('d/m/Y H:i:s') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="text-center py-5">
                        <i class="fas fa-robot fa-3x text-muted mb-3"></i>
                        <p class="h5 text-muted">No hay registros de interacciones con el chatbot</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .table td {
        max-width: 300px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    
    .card-body .collapse {
        max-height: 300px;
        overflow-y: auto;
    }
</style>
@endsection