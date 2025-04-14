@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Crear Nuevo Producto</h1>
        <a href="{{ route('dashboard.productos') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left"></i> Volver a la lista
        </a>
    </div>
    
    <div class="card shadow-sm">
        <div class="card-body p-4">
            <form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="row mb-3">
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label for="titulo" class="form-label fw-bold">Título del Producto <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('titulo') is-invalid @enderror" id="titulo" name="titulo" value="{{ old('titulo') }}" required>
                            @error('titulo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="categoria" class="form-label fw-bold">Categoría <span class="text-danger">*</span></label>
                            <select class="form-select @error('categoria') is-invalid @enderror" id="categoria" name="categoria" required>
                                <option value="" selected disabled>Seleccionar categoría</option>
                                @foreach($categorias as $categoria)
                                    <option value="{{ $categoria }}" {{ old('categoria') == $categoria ? 'selected' : '' }}>{{ $categoria }}</option>
                                @endforeach
                            </select>
                            @error('categoria')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="descripcion" class="form-label fw-bold">Descripción <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('descripcion') is-invalid @enderror" id="descripcion" name="descripcion" rows="5" required>{{ old('descripcion') }}</textarea>
                            @error('descripcion')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="imagen" class="form-label fw-bold">Imagen del Producto</label>
                            <input type="file" class="form-control @error('imagen') is-invalid @enderror" id="imagen" name="imagen" accept="image/*">
                            <div class="form-text">Formatos permitidos: JPG, PNG, GIF. Tamaño máximo: 2MB</div>
                            @error('imagen')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mt-3 text-center">
                            <div class="image-preview border rounded p-2 d-flex align-items-center justify-content-center" style="height: 200px; background-color: #f8f9fa;">
                                <div id="preview-placeholder">
                                    <i class="fas fa-image fa-3x text-muted"></i>
                                    <p class="mt-2 text-muted">Vista previa de imagen</p>
                                </div>
                                <img id="preview-image" src="#" alt="Vista previa" style="max-height: 180px; max-width: 100%; display: none;">
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="d-flex justify-content-end mt-4">
                    <button type="reset" class="btn btn-outline-secondary me-2">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar Producto</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Vista previa de imagen
    document.getElementById('imagen').addEventListener('change', function(e) {
        const previewImage = document.getElementById('preview-image');
        const previewPlaceholder = document.getElementById('preview-placeholder');
        
        if (e.target.files.length > 0) {
            const file = e.target.files[0];
            const reader = new FileReader();
            
            reader.onload = function(e) {
                previewImage.src = e.target.result;
                previewImage.style.display = 'block';
                previewPlaceholder.style.display = 'none';
            }
            
            reader.readAsDataURL(file);
        } else {
            previewImage.style.display = 'none';
            previewPlaceholder.style.display = 'block';
        }
    });
</script>
@endpush
@endsection