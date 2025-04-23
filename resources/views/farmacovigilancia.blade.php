@extends('layouts.app')
@section('title', 'Farmacovigilancia')

@section('content')
<!-- Hero Section Mejorado -->
<div class="hero-section py-5 mb-5 position-relative" style="background: linear-gradient(120deg, #e8f4fd 0%, #f0f9ff 100%); overflow:hidden;">
    <!-- Iconos médicos decorativos -->
    <i class="fas fa-capsules position-absolute" style="left: 2%; top: 10%; font-size: 2.5rem; color: #cbeafe; opacity: 0.5;"></i>
    <i class="fas fa-heartbeat position-absolute" style="right: 5%; top: 30%; font-size: 2.7rem; color: #b6e0fe; opacity: 0.5;"></i>
    <i class="fas fa-prescription-bottle-alt position-absolute" style="left: 10%; bottom: 10%; font-size: 2.2rem; color: #d1eaff; opacity: 0.5;"></i>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <h1 class="display-4 fw-bold mb-3 text-primary">Farmacovigilancia</h1>
                <p class="lead mb-4">La farmacovigilancia es la ciencia y las actividades relacionadas con la detección, evaluación, comprensión y prevención de los efectos adversos de los medicamentos o cualquier otro problema relacionado con ellos.</p>
                <ul class="list-unstyled mb-4">
                    <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> Monitoreo continuo de la seguridad de los medicamentos</li>
                    <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> Identificación temprana de reacciones adversas</li>
                    <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> Evaluación de la relación beneficio-riesgo de los medicamentos</li>
                </ul>
                <a href="https://api.whatsapp.com/send/?phone=51967692437&text=Quiero+reportar+un+evento+adverso" target="_blank" class="btn btn-lg btn-primary shadow-sm px-4 py-2"><i class="fas fa-flag me-2"></i>Reportar Evento Adverso</a>
            </div>
            <div class="col-lg-6 text-center">
                <img src="https://placehold.co/600x400/e8f4fd/4a89dc?text=Farmacovigilancia" alt="Farmacovigilancia" class="img-fluid rounded-3 shadow-lg">
            </div>
        </div>
    </div>
</div>

<!-- ¿Qué es la Farmacovigilancia? Mejorado -->
<section class="py-5 bg-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <div class="bg-primary bg-opacity-10 rounded-4 p-4 shadow-sm h-100 d-flex align-items-center justify-content-center">
                    <img src="https://placehold.co/350x250/4a89dc/white?text=Monitoreo" alt="Monitoreo de Medicamentos" class="img-fluid rounded-3">
                </div>
            </div>
            <div class="col-lg-6">
                <h2 class="mb-3 text-primary"><i class="fas fa-exclamation-triangle me-2"></i>¿Qué es un evento adverso (EA)?</h2>
                <p class="text-muted mb-4">Es cualquier suceso que puede presentarse durante el uso de un producto farmacéutico. También puede referirse a una condición médica indeseada (enfermedad, síntoma, signo o resultado anormal de laboratorio), pero no tiene necesariamente una relación causal con dicho uso.</p>
                <div class="alert alert-warning bg-warning bg-opacity-25 border-0 rounded-3">
                    <i class="fas fa-info-circle me-2"></i>Si experimenta un evento adverso, repórtelo de inmediato para proteger su salud y la de otros pacientes.
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Proceso de Reporte Mejorado -->
<section class="py-5 bg-light position-relative">
    <div class="container">
        <h2 class="text-center mb-5 text-primary">¿Cómo reportar un evento adverso?</h2>
        <div class="row g-4 justify-content-center">
            <div class="col-md-3">
                <div class="card border-0 shadow-sm h-100 text-center">
                    <div class="card-body p-4">
                        <div class="d-inline-block p-3 bg-primary bg-opacity-10 rounded-circle mb-3">
                            <span class="badge bg-primary bg-opacity-75 rounded-circle mb-2" style="font-size:1.1rem;">1</span>
                            <i class="fas fa-search fa-2x text-primary ms-2"></i>
                        </div>
                        <h5 class="fw-bold mb-2">Detecta el evento</h5>
                        <p class="text-muted small">Identifica cualquier síntoma, reacción o situación inesperada tras el uso de un medicamento.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm h-100 text-center">
                    <div class="card-body p-4">
                        <div class="d-inline-block p-3 bg-primary bg-opacity-10 rounded-circle mb-3">
                            <span class="badge bg-primary bg-opacity-75 rounded-circle mb-2" style="font-size:1.1rem;">2</span>
                            <i class="fas fa-edit fa-2x text-primary ms-2"></i>
                        </div>
                        <h5 class="fw-bold mb-2">Registra la información</h5>
                        <p class="text-muted small">Anota los detalles: medicamento, síntomas, fecha y datos relevantes.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm h-100 text-center">
                    <div class="card-body p-4">
                        <div class="d-inline-block p-3 bg-primary bg-opacity-10 rounded-circle mb-3">
                            <span class="badge bg-primary bg-opacity-75 rounded-circle mb-2" style="font-size:1.1rem;">3</span>
                            <i class="fas fa-paper-plane fa-2x text-primary ms-2"></i>
                        </div>
                        <h5 class="fw-bold mb-2">Reporta el evento</h5>
                        <p class="text-muted small">Comunícate con nuestro equipo usando el botón de reporte o por WhatsApp.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center mt-5">
            <a href="https://api.whatsapp.com/send/?phone=51967692437&text=Quiero+reportar+un+evento+adverso" target="_blank" class="btn btn-success btn-lg px-4 py-2 shadow"><i class="fab fa-whatsapp me-2"></i>Reportar por WhatsApp</a>
        </div>
    </div>
    <!-- Fondo decorativo -->
    <i class="fas fa-shield-virus position-absolute" style="right: 2%; bottom: 10%; font-size: 3rem; color: #b6e0fe; opacity: 0.4;"></i>
</section>

@endsection