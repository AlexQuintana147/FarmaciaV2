<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'DrodiPharma') }} - @yield('title')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <!-- Custom Styles -->
    <style>
        body {
            font-family: 'instrument-sans', sans-serif;
        }
        .navbar {
            box-shadow: 0 2px 4px rgba(0,0,0,.08);
            transition: all 0.3s ease;
        }
        .navbar-brand {
            font-weight: 600;
            color: #0d6efd;
            font-size: 1.5rem;
            transition: color 0.3s ease;
        }
        .navbar-brand:hover {
            color: #0a58ca;
        }
        .nav-link {
            font-weight: 500;
            padding: 0.5rem 1rem;
            transition: color 0.3s ease;
        }
        .nav-link:hover {
            color: #0d6efd;
        }
        .nav-link.active {
            color: #0d6efd;
            font-weight: 600;
        }
        .hero-section {
            background-color: #f8f9fa;
            padding: 5rem 0;
        }
        .footer {
            background-color: #1a1e21;
            color: #f8f9fa;
            padding: 3rem 0;
        }
        .footer h5 {
            color: #ffffff;
            font-weight: 600;
            margin-bottom: 1.5rem;
        }
        .footer a {
            color: #f8f9fa;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        .footer a:hover {
            color: #0d6efd;
            text-decoration: none;
        }
        .footer address p {
            margin-bottom: 0.5rem;
            font-style: normal;
        }
        .social-links a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            background-color: rgba(255,255,255,0.1);
            border-radius: 50%;
            transition: all 0.3s ease;
        }
        .social-links a:hover {
            background-color: #0d6efd;
            color: #ffffff;
            transform: translateY(-3px);
        }
        .footer-links li {
            margin-bottom: 0.75rem;
        }
        .footer-links a i {
            font-size: 0.75rem;
        }
        .footer-contact li {
            display: flex;
            align-items: start;
        }
        .footer-contact li i {
            margin-top: 0.25rem;
        }
        .footer hr {
            opacity: 0.1;
        }
        /* Estilos de paginación */
        .pagination {
            margin: 0;
            gap: 5px;
        }
        .page-link {
            border-radius: 4px;
            padding: 0.375rem 0.75rem;
            color: #0d6efd;
            background-color: #fff;
            border: 1px solid #dee2e6;
            transition: all 0.3s ease;
        }
        .page-link:hover {
            background-color: #e9ecef;
            border-color: #0d6efd;
            color: #0a58ca;
        }
        .page-item.active .page-link {
            background-color: #0d6efd;
            border-color: #0d6efd;
            color: #fff;
        }
        .page-item.disabled .page-link {
            color: #6c757d;
            pointer-events: none;
            background-color: #fff;
            border-color: #dee2e6;
        }
    </style>

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">DrodiPharma</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('productos*') ? 'active' : '' }}" href="{{ url('/productos') }}">Productos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('blog*') ? 'active' : '' }}" href="{{ url('/blog') }}">Blog</a>
                        </li>
                    </ul>
                    <div class="d-flex">
                        @if (Auth::guard('trabajador')->check())
                            <a href="{{ route('dashboard') }}" class="btn btn-outline-primary me-2">Dashboard</a>
                            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-outline-danger">Cerrar Sesión</button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-outline-primary">Iniciar Sesión</a>
                        @endif
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="footer mt-5">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-4 col-md-6">
                    <h5>DrodiPharma</h5>
                    <p class="mb-4">Comprometidos con tu salud y bienestar desde 2023. Ofrecemos productos farmacéuticos de la más alta calidad.</p>
                    <div class="social-links">
                        <a href="https://www.facebook.com/drodipharm/" class="me-3" target="_blank" rel="noopener noreferrer"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://www.instagram.com/drodipharma/" class="me-3" target="_blank" rel="noopener noreferrer"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <h5>Enlaces Rápidos</h5>
                    <ul class="list-unstyled footer-links">
                        <li><a href="{{ url('/') }}"><i class="fas fa-chevron-right me-2"></i>Inicio</a></li>
                        <li><a href="{{ url('/productos') }}"><i class="fas fa-chevron-right me-2"></i>Productos</a></li>
                        <li><a href="{{ url('/blog') }}"><i class="fas fa-chevron-right me-2"></i>Blog</a></li>
                        <li><a href="#"><i class="fas fa-chevron-right me-2"></i>Nosotros</a></li>
                        <li><a href="#"><i class="fas fa-chevron-right me-2"></i>Contacto</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-6">
                    <h5>Información de Contacto</h5>
                    <ul class="list-unstyled footer-contact">
                        <li class="mb-3">
                            <i class="fas fa-map-marker-alt me-2"></i>
                            Cal. San Pablo Nro. 339, San Andres Et. 3
                        </li>
                        <li class="mb-3">
                            <i class="fas fa-envelope me-2"></i>
                            contacto@drodipharma.com.pe
                        </li>
                        <li class="mb-3">
                            <i class="fas fa-phone me-2"></i>
                            +51 967 692 437
                        </li>
                        <li class="mb-3">
                            <i class="fas fa-clock me-2"></i>
                            Lun - Sáb: 8:00 AM - 8:00 PM
                        </li>
                        <li class="mb-3"> 
                            <i class="fas fa-clock me-2"></i>
                            Dom: 8:00 AM - 12:00 PM
                        </li>
                    </ul>
                </div>
            </div>
            <hr class="mt-4 mb-3 border-light">
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start">
                    <p class="mb-md-0">&copy; {{ date('Y') }} DrodiPharma. Todos los derechos reservados.</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <a href="#" class="text-muted me-3">Términos y Condiciones</a>
                    <a href="#" class="text-muted">Política de Privacidad</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>