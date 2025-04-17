@extends('layouts.app')
@section('title', 'Farmacovigilancia')

@section('content')
<!-- Hero Section -->
<div class="hero-section py-5 mb-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold mb-4">Farmacovigilancia</h1>
                <p class="lead mb-4">La farmacovigilancia es la ciencia y las actividades relacionadas con la detección, evaluación, comprensión y prevención de los efectos adversos de los medicamentos o cualquier otro problema relacionado con ellos.</p>
                <ul class="list-unstyled">
                    <li class="mb-3">
                        <i class="fas fa-check-circle text-primary me-2"></i>
                        Monitoreo continuo de la seguridad de los medicamentos
                    </li>
                    <li class="mb-3">
                        <i class="fas fa-check-circle text-primary me-2"></i>
                        Identificación temprana de reacciones adversas
                    </li>
                    <li class="mb-3">
                        <i class="fas fa-check-circle text-primary me-2"></i>
                        Evaluación de la relación beneficio-riesgo de los medicamentos
                    </li>
                </ul>
            </div>
            <div class="col-lg-6 text-center">
                <img src="https://placehold.co/600x400/e8f4fd/4a89dc?text=Farmacovigilancia" alt="Farmacovigilancia" class="img-fluid rounded-3 shadow-lg">
            </div>
        </div>
    </div>
</div>

<!-- ¿Qué es la Farmacovigilancia? Section -->
<section class="py-5 bg-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <img src="https://placehold.co/600x400/4a89dc/white?text=Monitoreo" alt="Monitoreo de Medicamentos" class="img-fluid rounded-3 shadow">
            </div>
            <div class="col-lg-6">
                <h2 class="mb-4">¿Qué es un evento adverso (EA)?</h2>
                <p class="text-muted mb-4">Es cualquier suceso que puede presentarse durante el uso de un producto farmacéutico. También puede referirse a una condición médica indeseada (enfermedad, síntoma, signo o resultado anormal de laboratorio), pero no tiene necesariamente una relación causal con dicho uso. </p>
                
            </div>
        </div>
    </div>
</section>

<!-- Proceso de Reporte Section -->
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-5">Proceso de Reporte</h2>
        <div class="row g-4">
            <div class="col-md-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center p-4">
                        <div class="d-inline-block p-3 bg-primary bg-opacity-10 rounded-circle mb-3">
                            <i class="fas fa-exclamation-circle fa-2x text-primary"></i>
                        </div>
                        <h4 class="h5 mb-3">Identificación</h4>
                        <p class="text-muted mb-0">Detecta una reacción adversa o problema con un medicamento</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center p-4">
                        <div class="d-inline-block p-3 bg-primary bg-opacity-10 rounded-circle mb-3">
                            <i class="fas fa-clipboard-list fa-2x text-primary"></i>
                        </div>
                        <h4 class="h5 mb-3">Documentación</h4>
                        <p class="text-muted mb-0">Completa el formulario de reporte con toda la información relevante</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center p-4">
                        <div class="d-inline-block p-3 bg-primary bg-opacity-10 rounded-circle mb-3">
                            <i class="fas fa-paper-plane fa-2x text-primary"></i>
                        </div>
                        <h4 class="h5 mb-3">Envío</h4>
                        <p class="text-muted mb-0">Envía el reporte a nuestro equipo de farmacovigilancia</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center p-4">
                        <div class="d-inline-block p-3 bg-primary bg-opacity-10 rounded-circle mb-3">
                            <i class="fas fa-chart-line fa-2x text-primary"></i>
                        </div>
                        <h4 class="h5 mb-3">Seguimiento</h4>
                        <p class="text-muted mb-0">Realizamos el análisis y seguimiento correspondiente</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection