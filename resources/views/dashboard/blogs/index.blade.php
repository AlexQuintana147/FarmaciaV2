@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Gestión de Blogs</h1>
        <a href="#" class="btn btn-primary"><i class="fas fa-plus"></i> Nuevo Blog</a>
    </div>
    
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
                                        <a href="#" class="btn btn-sm btn-outline-primary"><i class="fas fa-eye"></i></a>
                                        <a href="#" class="btn btn-sm btn-outline-success"><i class="fas fa-edit"></i></a>
                                        <a href="#" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></a>
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
        <div class="card-footer">
            <div class="d-flex justify-content-between align-items-center">
                <div>Mostrando {{ $blogs->firstItem() ?? 0 }} a {{ $blogs->lastItem() ?? 0 }} de {{ $blogs->total() ?? 0 }} registros</div>
                <div>{{ $blogs->links() }}</div>
            </div>
        </div>
    </div>
</div>
@endsection