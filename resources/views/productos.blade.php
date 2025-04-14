@extends('layouts.app')

@section('title', 'Productos')

@section('content')
<!-- Hero Section con fondo médico -->
<div class="hero-section mb-5">
    <!-- Elementos decorativos médicos flotantes -->
    <div class="floating-icon" style="top: 15%; left: 10%;"><i class="fas fa-pills"></i></div>
    <div class="floating-icon" style="top: 25%; right: 15%;"><i class="fas fa-capsules"></i></div>
    <div class="floating-icon" style="bottom: 20%; left: 20%;"><i class="fas fa-prescription"></i></div>
    <div class="floating-icon" style="bottom: 30%; right: 10%;"><i class="fas fa-tablets"></i></div>
    
    <div class="container py-5">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <div class="bg-white p-4 rounded-lg shadow-sm">
                    <h1 class="display-5 fw-bold text-primary mb-3">Nuestros Productos</h1>
                    <div class="divider mb-4" style="width: 70px; height: 3px; background-color: var(--medical-green);"></div>
                    <p class="lead">Descubre nuestra amplia gama de productos farmacéuticos de la más alta calidad para el cuidado de tu salud y bienestar.</p>
                </div>
            </div>
            <div class="col-lg-6 text-center">
                <img src="https://placehold.co/600x400/e8f4fd/4a89dc?text=Productos+Farmacéuticos" class="img-fluid rounded shadow" alt="Productos Farmacéuticos">
            </div>
        </div>
    </div>
</div>

<div class="container py-3">

    <!-- Sección de filtros con estilo médico -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="bg-white p-3 rounded-lg shadow-sm">
                <h5 class="text-center mb-3"><i class="fas fa-filter me-2 text-primary"></i>Filtrar por categoría</h5>
                <div class="d-flex justify-content-center flex-wrap">
                    <button class="btn btn-primary m-1 filter-btn active" data-filter="all">
                        <i class="fas fa-th-large me-1"></i> Todos
                    </button>
                    <button class="btn btn-outline-primary m-1 filter-btn" data-filter="Medicamentos">
                        <i class="fas fa-pills me-1"></i> Medicamentos
                    </button>
                    <button class="btn btn-outline-primary m-1 filter-btn" data-filter="Cuidado Personal">
                        <i class="fas fa-pump-soap me-1"></i> Cuidado Personal
                    </button>
                    <button class="btn btn-outline-primary m-1 filter-btn" data-filter="Vitaminas">
                        <i class="fas fa-apple-alt me-1"></i> Vitaminas
                    </button>
                    <button class="btn btn-outline-primary m-1 filter-btn" data-filter="Bebés">
                        <i class="fas fa-baby me-1"></i> Bebés
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="row" id="productos-container">
        @forelse($productos as $producto)
            <div class="col-md-4 mb-4 producto-item" data-categoria="{{ $producto->categoria }}">
                <div class="card h-100 shadow-sm border-0 product-card">
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
                            background-color: var(--medical-light-blue);
                            transition: transform 0.5s ease;
                        }
                        .card-img-container:hover img {
                            transform: scale(1.05);
                        }
                        .modal-img-container {
                            background-color: var(--medical-light-blue);
                            border-radius: 0.5rem;
                            padding: 1.5rem;
                        }
                        .product-card {
                            transition: all 0.3s ease;
                            border-radius: 0.5rem;
                            overflow: hidden;
                        }
                        .product-card:hover {
                            transform: translateY(-5px);
                            box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
                        }
                        .category-badge {
                            position: absolute;
                            top: 10px;
                            right: 10px;
                            z-index: 10;
                        }
                    </style>
                    @php
                        $imagePath = $producto->imagen ? asset($producto->imagen) : asset('images/NoImage.png');
                        $categoryIcon = 'fas fa-pills';
                        
                        if($producto->categoria == 'Cuidado Personal') {
                            $categoryIcon = 'fas fa-pump-soap';
                        } elseif($producto->categoria == 'Vitaminas') {
                            $categoryIcon = 'fas fa-apple-alt';
                        } elseif($producto->categoria == 'Bebés') {
                            $categoryIcon = 'fas fa-baby';
                        }
                    @endphp
                    
                    <div class="category-badge">
                        <span class="badge bg-primary px-3 py-2 rounded-pill">
                            <i class="{{ $categoryIcon }} me-1"></i> {{ $producto->categoria }}
                        </span>
                    </div>
                    
                    <div class="card-img-container">
                        <img src="{{ $imagePath }}" class="card-img-top" alt="{{ $producto->titulo }}">
                    </div>

                    <div class="card-body">
                        <h5 class="card-title fw-bold">{{ $producto->titulo }}</h5>
                        <p class="card-text text-muted">{{ Str::limit($producto->descripcion, 100) }}</p>
                    </div>
                    <div class="card-footer bg-white border-top-0 pb-3">
                        <button type="button" class="btn btn-primary w-100 rounded-pill" data-bs-toggle="modal" data-bs-target="#productoModal{{ $producto->id }}">
                            <i class="fas fa-eye me-2"></i>Ver Detalles
                        </button>
                    </div>
                </div>
            </div>

            <!-- Modal para detalles del producto con estilo médico -->
            <div class="modal fade" id="productoModal{{ $producto->id }}" tabindex="-1" aria-labelledby="productoModalLabel{{ $producto->id }}" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content border-0 shadow">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title" id="productoModalLabel{{ $producto->id }}"><i class="{{ $categoryIcon }} me-2"></i>{{ $producto->titulo }}</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-4">
                            <div class="row">
                                <div class="col-md-6 mb-4 mb-md-0">
                                    @php
                                        $modalImagePath = $producto->imagen ? asset($producto->imagen) : asset('images/NoImage.png');
                                    @endphp
                                    <div class="modal-img-container text-center p-4 rounded">
                                        <img src="{{ $modalImagePath }}" class="img-fluid rounded" alt="{{ $producto->titulo }}" style="width: 100%; height: auto; max-height: 500px; object-fit: contain;">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h4 class="fw-bold text-primary mb-3">{{ $producto->titulo }}</h4>
                                    <div class="d-flex align-items-center mb-3">
                                        <span class="badge bg-primary px-3 py-2 rounded-pill">
                                            <i class="{{ $categoryIcon }} me-1"></i> {{ $producto->categoria }}
                                        </span>
                                    </div>
                                    <div class="divider mb-3" style="width: 50px; height: 3px; background-color: var(--medical-green);"></div>
                                    <h6 class="fw-bold mb-2">Descripción:</h6>
                                    <p class="mb-4">{{ $producto->descripcion }}</p>
                                    
                                    <div class="bg-light p-3 rounded mb-3">
                                        <h6 class="fw-bold mb-2"><i class="fas fa-info-circle me-2 text-primary"></i>Información adicional</h6>
                                        <p class="small mb-0">Consulte a su médico o farmacéutico antes de usar este producto. Mantenga todos los medicamentos fuera del alcance de los niños.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                <i class="fas fa-times me-2"></i>Cerrar
                            </button>
                            <button type="button" class="btn btn-primary" disabled>
                                <i class="fas fa-shopping-cart me-2"></i>Añadir al carrito
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <div class="bg-white p-5 rounded-lg shadow-sm">
                    <i class="fas fa-box-open text-muted mb-3" style="font-size: 4rem;"></i>
                    <h3 class="text-primary">No hay productos disponibles</h3>
                    <p class="lead">Estamos trabajando para añadir nuevos productos a nuestro catálogo.</p>
                    <p>Vuelve pronto para ver nuestras novedades.</p>
                </div>
            </div>
        @endforelse
    </div>
    
    <!-- Sección de información adicional -->
    <div class="row mt-5 mb-4">
        <div class="col-12">
            <div class="bg-white p-4 rounded-lg shadow-sm">
                <div class="row g-4">
                    <div class="col-md-4 text-center">
                        <div class="p-3">
                            <i class="fas fa-truck text-primary mb-3" style="font-size: 2.5rem;"></i>
                            <h5 class="fw-bold">Entrega a Domicilio</h5>
                            <p class="text-muted mb-0">Llevamos tus medicamentos directamente a tu hogar.</p>
                        </div>
                    </div>
                    <div class="col-md-4 text-center">
                        <div class="p-3">
                            <i class="fas fa-certificate text-primary mb-3" style="font-size: 2.5rem;"></i>
                            <h5 class="fw-bold">Productos Certificados</h5>
                            <p class="text-muted mb-0">Garantizamos la calidad y autenticidad de todos nuestros productos.</p>
                        </div>
                    </div>
                    <div class="col-md-4 text-center">
                        <div class="p-3">
                            <i class="fas fa-headset text-primary mb-3" style="font-size: 2.5rem;"></i>
                            <h5 class="fw-bold">Atención Personalizada</h5>
                            <p class="text-muted mb-0">Nuestro equipo está disponible para resolver tus dudas.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
<!-- Agregar scripts para el filtrado de productos -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const filterBtns = document.querySelectorAll('.filter-btn');
        const productoItems = document.querySelectorAll('.producto-item');
        
        filterBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                // Remover clase active de todos los botones
                filterBtns.forEach(b => b.classList.remove('active'));
                // Agregar clase active al botón clickeado
                this.classList.add('active');
                
                const filter = this.getAttribute('data-filter');
                
                productoItems.forEach(item => {
                    if (filter === 'all' || item.getAttribute('data-categoria') === filter) {
                        item.style.display = 'block';
                        // Añadir animación
                        item.style.opacity = '0';
                        setTimeout(() => {
                            item.style.opacity = '1';
                            item.style.transition = 'opacity 0.5s ease';
                        }, 50);
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        });
    });
</script>

@section('extra_css')
<style>
    /* Estilos adicionales para la página de productos */
    .filter-btn {
        transition: all 0.3s ease;
        border-radius: 20px;
        padding: 0.5rem 1rem;
    }
    .filter-btn:hover {
        transform: translateY(-2px);
    }
    .filter-btn.active {
        background-color: var(--medical-blue);
        border-color: var(--medical-blue);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
</style>
@endsection

@endsection