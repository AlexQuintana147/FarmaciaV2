@extends('layouts.app')

@section('title', 'Inicio')

@section('content')
<!-- Hero Section con fondo moderno y elementos flotantes -->
<div class="hero-section position-relative py-5 mb-5 overflow-hidden" style="background: linear-gradient(135deg, #e3f0ff 0%, #f8fbff 100%); min-height: 420px;">
    <div class="medical-icons-overlay">
        <div class="floating-icon" style="top: 10%; left: 8%; font-size: 3rem;"><i class="fas fa-capsules"></i></div>
        <div class="floating-icon" style="top: 20%; right: 12%; font-size: 2.5rem;"><i class="fas fa-heartbeat"></i></div>
        <div class="floating-icon" style="bottom: 15%; left: 15%; font-size: 2.8rem;"><i class="fas fa-stethoscope"></i></div>
        <div class="floating-icon" style="bottom: 18%; right: 10%; font-size: 2.7rem;"><i class="fas fa-notes-medical"></i></div>
    </div>
    <div class="container position-relative" style="z-index:2;">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0" data-aos="fade-right">
                <div class="hero-content bg-white p-4 rounded-4 shadow-sm">
                    <h1 class="display-4 fw-bold text-primary mb-3">Bienvenido a <span class="text-gradient">DrodiPharma</span></h1>
                    <div class="divider mb-3" style="width: 70px; height: 3px; background: linear-gradient(90deg, #4a89dc, #5ca9fb);"></div>
                    <p class="lead mb-4">Tu aliado confiable en distribución farmacéutica. Encuentra productos de calidad, atención personalizada y soluciones innovadoras para tu farmacia o botica.</p>
                    
                </div>
            </div>
            <div class="col-lg-6 text-center" data-aos="fade-left">
                <img src="{{ asset('images/bannerInicio.jpg') }}" alt="DrodiPharma" class="img-fluid rounded-4 shadow-lg" style="max-width: 85%;">
            </div>
        </div>
    </div>
    <div class="wave-pattern">
        <svg class="wave-svg" viewBox="0 0 1440 200" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill="#e3f0ff" fill-opacity="1" d="M0,160L60,154.7C120,149,240,139,360,144C480,149,600,171,720,181.3C840,192,960,192,1080,186.7C1200,181,1320,171,1380,165.3L1440,160L1440,200L1380,200C1320,200,1200,200,1080,200C960,200,840,200,720,200C600,200,480,200,360,200C240,200,120,200,60,200L0,200Z"></path></svg>
    </div>
</div>

<!-- Sección de Ofertas Destacadas -->
<section class="offers-container py-5">
    <div class="container">
        <h2 class="text-center mb-5 text-primary" data-aos="fade-up">Ofertas Destacadas</h2>
        <div class="row g-4 justify-content-center">
            <div class="col-md-4 col-lg-3" data-aos="fade-up">
                <div class="offer-card card h-100">
                    <img src="https://placehold.co/400x200/4a89dc/fff?text=Descuento+20%25" class="card-img-top" alt="Oferta 1">
                    <div class="card-body text-center">
                        <h5 class="card-title text-primary">Descuento en Analgésicos</h5>
                        <p class="card-text">Aprovecha un 20% de descuento en analgésicos seleccionados durante este mes.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-lg-3" data-aos="fade-up" data-aos-delay="100">
                <div class="offer-card card h-100">
                    <img src="https://placehold.co/400x200/5ca9fb/fff?text=Envío+Gratis" class="card-img-top" alt="Oferta 2">
                    <div class="card-body text-center">
                        <h5 class="card-title text-primary">Envío Gratis</h5>
                        <p class="card-text">Envío gratuito en compras superiores a S/ 200 para Lima y provincias seleccionadas.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-lg-3" data-aos="fade-up" data-aos-delay="200">
                <div class="offer-card card h-100">
                    <img src="https://placehold.co/400x200/4a89dc/fff?text=Nuevo+Ingreso" class="card-img-top" alt="Oferta 3">
                    <div class="card-body text-center">
                        <h5 class="card-title text-primary">Nuevos Productos</h5>
                        <p class="card-text">Descubre los últimos lanzamientos en medicamentos y productos de cuidado personal.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Sección de Servicios -->
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-5 text-primary" data-aos="fade-up">Nuestros Servicios</h2>
        <div class="row g-4 justify-content-center">
            <div class="col-md-4 col-lg-3" data-aos="fade-up">
                <div class="hover-card bg-white shadow-sm p-4 text-center h-100">
                    <div class="icon-wrapper mb-3"><i class="fas fa-truck fa-2x text-primary"></i></div>
                    <h5 class="mb-2 text-primary">Distribución Rápida</h5>
                    <p class="text-muted mb-0">Entrega eficiente y segura a nivel nacional.</p>
                </div>
            </div>
            <div class="col-md-4 col-lg-3" data-aos="fade-up" data-aos-delay="100">
                <div class="hover-card bg-white shadow-sm p-4 text-center h-100">
                    <div class="icon-wrapper mb-3"><i class="fas fa-user-md fa-2x text-primary"></i></div>
                    <h5 class="mb-2 text-primary">Asesoría Profesional</h5>
                    <p class="text-muted mb-0">Soporte y orientación para farmacias y boticas.</p>
                </div>
            </div>
            <div class="col-md-4 col-lg-3" data-aos="fade-up" data-aos-delay="200">
                <div class="hover-card bg-white shadow-sm p-4 text-center h-100">
                    <div class="icon-wrapper mb-3"><i class="fas fa-capsules fa-2x text-primary"></i></div>
                    <h5 class="mb-2 text-primary">Variedad de Productos</h5>
                    <p class="text-muted mb-0">Amplio catálogo de medicamentos y productos de salud.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Sección de Consulta Rápida -->
<section class="consultation-section py-5 position-relative">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7 mb-4 mb-lg-0" data-aos="fade-right">
                <h2 class="fw-bold text-primary mb-3">¿Tienes dudas o necesitas asesoría?</h2>
                <p class="lead mb-4">Nuestro equipo está listo para ayudarte. Realiza tu consulta rápida y recibe atención personalizada.</p>
                <a href="https://wa.me/51999999999" target="_blank" class="btn btn-whatsapp btn-lg"><i class="fab fa-whatsapp me-2"></i>Consultar por WhatsApp</a>
            </div>
            <div class="col-lg-5 text-center" data-aos="fade-left">
                <img src="https://placehold.co/350x250/25D366/fff?text=Consulta+Rápida" alt="Consulta Rápida" class="img-fluid rounded-4 shadow">
            </div>
        </div>
    </div>
</section>

<!-- Sección de Blog Destacado -->
<section class="blog-section py-5">
    <div class="container">
        <h2 class="text-center mb-5 text-primary" data-aos="fade-up">Últimos Artículos del Blog</h2>
        <div class="row g-4 justify-content-center">
            <div class="col-md-4" data-aos="fade-up">
                <div class="card h-100 shadow-sm">
                    <img src="https://placehold.co/400x200/e8f4fd/4a89dc?text=Blog+1" class="card-img-top" alt="Blog 1">
                    <div class="card-body">
                        <h5 class="card-title text-primary">Consejos para el Cuidado de la Salud</h5>
                        <p class="card-text">Descubre recomendaciones de nuestros expertos para mantener tu bienestar y el de tu familia.</p>
                        
                    </div>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="card h-100 shadow-sm">
                    <img src="https://placehold.co/400x200/4a89dc/fff?text=Blog+2" class="card-img-top" alt="Blog 2">
                    <div class="card-body">
                        <h5 class="card-title text-primary">Novedades en Medicamentos</h5>
                        <p class="card-text">Mantente informado sobre los últimos lanzamientos y avances en el sector farmacéutico.</p>
                        
                    </div>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="card h-100 shadow-sm">
                    <img src="https://placehold.co/400x200/5ca9fb/fff?text=Blog+3" class="card-img-top" alt="Blog 3">
                    <div class="card-body">
                        <h5 class="card-title text-primary">Farmacovigilancia y Seguridad</h5>
                        <p class="card-text">Conoce la importancia de la farmacovigilancia y cómo reportar eventos adversos.</p>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Sección de Colaboradores -->
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-5 text-primary" data-aos="fade-up">Nuestro Equipo</h2>
        <div class="row g-4 justify-content-center">
            <div class="col-md-3 col-6" data-aos="fade-up">
                <div class="text-center">
                    <img src="{{ asset('imagesColaboradores/1.png') }}" alt="Colaborador 1" class="img-fluid rounded-circle shadow mb-3" style="width: 120px; height: 120px; object-fit: cover;">
                    <h6 class="mb-0 text-primary">Dra. Ana Torres</h6>
                    <small class="text-muted">Gerente General</small>
                </div>
            </div>
            <div class="col-md-3 col-6" data-aos="fade-up" data-aos-delay="100">
                <div class="text-center">
                    <img src="{{ asset('imagesColaboradores/2.png') }}" alt="Colaborador 2" class="img-fluid rounded-circle shadow mb-3" style="width: 120px; height: 120px; object-fit: cover;">
                    <h6 class="mb-0 text-primary">Dr. Luis Pérez</h6>
                    <small class="text-muted">Director Técnico</small>
                </div>
            </div>
            <div class="col-md-3 col-6" data-aos="fade-up" data-aos-delay="200">
                <div class="text-center">
                    <img src="{{ asset('imagesColaboradores/3.png') }}" alt="Colaborador 3" class="img-fluid rounded-circle shadow mb-3" style="width: 120px; height: 120px; object-fit: cover;">
                    <h6 class="mb-0 text-primary">Lic. Carla Ruiz</h6>
                    <small class="text-muted">Jefa de Ventas</small>
                </div>
            </div>
            <div class="col-md-3 col-6" data-aos="fade-up" data-aos-delay="300">
                <div class="text-center">
                    <img src="{{ asset('imagesColaboradores/4.png') }}" alt="Colaborador 4" class="img-fluid rounded-circle shadow mb-3" style="width: 120px; height: 120px; object-fit: cover;">
                    <h6 class="mb-0 text-primary">Tec. Mario Díaz</h6>
                    <small class="text-muted">Logística</small>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Estilos personalizados para la nueva interfaz -->
<style>
.text-gradient {
    background: linear-gradient(90deg, #4a89dc, #5ca9fb);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    text-fill-color: transparent;
}
</style>

<div class="offers-container position-relative overflow-hidden">
    <!-- Elementos decorativos flotantes -->
    <div class="floating-elements">
        <i class="fas fa-capsules floating-icon" style="top: 10%; left: 5%;"></i>
        <i class="fas fa-pills floating-icon" style="top: 30%; right: 8%;"></i>
        <i class="fas fa-prescription-bottle-alt floating-icon" style="bottom: 15%; left: 10%;"></i>
    </div>

    <div class="container py-5">
        <div class="text-center mb-5">
            <span class="badge bg-primary text-white px-3 py-2 rounded-pill mb-3">Ofertas Especiales</span>
            <h2 class="fw-bold text-primary mb-3">Últimas Ofertas del Mes</h2>
            <div class="divider mx-auto mb-4" style="width: 70px; height: 3px; background-color: #0d6efd;"></div>
            <p class="lead mb-4 text-muted">¡Descubre nuestras increíbles ofertas y promociones especiales!</p>
        </div>

        <div id="offersCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#offersCarousel" data-bs-slide-to="0" class="active"></button>
                <button type="button" data-bs-target="#offersCarousel" data-bs-slide-to="1"></button>
            </div>

            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="row g-4">
                        <div class="col-md-4">
                            <div class="card h-100 offer-card">
                                <div class="position-relative">
                                    <img src="{{ asset('images/NoImage.png') }}" class="card-img-top" alt="Oferta 1">
                                    <span class="position-absolute top-0 start-0 badge bg-danger m-3">-25%</span>
                                </div>
                                <div class="card-body text-center">
                                    <h5 class="card-title">Producto en Oferta 1</h5>
                                    <p class="text-muted mb-2"><s>S/. 100.00</s></p>
                                    <p class="text-primary fw-bold fs-4 mb-3">S/. 75.00</p>
                                    <a href="#" class="btn btn-outline-primary">Ver Detalles</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card h-100 offer-card">
                                <div class="position-relative">
                                    <img src="{{ asset('images/NoImage.png') }}" class="card-img-top" alt="Oferta 2">
                                    <span class="position-absolute top-0 start-0 badge bg-danger m-3">-30%</span>
                                </div>
                                <div class="card-body text-center">
                                    <h5 class="card-title">Producto en Oferta 2</h5>
                                    <p class="text-muted mb-2"><s>S/. 80.00</s></p>
                                    <p class="text-primary fw-bold fs-4 mb-3">S/. 56.00</p>
                                    <a href="#" class="btn btn-outline-primary">Ver Detalles</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card h-100 offer-card">
                                <div class="position-relative">
                                    <img src="{{ asset('images/NoImage.png') }}" class="card-img-top" alt="Oferta 3">
                                    <span class="position-absolute top-0 start-0 badge bg-danger m-3">-20%</span>
                                </div>
                                <div class="card-body text-center">
                                    <h5 class="card-title">Producto en Oferta 3</h5>
                                    <p class="text-muted mb-2"><s>S/. 120.00</s></p>
                                    <p class="text-primary fw-bold fs-4 mb-3">S/. 96.00</p>
                                    <a href="#" class="btn btn-outline-primary">Ver Detalles</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="row g-4">
                        <div class="col-md-4">
                            <div class="card h-100 offer-card">
                                <div class="position-relative">
                                    <img src="{{ asset('images/NoImage.png') }}" class="card-img-top" alt="Oferta 4">
                                    <span class="position-absolute top-0 start-0 badge bg-danger m-3">-15%</span>
                                </div>
                                <div class="card-body text-center">
                                    <h5 class="card-title">Producto en Oferta 4</h5>
                                    <p class="text-muted mb-2"><s>S/. 90.00</s></p>
                                    <p class="text-primary fw-bold fs-4 mb-3">S/. 76.50</p>
                                    <a href="#" class="btn btn-outline-primary">Ver Detalles</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card h-100 offer-card">
                                <div class="position-relative">
                                    <img src="{{ asset('images/NoImage.png') }}" class="card-img-top" alt="Oferta 5">
                                    <span class="position-absolute top-0 start-0 badge bg-danger m-3">-40%</span>
                                </div>
                                <div class="card-body text-center">
                                    <h5 class="card-title">Producto en Oferta 5</h5>
                                    <p class="text-muted mb-2"><s>S/. 150.00</s></p>
                                    <p class="text-primary fw-bold fs-4 mb-3">S/. 90.00</p>
                                    <a href="#" class="btn btn-outline-primary">Ver Detalles</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card h-100 offer-card">
                                <div class="position-relative">
                                    <img src="{{ asset('images/NoImage.png') }}" class="card-img-top" alt="Oferta 6">
                                    <span class="position-absolute top-0 start-0 badge bg-danger m-3">-35%</span>
                                </div>
                                <div class="card-body text-center">
                                    <h5 class="card-title">Producto en Oferta 6</h5>
                                    <p class="text-muted mb-2"><s>S/. 200.00</s></p>
                                    <p class="text-primary fw-bold fs-4 mb-3">S/. 130.00</p>
                                    <a href="#" class="btn btn-outline-primary">Ver Detalles</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#offersCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Anterior</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#offersCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Siguiente</span>
            </button>
        </div>
    </div>
</div>

<!-- Sección de Colaboradores -->
<div class="colaboradores-section py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <span class="badge bg-primary text-white px-3 py-2 rounded-pill mb-3">Nuestro Equipo</span>
            <h2 class="fw-bold text-primary mb-3">Colaboradores</h2>
            <div class="divider mx-auto mb-4" style="width: 70px; height: 3px; background-color: #0d6efd;"></div>
        </div>
        
        <div class="colaboradores-carousel">
            <div class="colaboradores-track">
                @for($i = 1; $i <= 16; $i++)
                    <div class="colaborador-item">
                        <img src="{{ asset('imagesColaboradores/' . $i . '.png') }}" alt="Colaborador {{ $i }}" class="colaborador-img">
                    </div>
                @endfor
                @for($i = 1; $i <= 16; $i++)
                    <div class="colaborador-item">
                        <img src="{{ asset('imagesColaboradores/' . $i . '.png') }}" alt="Colaborador {{ $i }}" class="colaborador-img">
                    </div>
                @endfor
            </div>
        </div>
    </div>
</div>

<style>
    .colaboradores-section {
        overflow: hidden;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    }

    .colaboradores-carousel {
        position: relative;
        overflow: hidden;
        padding: 20px 0;
    }

    .colaboradores-track {
        display: flex;
        animation: scroll 40s linear infinite;
        width: calc(200px * 32); /* 16 imágenes * 2 para el loop */
    }

    .colaborador-item {
        flex: 0 0 200px;
        padding: 0 15px;
        perspective: 1000px;
    }

    .colaborador-img {
        width: 100%;
        height: auto;
        border-radius: 10px;
        transition: transform 0.6s;
        transform-style: preserve-3d;
        animation: rotate 5s linear infinite;
    }

    @keyframes scroll {
        0% {
            transform: translateX(0);
        }
        100% {
            transform: translateX(calc(-200px * 16)); /* Ancho de una serie completa */
        }
    }   

</style>


<div class="blog-section py-5">
    <div class="container py-4">
        <div class="row align-items-center">
            <div class="col-md-6 mb-4 mb-md-0">
                <span class="badge bg-primary text-white px-3 py-2 rounded-pill mb-3">Actualidad</span>
                <h2 class="fw-bold text-primary mb-3">Últimas Novedades</h2>
                <div class="divider mb-4" style="width: 70px; height: 3px; background-color: #0d6efd;"></div>
                <p class="lead mb-4">Mantente informado sobre nuestros nuevos productos y artículos de salud en nuestro blog. Consejos de expertos para cuidar tu bienestar.</p>
                <a href="{{ url('/blog') }}" class="btn btn-primary btn-lg shadow-sm"><i class="fas fa-book-medical me-2"></i>Visitar Blog</a>
            </div>
            <div class="col-md-6 text-center">
                <img src="https://placehold.co/600x300/6c757d/white?text=Blog+DrodiPharma" class="img-fluid rounded blog-img" alt="Blog DrodiPharma">
            </div>
        </div>
    </div>
</div>

<div class="indecopi-section py-5 position-relative overflow-hidden" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
    <!-- SVG de fondo decorativo -->
    <svg class="position-absolute" style="top: 0; left: 0; width: 100%; height: 100%; z-index: 0; opacity: 0.1;" viewBox="0 0 100 100" preserveAspectRatio="none">
        <path fill="#0d6efd" d="M0,0 L100,0 L100,100 L0,100 Z" />
        <circle cx="20" cy="20" r="5" fill="#0d6efd" class="animate-float" />
        <path d="M50,30 L60,40 L40,40 Z" fill="#0d6efd" class="animate-float" />
        <rect x="70" y="60" width="10" height="10" fill="#0d6efd" class="animate-float" />
        <path d="M80,20 C85,15 90,20 85,25 C80,30 75,25 80,20 Z" fill="#0d6efd" class="animate-float" />
    </svg>
    
    <div class="container py-4 position-relative" style="z-index: 1;">
        <div class="row align-items-center justify-content-center text-center">
            <div class="col-md-7 mb-4 mb-md-0">
                <div class="indecopi-content p-4 rounded-lg shadow-lg hover-lift" style="background: linear-gradient(rgba(255, 255, 255, 0.7), rgba(255, 255, 255, 0.7)), url('{{ asset('images/indecopi.jpg') }}') no-repeat center center; background-size: cover; position: relative;">
                    <span class="badge bg-primary text-white px-3 py-2 rounded-pill mb-3 animate-badge">INDECOPI</span>
                    <h2 class="fw-bold text-primary mb-3">INDECOPI VIRTUAL</h2>
                    <div class="divider mx-auto mb-4" style="width: 70px; height: 3px; background: linear-gradient(90deg, #0d6efd, #0099ff);"></div>
                    <p class="lead mb-4 text-dark">Protege tus derechos y fomenta Justicia</p>
                    <p class="lead mb-4 fw-bold text-primary">Indecopi apoya a las Empresas</p>
                    <a href="https://reclamovirtual.pe/ingresar" target="_blank" class="btn btn-primary btn-lg px-4 py-2 shadow-sm hover-scale">
                        <i class="fas fa-shield-alt me-2"></i>Acceder a INDECOPI
                    </a>
                </div>
            </div>
        </div>
    </div>

    <style>
        .indecopi-section {
            position: relative;
            overflow: hidden;
        }
        
        .indecopi-content {
            transition: all 0.3s ease;
            border-left: 5px solid #0d6efd;
        }
        
        .hover-lift:hover {
            transform: translateY(-5px);
        }
        
        .hover-scale:hover {
            transform: scale(1.05);
        }
        
        .animate-badge {
            animation: pulse 2s infinite;
        }
        
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
        
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        
        @keyframes float {
            0% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-10px) rotate(5deg); }
            100% { transform: translateY(0) rotate(0deg); }
        }
    </style>
</div>

<!-- Agregar enlace a Font Awesome en la sección head -->
@section('extra_css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
@endsection
@endsection