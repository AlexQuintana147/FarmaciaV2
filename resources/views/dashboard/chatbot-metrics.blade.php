@extends('layouts.app')

@section('title', 'Métricas del Chatbot')

@section('content')
<div class="metrics-dashboard p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="metrics-title mb-0">Panel de Control del Chatbot</h2>
        <div class="metrics-period">
            <select class="form-select">
                <option>Últimas 24 horas</option>
                <option>Última semana</option>
                <option>Último mes</option>
            </select>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="metric-card h-100 bg-white rounded-4 p-4 shadow-sm border-start border-5 border-primary">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h3 class="metric-value mb-1">{{ isset($totalInteracciones) ? number_format($totalInteracciones) : 0 }}</h3>
                        <p class="metric-label text-muted mb-0">Total de Interacciones</p>
                    </div>
                    <div class="metric-icon bg-primary-subtle rounded-circle p-3">
                        <i class="fas fa-comments fa-2x text-primary"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="metric-card h-100 bg-white rounded-4 p-4 shadow-sm border-start border-5 border-success">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h3 class="metric-value mb-1">{{ isset($interaccionesHoy) ? number_format($interaccionesHoy) : 0 }}</h3>
                        <p class="metric-label text-muted mb-0">Interacciones Hoy</p>
                    </div>
                    <div class="metric-icon bg-success-subtle rounded-circle p-3">
                        <i class="fas fa-chart-line fa-2x text-success"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="metric-card h-100 bg-white rounded-4 p-4 shadow-sm border-start border-5 border-info">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h3 class="metric-value mb-1">{{ isset($preguntasUnicas) ? number_format($preguntasUnicas) : 0 }}</h3>
                        <p class="metric-label text-muted mb-0">Preguntas Únicas</p>
                    </div>
                    <div class="metric-icon bg-info-subtle rounded-circle p-3">
                        <i class="fas fa-question-circle fa-2x text-info"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-6">
            <div class="bg-white rounded-4 p-4 shadow-sm h-100">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="h5 mb-0">Preguntas Más Frecuentes</h3>
                    <button class="btn btn-sm btn-outline-primary">Ver Todas</button>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th class="border-0">Pregunta</th>
                                <th class="border-0 text-end">Frecuencia</th>
                                <th class="border-0 text-end">Tendencia</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($preguntasFrecuentes as $pregunta)
                            <tr>
                                <td class="border-0">{{ Str::limit($pregunta['pregunta'], 50) }}</td>
                                <td class="border-0 text-end">{{ number_format($pregunta['total']) }}</td>
                                <td class="border-0 text-end">
                                    @if($pregunta['tendencia'] > 50)
                                        <span class="badge bg-success-subtle text-success">↑ {{ $pregunta['tendencia'] }}%</span>
                                    @elseif($pregunta['tendencia'] < 30)
                                        <span class="badge bg-danger-subtle text-danger">↓ {{ $pregunta['tendencia'] }}%</span>
                                    @else
                                        <span class="badge bg-secondary-subtle text-secondary">→ {{ $pregunta['tendencia'] }}%</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="bg-white rounded-4 p-4 shadow-sm h-100">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="h5 mb-0">Interacciones por Usuario</h3>
                    <button class="btn btn-sm btn-outline-primary">Ver Detalles</button>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th class="border-0">Usuario</th>
                                <th class="border-0 text-end">Interacciones</th>
                                <th class="border-0 text-end">Última Actividad</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($interaccionesPorUsuario as $interaccion)
                            <tr>
                                <td class="border-0">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-circle bg-primary-subtle text-primary me-2">{{ substr($interaccion['trabajador_id'] ? 'U'.$interaccion['trabajador_id'] : 'G', 0, 1) }}</div>
                                        <span>{{ $interaccion['trabajador_id'] ? 'Usuario '.$interaccion['trabajador_id'] : 'Usuario invitado' }}</span>
                                    </div>
                                </td>
                                <td class="border-0 text-end">{{ number_format($interaccion['total']) }}</td>
                                <td class="border-0 text-end text-muted">{{ $interaccion['ultima_actividad'] }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
                                
@endsection
