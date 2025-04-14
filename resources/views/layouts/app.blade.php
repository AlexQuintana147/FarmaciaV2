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
        .navbar-brand {
            font-weight: 600;
            color: #0d6efd;
        }
        .hero-section {
            background-color: #f8f9fa;
            padding: 5rem 0;
        }
        .footer {
            background-color: #212529;
            color: white;
            padding: 2rem 0;
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
        }
        .page-link:hover {
            background-color: #e9ecef;
            border-color: #dee2e6;
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
            <div class="row">
                <div class="col-md-4">
                    <h5>DrodiPharma</h5>
                    <p>Comprometidos con tu salud y bienestar desde 1995.</p>
                </div>
                <div class="col-md-4">
                    <h5>Enlaces Rápidos</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ url('/') }}" class="text-white">Inicio</a></li>
                        <li><a href="{{ url('/productos') }}" class="text-white">Productos</a></li>
                        <li><a href="{{ url('/blog') }}" class="text-white">Blog</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Contacto</h5>
                    <address>
                        <p>Av. Principal 123<br>Lima, Perú</p>
                        <p>Email: info@drodipharma.com<br>Teléfono: (01) 123-4567</p>
                    </address>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12 text-center">
                    <p class="mb-0">&copy; {{ date('Y') }} DrodiPharma. Todos los derechos reservados.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>