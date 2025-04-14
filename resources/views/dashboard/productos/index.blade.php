@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Gestión de Productos</h1>
        <a href="#" class="btn btn-primary"><i class="fas fa-plus"></i> Nuevo Producto</a>
    </div>
    
    <div class="card">
        <div class="card-header bg-white">
            <div class="row">
                <div class="col-md-6">
                    <form action="" method="GET" class="d-flex">
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
                            <li><a class="dropdown-item" href="#">Medicamentos</a></li>
                            <li><a class="dropdown-item" href="#">Vitaminas</a></li>
                            <li><a class="dropdown-item" href="#">Cuidado Personal</a></li>
                            <li><a class="dropdown-item" href="#">Primeros Auxilios</a></li>
                            <li><a class="dropdown-item" href="#">Suplementos</a></li>
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