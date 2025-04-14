@extends('layouts.app')

@section('title', 'Blog')

@section('content')
<div class="container py-5">
    <div class="row mb-5">
        <div class="col-12 text-center">
            <h1 class="fw-bold">Blog DrodiPharma</h1>
            <p class="lead">Artículos y consejos de salud escritos por nuestros profesionales</p>
        </div>
    </div>

    <div class="row">
        @forelse($blogs as $blog)
            <div class="col-md-6 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="row g-0">
                        <div class="col-md-4">
                            @if($blog->imagen)
                                <img src="{{ asset($blog->imagen) }}" class="img-fluid rounded-start h-100" style="object-fit: cover;" alt="{{ $blog->titulo }}">
                            @else
                                <img src="https://placehold.co/300x400/6c757d/white?text=Blog" class="img-fluid rounded-start h-100" style="object-fit: cover;" alt="{{ $blog->titulo }}">
                            @endif
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">{{ $blog->titulo }}</h5>
                                <h6 class="card-subtitle mb-2 text-muted">{{ $blog->subtitulo }}</h6>
                                <p class="card-text">{{ Str::limit($blog->contenido, 150) }}</p>
                                <p class="card-text">
                                    <small class="text-muted">
                                        Por: {{ $blog->trabajador->nombre }} {{ $blog->trabajador->apellido }}
                                    </small>
                                </p>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#blogModal{{ $blog->id }}">
                                    Leer más
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal para el contenido completo del blog -->
            <div class="modal fade" id="blogModal{{ $blog->id }}" tabindex="-1" aria-labelledby="blogModalLabel{{ $blog->id }}" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="blogModalLabel{{ $blog->id }}">{{ $blog->titulo }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <h6 class="text-muted">{{ $blog->subtitulo }}</h6>
                                <p class="small text-muted">
                                    Por: {{ $blog->trabajador->nombre }} {{ $blog->trabajador->apellido }} | 
                                    Publicado: {{ $blog->created_at->format('d/m/Y') }}
                                </p>
                            </div>
                            @if($blog->imagen)
                                <img src="{{ asset($blog->imagen) }}" class="img-fluid rounded mb-3" alt="{{ $blog->titulo }}">
                            @endif
                            <div>
                                {!! nl2br(e($blog->contenido)) !!}
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
                <h3>No hay artículos disponibles</h3>
                <p>Vuelve pronto para leer nuestros nuevos artículos de salud.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection