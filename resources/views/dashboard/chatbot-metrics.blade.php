@extends('layouts.app')

<<<<<<< HEAD
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
=======
@push('styles')
<style>
    .metrics-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        border-radius: 15px;
        color: white;
        transition: all 0.3s ease;
    }
    
    .metrics-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    }
    
    .metrics-card.success {
        background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
    }
    
    .metrics-card.info {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
    
    .metrics-card.warning {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    }
    
    .metrics-card.primary {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    }
    
    .data-table {
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    
    .data-table thead {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }
    
    .data-table tbody tr {
        transition: all 0.2s ease;
    }
    
    .data-table tbody tr:hover {
        background-color: #f8f9fa;
        transform: scale(1.01);
    }
    
    .section-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 10px 10px 0 0;
        padding: 1rem 1.5rem;
        margin: 0;
    }
    
    .empty-state {
        padding: 3rem;
        text-align: center;
        color: #6c757d;
    }
    
    .badge-status {
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
    }
    
    .response-preview {
        max-width: 300px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    
    .question-preview {
        max-width: 250px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
</style>
@endpush

@section('content')
<div class="container-fluid py-4">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h2 mb-1"><i class="fas fa-robot me-2 text-primary"></i>Panel de Métricas del Chatbot</h1>
            <p class="text-muted mb-0">Análisis completo de interacciones y rendimiento</p>
        </div>
        <a href="{{ route('dashboard') }}" class="btn btn-outline-primary btn-lg">
            <i class="fas fa-arrow-left me-2"></i> Dashboard Principal
        </a>
    </div>

    <!-- Tarjetas de métricas principales -->
    <div class="row mb-5">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card metrics-card primary h-100">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <i class="fas fa-comments fa-3x opacity-75"></i>
                    </div>
                    <h2 class="display-4 fw-bold mb-2">{{ number_format($totalInteracciones) }}</h2>
                    <p class="mb-0 fs-6 opacity-90">Total de Interacciones</p>
                    <small class="opacity-75">Desde el inicio</small>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card metrics-card success h-100">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <i class="fas fa-calendar-day fa-3x opacity-75"></i>
                    </div>
                    <h2 class="display-4 fw-bold mb-2">{{ number_format($interaccionesHoy) }}</h2>
                    <p class="mb-0 fs-6 opacity-90">Interacciones Hoy</p>
                    <small class="opacity-75">{{ date('d/m/Y') }}</small>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card metrics-card info h-100">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <i class="fas fa-question-circle fa-3x opacity-75"></i>
                    </div>
                    <h2 class="display-4 fw-bold mb-2">{{ number_format($preguntasFrecuentes->count()) }}</h2>
                    <p class="mb-0 fs-6 opacity-90">Preguntas Únicas</p>
                    <small class="opacity-75">Top 10 registradas</small>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card metrics-card warning h-100">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <i class="fas fa-users fa-3x opacity-75"></i>
                    </div>
                    <h2 class="display-4 fw-bold mb-2">{{ number_format($interaccionesPorUsuario->count()) }}</h2>
                    <p class="mb-0 fs-6 opacity-90">Usuarios Activos</p>
                    <small class="opacity-75">Con interacciones</small>
>>>>>>> beaee175c42948c5e92337255d4f9d1a0fb32824
                </div>
            </div>
        </div>
    </div>

<<<<<<< HEAD
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
=======
    <!-- Preguntas más frecuentes -->
    <div class="card border-0 shadow-lg mb-5">
        <div class="section-header">
            <h4 class="mb-0"><i class="fas fa-question-circle me-2"></i>Top 10 Preguntas Más Frecuentes</h4>
        </div>
        <div class="card-body p-0">
            @if($preguntasFrecuentes->isNotEmpty())
                <div class="table-responsive">
                    <table class="table data-table mb-0">
                        <thead>
                            <tr>
                                <th class="ps-4">#</th>
                                <th>Pregunta</th>
                                <th class="text-center">Frecuencia</th>
                                <th class="text-center">Porcentaje</th>
                                <th class="text-center pe-4">Popularidad</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($preguntasFrecuentes as $index => $pregunta)
                                <tr>
                                    <td class="ps-4 fw-bold text-primary">{{ $index + 1 }}</td>
                                    <td>
                                        <div class="question-preview" title="{{ $pregunta->pregunta }}">
                                            <i class="fas fa-comment-dots me-2 text-muted"></i>
                                            {{ $pregunta->pregunta }}
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-primary fs-6">{{ number_format($pregunta->total) }}</span>
                                    </td>
                                    <td class="text-center">
                                        <span class="text-muted">{{ number_format(($pregunta->total / $totalInteracciones) * 100, 1) }}%</span>
                                    </td>
                                    <td class="text-center pe-4">
                                        <div class="progress" style="height: 8px; width: 80px; margin: 0 auto;">
                                            <div class="progress-bar bg-gradient" 
                                                 style="width: {{ ($pregunta->total / $preguntasFrecuentes->first()->total) * 100 }}%;
                                                        background: linear-gradient(90deg, #667eea, #764ba2);"></div>
                                        </div>
                                    </td>
                                </tr>
>>>>>>> beaee175c42948c5e92337255d4f9d1a0fb32824
                            @endforeach
                        </tbody>
                    </table>
                </div>
<<<<<<< HEAD
            </div>
=======
            @else
                <div class="empty-state">
                    <i class="fas fa-inbox fa-4x text-muted mb-3"></i>
                    <h5 class="text-muted">No hay datos de interacciones</h5>
                    <p class="text-muted mb-0">Las preguntas aparecerán aquí cuando los usuarios interactúen con el chatbot.</p>
                </div>
            @endif
>>>>>>> beaee175c42948c5e92337255d4f9d1a0fb32824
        </div>

<<<<<<< HEAD
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
=======
    <!-- Interacciones por usuario -->
    <div class="card border-0 shadow-lg mb-5">
        <div class="section-header">
            <h4 class="mb-0"><i class="fas fa-users me-2"></i>Ranking de Usuarios Más Activos</h4>
        </div>
        <div class="card-body p-0">
            @if($interaccionesPorUsuario->isNotEmpty())
                <div class="table-responsive">
                    <table class="table data-table mb-0">
                        <thead>
                            <tr>
                                <th class="ps-4">Posición</th>
                                <th>Usuario</th>
                                <th class="text-center">Interacciones</th>
                                <th class="text-center">Participación</th>
                                <th class="text-center pe-4">Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($interaccionesPorUsuario as $index => $interaccion)
                                <tr>
                                    <td class="ps-4">
                                        @if($index == 0)
                                            <i class="fas fa-crown text-warning me-2"></i>
                                        @elseif($index == 1)
                                            <i class="fas fa-medal text-secondary me-2"></i>
                                        @elseif($index == 2)
                                            <i class="fas fa-award text-warning me-2"></i>
                                        @else
                                            <span class="text-muted me-2">#{{ $index + 1 }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-circle me-3" style="width: 40px; height: 40px; background: linear-gradient(135deg, #667eea, #764ba2); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold;">
                                                @if($interaccion->trabajador)
                                                    {{ strtoupper(substr($interaccion->trabajador->nombre ?? 'U', 0, 1)) }}
                                                @else
                                                    <i class="fas fa-user-secret"></i>
                                                @endif
                                            </div>
                                            <div>
                                                <div class="fw-semibold">
                                                    @if($interaccion->trabajador)
                                                        {{ $interaccion->trabajador->nombre ?? 'Usuario #' . $interaccion->trabajador_id }}
                                                    @else
                                                        Usuario Invitado
                                                    @endif
                                                </div>
                                                <small class="text-muted">
                                                    @if($interaccion->trabajador)
                                                        ID: {{ $interaccion->trabajador_id }}
                                                    @else
                                                        Sin registro
                                                    @endif
                                                </small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-primary fs-6">{{ number_format($interaccion->total) }}</span>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex flex-column align-items-center">
                                            <span class="text-muted small">{{ number_format(($interaccion->total / $totalInteracciones) * 100, 1) }}%</span>
                                            <div class="progress mt-1" style="height: 6px; width: 60px;">
                                                <div class="progress-bar" 
                                                     style="width: {{ ($interaccion->total / $interaccionesPorUsuario->first()->total) * 100 }}%;
                                                            background: linear-gradient(90deg, #11998e, #38ef7d);"></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center pe-4">
                                        @if($interaccion->total >= 10)
                                            <span class="badge badge-status bg-success text-white">Muy Activo</span>
                                        @elseif($interaccion->total >= 5)
                                            <span class="badge badge-status bg-warning text-dark">Activo</span>
                                        @else
                                            <span class="badge badge-status bg-secondary text-white">Ocasional</span>
                                        @endif
                                    </td>
                                </tr>
>>>>>>> beaee175c42948c5e92337255d4f9d1a0fb32824
                            @endforeach
                        </tbody>
                    </table>
                </div>
<<<<<<< HEAD
            </div>
=======
            @else
                <div class="empty-state">
                    <i class="fas fa-users-slash fa-4x text-muted mb-3"></i>
                    <h5 class="text-muted">No hay interacciones de usuarios</h5>
                    <p class="text-muted mb-0">Los datos de usuarios aparecerán aquí cuando interactúen con el chatbot.</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Historial completo de interacciones -->
    <div class="card border-0 shadow-lg">
        <div class="section-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0"><i class="fas fa-history me-2"></i>Historial Completo de Interacciones</h4>
            <small class="opacity-75">Últimas 50 interacciones</small>
        </div>
        <div class="card-body p-0">
            @php
                $historialCompleto = App\Models\ChatbotLog::with('trabajador')
                    ->orderBy('created_at', 'desc')
                    ->limit(50)
                    ->get();
            @endphp
            
            @if($historialCompleto->isNotEmpty())
                <div class="table-responsive">
                    <table class="table data-table mb-0">
                        <thead>
                            <tr>
                                <th class="ps-4">ID</th>
                                <th>Usuario</th>
                                <th>Pregunta</th>
                                <th>Respuesta</th>
                                <th class="text-center">Fecha</th>
                                <th class="text-center pe-4">Hora</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($historialCompleto as $log)
                                <tr>
                                    <td class="ps-4">
                                        <span class="badge bg-light text-dark">#{{ $log->id }}</span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-circle me-2" style="width: 30px; height: 30px; background: linear-gradient(135deg, #f093fb, #f5576c); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; font-size: 0.8rem;">
                                                @if($log->trabajador)
                                                    {{ strtoupper(substr($log->trabajador->nombre ?? 'U', 0, 1)) }}
                                                @else
                                                    <i class="fas fa-user-secret" style="font-size: 0.7rem;"></i>
                                                @endif
                                            </div>
                                            <div>
                                                <div class="fw-semibold small">
                                                    @if($log->trabajador)
                                                        {{ $log->trabajador->nombre ?? 'Usuario #' . $log->trabajador_id }}
                                                    @else
                                                        <span class="text-muted">Invitado</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="question-preview" title="{{ $log->pregunta }}">
                                            <i class="fas fa-comment text-primary me-1"></i>
                                            {{ $log->pregunta }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="response-preview" title="{{ $log->respuesta }}">
                                            <i class="fas fa-reply text-success me-1"></i>
                                            {{ $log->respuesta }}
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-light text-dark">{{ $log->created_at->format('d/m/Y') }}</span>
                                    </td>
                                    <td class="text-center pe-4">
                                        <span class="text-muted small">{{ $log->created_at->format('H:i:s') }}</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="empty-state">
                    <i class="fas fa-history fa-4x text-muted mb-3"></i>
                    <h5 class="text-muted">No hay historial disponible</h5>
                    <p class="text-muted mb-0">El historial de interacciones aparecerá aquí cuando se registren conversaciones.</p>
                </div>
            @endif
>>>>>>> beaee175c42948c5e92337255d4f9d1a0fb32824
        </div>
    </div>
</div>
                                
@endsection
