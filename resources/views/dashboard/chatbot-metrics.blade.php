@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="fas fa-robot me-2"></i>Métricas del Chatbot</h2>
        <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-1"></i> Volver al Dashboard
        </a>
    </div>

    <!-- Tarjetas de resumen -->
    <div class="row mb-4">
        <div class="col-md-6 col-lg-4 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <h3 class="text-primary">{{ $totalInteracciones }}</h3>
                    <p class="mb-0 text-muted">Total de interacciones</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <h3 class="text-success">{{ $interaccionesHoy }}</h3>
                    <p class="mb-0 text-muted">Interacciones hoy</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <h3 class="text-info">{{ $preguntasFrecuentes->count() }}</h3>
                    <p class="mb-0 text-muted">Preguntas únicas registradas</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Preguntas más frecuentes -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-white">
            <h5 class="mb-0"><i class="fas fa-question-circle me-2"></i>Preguntas más frecuentes</h5>
        </div>
        <div class="card-body">
            @if($preguntasFrecuentes->isNotEmpty())
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Pregunta</th>
                                <th class="text-end">Veces realizada</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($preguntasFrecuentes as $pregunta)
                                <tr>
                                    <td>{{ $pregunta->pregunta }}</td>
                                    <td class="text-end">{{ $pregunta->total }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-4">
                    <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                    <p class="text-muted mb-0">No hay datos de interacciones aún.</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Interacciones por usuario -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white">
            <h5 class="mb-0"><i class="fas fa-users me-2"></i>Interacciones por usuario</h5>
        </div>
        <div class="card-body">
            @if($interaccionesPorUsuario->isNotEmpty())
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Usuario</th>
                                <th class="text-end">Interacciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($interaccionesPorUsuario as $interaccion)
                                <tr>
                                    <td>
                                        @if($interaccion->trabajador)
                                            {{ $interaccion->trabajador->nombre ?? 'Usuario #' . $interaccion->trabajador_id }}
                                        @else
                                            Usuario invitado
                                        @endif
                                    </td>
                                    <td class="text-end">{{ $interaccion->total }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-4">
                    <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                    <p class="text-muted mb-0">No hay datos de interacciones por usuario.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
