@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Editar Blog</h1>
        <a href="{{ route('dashboard.blogs') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left"></i> Volver a la lista
        </a>
    </div>
    
    <div class="card shadow-sm">
        <div class="card-body p-4">
            <form action="{{ route('blogs.update', $blog) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="row mb-3">
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label for="titulo" class="form-label fw-bold">Título del Blog <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('titulo') is-invalid @enderror" id="titulo" name="titulo" value="{{ old('titulo', $blog->titulo) }}" required>
                            @error('titulo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="subtitulo" class="form-label fw-bold">Subtítulo <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('subtitulo') is-invalid @enderror" id="subtitulo" name="subtitulo" value="{{ old('subtitulo', $blog->subtitulo) }}" required>
                            @error('subtitulo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="contenido" class="form-label fw-bold">Contenido <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('contenido') is-invalid @enderror" id="contenido" name="contenido" rows="8" required>{{ old('contenido', $blog->contenido) }}</textarea>
                            @error('contenido')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="imagen" class="form-label fw-bold">Imagen del Blog</label>
                            <input type="file" class="form-control @error('imagen') is-invalid @enderror" id="imagen" name="imagen">
                            @error('imagen')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Formatos permitidos: JPG, PNG, GIF. Tamaño máximo: 2MB</div>
                        </div>
                        
                        <div class="mt-4 p-3 border rounded bg-light">
                            <div class="preview-image text-center">
                                @if($blog->imagen)
                                    <img id="preview" src="{{ asset($blog->imagen) }}" alt="{{ $blog->titulo }}" style="max-width: 100%; max-height: 200px;">
                                    <div id="no-preview" class="py-5 d-flex flex-column align-items-center justify-content-center" style="display: none;">
                                        <i class="fas fa-image fa-4x text-muted mb-3"></i>
                                        <p class="text-muted">Vista previa de la imagen</p>
                                    </div>
                                @else
                                    <img id="preview" src="#" alt="Vista previa" style="max-width: 100%; max-height: 200px; display: none;">
                                    <div id="no-preview" class="py-5 d-flex flex-column align-items-center justify-content-center">
                                        <i class="fas fa-image fa-4x text-muted mb-3"></i>
                                        <p class="text-muted">Vista previa de la imagen</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('dashboard.blogs') }}" class="btn btn-outline-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Actualizar Blog</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.getElementById('imagen').addEventListener('change', function(e) {
        const preview = document.getElementById('preview');
        const noPreview = document.getElementById('no-preview');
        
        if (this.files && this.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                preview.setAttribute('src', e.target.result);
                preview.style.display = 'block';
                noPreview.style.display = 'none';
            }
            
            reader.readAsDataURL(this.files[0]);
        } else {
            preview.style.display = 'none';
            noPreview.style.display = 'flex';
        }
    });
</script>
@endpush
@endsection