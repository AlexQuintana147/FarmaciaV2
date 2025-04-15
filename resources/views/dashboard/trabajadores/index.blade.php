@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Gestión de Trabajadores</h5>
                    @if($isAdmin)
                    <a href="{{ route('trabajadores.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus me-1"></i> Nuevo Trabajador
                    </a>
                    @endif
                </div>
                <div class="card-body">
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Usuario</th>
                                    <th>Nombre Completo</th>
                                    <th>Apellidos</th>
                                    <th>DNI</th>
                                    <th>Fecha Registro</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($trabajadores as $trabajador)
                                <tr>
                                    <td>{{ $trabajador->id }}</td>
                                    <td>{{ $trabajador->usuario }}</td>
                                    <td>{{ $trabajador->nombre_completo }}</td>
                                    <td>{{ $trabajador->apellidos }}</td>
                                    <td>{{ $trabajador->dni }}</td>
                                    <td>{{ $trabajador->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('trabajadores.show', $trabajador) }}" class="btn btn-sm btn-info text-white" title="Ver detalles">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            @if($isAdmin)
                                                <a href="{{ route('trabajadores.edit', $trabajador) }}" class="btn btn-sm btn-warning text-white" title="Editar">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button type="button" class="btn btn-sm btn-danger" title="Eliminar" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $trabajador->id }}">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            @endif
                                        </div>
                                        
                                        <!-- Modal de confirmación para eliminar -->
                                        @if($isAdmin)
                                        <div class="modal fade" id="deleteModal{{ $trabajador->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $trabajador->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteModalLabel{{ $trabajador->id }}">Confirmar eliminación</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        ¿Está seguro que desea eliminar al trabajador <strong>{{ $trabajador->nombre_completo }}</strong>?
                                                        <p class="text-danger mt-2">Esta acción no se puede deshacer.</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                        <form action="{{ route('trabajadores.destroy', $trabajador) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Eliminar</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center">No hay trabajadores registrados</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection