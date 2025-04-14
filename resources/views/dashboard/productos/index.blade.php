@extends('layouts.app')

@section('content')
<div class="container py-4">
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Gestión de Productos</h1>
        <a href="{{ route('productos.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Nuevo Producto</a>
    </div>
    
    <div class="card">
        <div class="card-header bg-white">
            <div class="row">
                <div class="col-md-6">
                    <form action="{{ route('dashboard.productos') }}" method="GET" class="d-flex">
                        <input type="text" name="search" class="form-control" placeholder="Buscar productos..." value="{{ request('search') }}">
                        <button type="submit" class="btn btn-outline-primary ms-2">Buscar</button>
                    </form>
                </div>
                <div class="col-md-6 text-end">
                    <div class="btn-group">
                        <button type="button" class="btn btn-outline-secondary">Categoría</button>
                        <button type="button" class="btn btn-outline-secondary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown">
                            <span class="visually-hidden">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('dashboard.productos', ['categoria' => 'Medicamentos']) }}">Medicamentos</a></li>
                            <li><a class="dropdown-item" href="{{ route('dashboard.productos', ['categoria' => 'Vitaminas']) }}">Vitaminas</a></li>
                            <li><a class="dropdown-item" href="{{ route('dashboard.productos', ['categoria' => 'Cuidado Personal']) }}">Cuidado Personal</a></li>
                            <li><a class="dropdown-item" href="{{ route('dashboard.productos', ['categoria' => 'Primeros Auxilios']) }}">Primeros Auxilios</a></li>
                            <li><a class="dropdown-item" href="{{ route('dashboard.productos', ['categoria' => 'Suplementos']) }}">Suplementos</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ route('dashboard.productos') }}">Todos</a></li>
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
                            <th>Producto</th>
                            <th>Categoría</th>
                            <th>Fecha</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($productos as $producto)
                            <tr>
                                <td>{{ $producto->id }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        @if($producto->imagen)
                                            <img src="{{ asset($producto->imagen) }}" alt="{{ $producto->titulo }}" class="me-2" style="width: 40px; height: 40px; object-fit: cover;">
                                        @else
                                            <div class="bg-light me-2" style="width: 40px; height: 40px;"></div>
                                        @endif
                                        <div>
                                            <h6 class="mb-0">{{ $producto->titulo }}</h6>
                                            <small class="text-muted">{{ Str::limit($producto->descripcion, 50) }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-{{ $producto->categoria == 'Medicamentos' ? 'primary' : ($producto->categoria == 'Vitaminas' ? 'success' : ($producto->categoria == 'Cuidado Personal' ? 'info' : ($producto->categoria == 'Primeros Auxilios' ? 'danger' : 'warning'))) }}">
                                        {{ $producto->categoria }}
                                    </span>
                                </td>
                                <td>{{ $producto->created_at->format('d/m/Y') }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('productos.show', $producto) }}" class="btn btn-sm btn-outline-primary"><i class="fas fa-eye"></i></a>
                                        <a href="{{ route('productos.edit', $producto) }}" class="btn btn-sm btn-outline-success"><i class="fas fa-edit"></i></a>
                                        <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $producto->id }}"><i class="fas fa-trash"></i></button>
                                    </div>
                                    
                                    <!-- Modal de confirmación para eliminar -->
                                    <div class="modal fade" id="deleteModal{{ $producto->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $producto->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel{{ $producto->id }}">Confirmar eliminación</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    ¿Estás seguro de que deseas eliminar el producto <strong>{{ $producto->titulo }}</strong>? Esta acción no se puede deshacer.
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                    <form action="{{ route('productos.destroy', $producto) }}" method="POST" style="display: inline;">
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
                                        <i class="fas fa-box fa-3x text-muted mb-3"></i>
                                        <h5>No hay productos disponibles</h5>
                                        <p class="text-muted">Crea un nuevo producto para comenzar</p>
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
                <div>Mostrando {{ $productos->firstItem() ?? 0 }} a {{ $productos->lastItem() ?? 0 }} de {{ $productos->total() ?? 0 }} registros</div>
                <div>{{ $productos->links() }}</div>
            </div>
        </div>
    </div>
</div>
@endsection