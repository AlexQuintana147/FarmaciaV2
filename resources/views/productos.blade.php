@extends('layouts.app')

@section('title', 'Productos')

@section('content')
<div class="container py-5">
    <div class="row mb-4">
        <div class="col-12 text-center">
            <h1 class="fw-bold">Nuestros Productos</h1>
            <p class="lead">Descubre nuestra amplia gama de productos farmacéuticos</p>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-center flex-wrap">
                <button class="btn btn-outline-primary m-1 filter-btn active" data-filter="all">Todos</button>
                <button class="btn btn-outline-primary m-1 filter-btn" data-filter="Medicamentos">Medicamentos</button>
                <button class="btn btn-outline-primary m-1 filter-btn" data-filter="Cuidado Personal">Cuidado Personal</button>
                <button class="btn btn-outline-primary m-1 filter-btn" data-filter="Vitaminas">Vitaminas</button>
                <button class="btn btn-outline-primary m-1 filter-btn" data-filter="Bebés">Bebés</button>
            </div>
        </div>
    </div>

    <div class="row" id="productos-container">
        @forelse($productos as $producto)
            <div class="col-md-4 mb-4 producto-item" data-categoria="{{ $producto->categoria }}">
                <div class="card h-100 shadow-sm">
                    <style>
                        .card-img-container {
                            position: relative;
                            padding-top: 75%; /* Relación de aspecto 4:3 */
                            overflow: hidden;
                        }
                        .card-img-container img {
                            position: absolute;
                            top: 0;
                            left: 0;
                            width: 100%;
                            height: 100%;
                            object-fit: contain;
                            background-color: #f8f9fa;
                        }
                        .modal-img-container {
                            background-color: #f8f9fa;
                            border-radius: 0.25rem;
                            padding: 1rem;
                        }
                    </style>
                    @php
                        $imagePath = $producto->imagen ? asset($producto->imagen) : asset('images/NoImage.png');
                    @endphp
                    <div class="card-img-container">
                        <img src="{{ $imagePath }}" class="card-img-top" alt="{{ $producto->titulo }}">
                    </div>

                    <div class="card-body">
                        <h5 class="card-title">{{ $producto->titulo }}</h5>
                        <p class="badge bg-primary">{{ $producto->categoria }}</p>
                        <p class="card-text">{{ Str::limit($producto->descripcion, 100) }}</p>
                    </div>
                    <div class="card-footer bg-white border-top-0">
                        <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#productoModal{{ $producto->id }}">
                            Ver Detalles
                        </button>
                    </div>
                </div>
            </div>

            <!-- Modal para detalles del producto -->
            <div class="modal fade" id="productoModal{{ $producto->id }}" tabindex="-1" aria-labelledby="productoModalLabel{{ $producto->id }}" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="productoModalLabel{{ $producto->id }}">{{ $producto->titulo }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    @php
                                        $modalImagePath = $producto->imagen ? asset($producto->imagen) : asset('images/NoImage.png');
                                    @endphp
                                    <img src="{{ $modalImagePath }}" class="img-fluid rounded" alt="{{ $producto->titulo }}" style="width: 100%; height: auto; max-height: 500px; object-fit: contain;">
                                </div>
                                <div class="col-md-6">
                                    <h4>{{ $producto->titulo }}</h4>
                                    <p class="badge bg-primary mb-3">{{ $producto->categoria }}</p>
                                    <p>{{ $producto->descripcion }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <h3>No hay productos disponibles</h3>
                <p>Vuelve pronto para ver nuestros nuevos productos.</p>
            </div>
        @endforelse
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const filterButtons = document.querySelectorAll('.filter-btn');
        const productoItems = document.querySelectorAll('.producto-item');

        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                const filterValue = this.getAttribute('data-filter');
                
                // Actualizar botones activos
                filterButtons.forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');
                
                // Filtrar productos
                productoItems.forEach(item => {
                    if (filterValue === 'all' || item.getAttribute('data-categoria') === filterValue) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        });
    });
</script>
@endsection