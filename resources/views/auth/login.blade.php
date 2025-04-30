<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - DrodiPharma</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center min-vh-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-10 col-md-8 col-lg-5 col-xl-4">
                <div class="card shadow-lg rounded-4 border-0 p-0 overflow-hidden" style="background: linear-gradient(135deg, #fff 70%, #e3f0ff 100%);">
                    <div class="px-4 py-5">
                        <div class="text-center mb-4">
                            <span class="d-inline-block bg-primary bg-opacity-10 rounded-circle p-3 mb-2">
                                <i class="bi bi-capsule-pill fs-2 text-primary"></i>
                            </span>
                            <h1 class="fw-bold text-primary mb-0" style="letter-spacing:1px;">DrodiPharma</h1>
                            <div class="text-secondary mb-2">Panel de Administración</div>
                        </div>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form method="POST" action="{{ route('login') }}" class="d-flex flex-column gap-3">
                            @csrf
                            <div class="form-floating">
                                <input type="text" class="form-control" id="usuario" name="usuario" value="{{ old('usuario') }}" placeholder="Usuario" required autofocus>
                                <label for="usuario">Usuario</label>
                            </div>
                            <div class="form-floating">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" required>
                                <label for="password">Contraseña</label>
                            </div>
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="remember" name="remember">
                                    <label class="form-check-label" for="remember">Recordarme</label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg w-100 mt-2">
                                <i class="bi bi-box-arrow-in-right me-2"></i>Iniciar Sesión
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>