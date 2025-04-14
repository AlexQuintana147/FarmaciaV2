@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Gestión de Blogs</h1>
        <a href="{{ route('blogs.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Nuevo Blog</a>
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
        <div class="card-footer">
            <div class="d-flex justify-content-between align-items-center">
                <div>Mostrando {{ $blogs->firstItem() ?? 0 }} a {{ $blogs->lastItem() ?? 0 }} de {{ $blogs->total() ?? 0 }} registros</div>
                <div>{{ $blogs->links() }}</div>
            </div>
        </div>
    </div>
</div>
@endsection