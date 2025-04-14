@extends('layouts.app')

@section('content')
<div class="container py-4">
    <style>
        .blogs-header {
            background: linear-gradient(135deg, #37bc9b, #4a89dc);
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 25px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
        }
        .floating-icon {
            position: absolute;
            opacity: 0.1;
            font-size: 3rem;
            color: #fff;
            z-index: 0;
            animation: float 6s ease-in-out infinite;
        }
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
            100% { transform: translateY(0px); }
        }
        .search-box {
            border-radius: 30px;
            padding-left: 20px;
            border: 1px solid #e0e0e0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        .search-btn {
            border-radius: 0 30px 30px 0;
            padding-left: 20px;
            padding-right: 20px;
        }
        .blog-card {
            transition: all 0.3s ease;
            border-radius: 10px;
            overflow: hidden;
            border: none;
        }
        .blog-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
        }
        .action-btn {
            width: 32px;
            height: 32px;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: all 0.2s;
        }
        .action-btn:hover {
            transform: scale(1.1);
        }
        .blog-author {
            display: inline-flex;
            align-items: center;
            background-color: rgba(74, 137, 220, 0.1);
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
        }
    </style>
    
    <!-- Header de Blogs con estilo médico -->
    <div class="blogs-header text-white mb-4">
        <!-- Iconos flotantes decorativos -->
        <div class="floating-icon" style="top: 10%; right: 10%;"><i class="fas fa-book-medical"></i></div>
        <div class="floating-icon" style="bottom: 10%; left: 15%;"><i class="fas fa-notes-medical"></i></div>
        
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="display-6 fw-bold mb-2">Gestión de Blogs</h1>
                <p class="mb-0 opacity-75">Administra los artículos y consejos de salud de DrodiPharma.</p>
            </div>
            <div class="col-md-4 text-md-end">
                <a href="{{ route('blogs.create') }}" class="btn btn-light text-primary fw-bold">
                    <i class="fas fa-plus-circle me-2"></i>Nuevo Blog
                </a>
            </div>
        </div>
    </div>
    
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    
    <div class="card">
        <div class="card-header bg-white">
            <div class="row">
                <div class="col-md-6">
                    <form action="" method="GET" class="d-flex">
                        <input type="text" name="search" class="form-control" placeholder="Buscar blogs..." value="{{ request('search') }}">
                        <button type="submit" class="btn btn-outline-primary ms-2">Buscar</button>
                    </form>
                </div>
                <div class="col-md-6 text-end">
                    <div class="btn-group">
                        <button type="button" class="btn btn-outline-secondary">Filtrar</button>
                        <button type="button" class="btn btn-outline-secondary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown">
                            <span class="visually-hidden">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Más recientes</a></li>
                            <li><a class="dropdown-item" href="#">Más antiguos</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">Todos</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Título</th>
                            <th>Autor</th>
                            <th>Fecha</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($blogs as $blog)
                            <tr>
                                <td>{{ $blog->id }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        @if($blog->imagen)
                                            <img src="{{ asset($blog->imagen) }}" alt="{{ $blog->titulo }}" class="me-2" style="width: 40px; height: 40px; object-fit: cover;">
                                        @else
                                            <div class="bg-light me-2" style="width: 40px; height: 40px;"></div>
                                        @endif
                                        <div>
                                            <h6 class="mb-0">{{ $blog->titulo }}</h6>
                                            <small class="text-muted">{{ Str::limit($blog->subtitulo, 50) }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $blog->trabajador->nombre_completo }}</td>
                                <td>{{ $blog->created_at->format('d/m/Y') }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('blogs.show', $blog) }}" class="btn btn-sm btn-outline-primary"><i class="fas fa-eye"></i></a>
                                        <a href="{{ route('blogs.edit', $blog) }}" class="btn btn-sm btn-outline-success"><i class="fas fa-edit"></i></a>
                                        <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $blog->id }}"><i class="fas fa-trash"></i></button>
                                    </div>
                                    
                                    <!-- Modal de confirmación para eliminar -->
                                    <div class="modal fade" id="deleteModal{{ $blog->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $blog->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel{{ $blog->id }}">Confirmar eliminación</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    ¿Estás seguro de que deseas eliminar el blog <strong>{{ $blog->titulo }}</strong>? Esta acción no se puede deshacer.
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                    <form action="{{ route('blogs.destroy', $blog) }}" method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Eliminar</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4">
                                    <div class="d-flex flex-column align-items-center">
                                        <i class="fas fa-blog fa-3x text-muted mb-3"></i>
                                        <h5>No hay blogs disponibles</h5>
                                        <p class="text-muted">Crea un nuevo blog para comenzar</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-white py-3">
            <div class="text-muted small">Total de registros: {{ count($blogs) }}</div>
        </div>
    </div>
</div>
@endsection