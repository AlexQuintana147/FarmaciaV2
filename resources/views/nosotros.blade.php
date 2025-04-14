@extends('layouts.app')
@section('title', 'Sobre Nosotros')

@section('content')
<!-- Hero Section -->
<div class="hero-section py-5 mb-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold mb-4">Sobre DrodiPharma</h1>
                <p class="lead mb-4">Somos una farmacia comprometida con tu salud y bienestar, ofreciendo productos farmacéuticos de alta calidad y atención personalizada desde 2023.</p>
            </div>
            <div class="col-lg-6 text-center">
                <img src="{{ asset('images/bannerInicio.jpg') }}" alt="Equipo DrodiPharma" class="img-fluid rounded-3 shadow-lg">
            </div>
        </div>
    </div>
</div>

<!-- Misión y Visión Section -->
<section class="py-5 bg-white">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-6">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="d-inline-block p-3 bg-primary bg-opacity-10 rounded-circle mb-3">
                            <i class="fas fa-bullseye fa-2x text-primary"></i>
                        </div>
                        <h3 class="h4 mb-3">Nuestra Misión</h3>
                        <p class="text-muted mb-0">Proporcionar servicios farmacéuticos de excelencia y productos de calidad, contribuyendo al bienestar y la salud de nuestra comunidad a través de una atención profesional y personalizada.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="d-inline-block p-3 bg-primary bg-opacity-10 rounded-circle mb-3">
                            <i class="fas fa-eye fa-2x text-primary"></i>
                        </div>
                        <h3 class="h4 mb-3">Nuestra Visión</h3>
                        <p class="text-muted mb-0">Ser reconocidos como la farmacia líder en Trujillo, distinguiéndonos por nuestra excelencia en el servicio, innovación constante y compromiso con la salud de nuestros clientes.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Valores Section -->
<section class="py-5">
    <div class="container">
        <h2 class="text-center mb-5">Nuestros Valores</h2>
        <div class="row g-4">
            <div class="col-md-3">
                <div class="text-center">
                    <div class="d-inline-block p-3 bg-primary bg-opacity-10 rounded-circle mb-3">
                        <i class="fas fa-heart fa-2x text-primary"></i>
                    </div>
                    <h4 class="h5 mb-3">Compromiso</h4>
                    <p class="text-muted">Dedicados a tu bienestar y salud en cada momento.</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="text-center">
                    <div class="d-inline-block p-3 bg-primary bg-opacity-10 rounded-circle mb-3">
                        <i class="fas fa-check-double fa-2x text-primary"></i>
                    </div>
                    <h4 class="h5 mb-3">Calidad</h4>
                    <p class="text-muted">Garantizamos productos y servicios de la más alta calidad.</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="text-center">
                    <div class="d-inline-block p-3 bg-primary bg-opacity-10 rounded-circle mb-3">
                        <i class="fas fa-user-md fa-2x text-primary"></i>
                    </div>
                    <h4 class="h5 mb-3">Profesionalismo</h4>
                    <p class="text-muted">Personal altamente capacitado para atenderte.</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="text-center">
                    <div class="d-inline-block p-3 bg-primary bg-opacity-10 rounded-circle mb-3">
                        <i class="fas fa-handshake fa-2x text-primary"></i>
                    </div>
                    <h4 class="h5 mb-3">Confianza</h4>
                    <p class="text-muted">Construimos relaciones duraderas con nuestros clientes.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Equipo Section -->
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-5">Nuestro Equipo</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <div class="rounded-circle overflow-hidden mb-3 mx-auto" style="width: 150px; height: 150px;">
                            <img src="https://placehold.co/300x300/4a89dc/white?text=Q.F." alt="Químico Farmacéutico" class="img-fluid">
                        </div>
                        <h4 class="h5 mb-1">Dr. Carlos Rodríguez</h4>
                        <p class="text-muted mb-3">Químico Farmacéutico Director</p>
                        <p class="small text-muted">Especialista con más de 10 años de experiencia en el sector farmacéutico.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <div class="rounded-circle overflow-hidden mb-3 mx-auto" style="width: 150px; height: 150px;">
                            <img src="https://placehold.co/300x300/37bc9b/white?text=T.F." alt="Técnico Farmacéutico" class="img-fluid">
                        </div>
                        <h4 class="h5 mb-1">Ana Martínez</h4>
                        <p class="text-muted mb-3">Técnica Farmacéutica</p>
                        <p class="small text-muted">Dedicada a brindar la mejor atención y asesoría a nuestros clientes.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <div class="rounded-circle overflow-hidden mb-3 mx-auto" style="width: 150px; height: 150px;">
                            <img src="https://placehold.co/300x300/e8f4fd/4a89dc?text=A.C." alt="Atención al Cliente" class="img-fluid">
                        </div>
                        <h4 class="h5 mb-1">Laura Sánchez</h4>
                        <p class="text-muted mb-3">Atención al Cliente</p>
                        <p class="small text-muted">Especialista en servicio al cliente y gestión de consultas.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection