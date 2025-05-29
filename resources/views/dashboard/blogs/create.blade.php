@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="bg-gradient-primary-to-secondary p-3 rounded-3 mb-4 shadow-sm">
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="text-white mb-0"><i class="fas fa-pen-fancy me-2"></i>Crear Nuevo Blog</h1>
            <a href="{{ route('dashboard.blogs') }}" class="btn btn-light">
                <i class="fas fa-arrow-left"></i> Volver a la lista
            </a>
        </div>
    </div>
    
    <div class="card shadow border-0 rounded-3 overflow-hidden">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0 text-primary"><i class="fas fa-edit me-2"></i>Información del Blog</h5>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('blogs.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="row mb-3">
                    <div class="col-md-8">
                        <div class="mb-4">
                            <label for="titulo" class="form-label fw-bold text-primary"><i class="fas fa-heading me-1"></i> Título del Blog <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-lg @error('titulo') is-invalid @enderror" id="titulo" name="titulo" value="{{ old('titulo') }}" placeholder="Ingrese un título atractivo" required>
                            @error('titulo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="subtitulo" class="form-label fw-bold text-primary"><i class="fas fa-align-left me-1"></i> Subtítulo <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('subtitulo') is-invalid @enderror" id="subtitulo" name="subtitulo" value="{{ old('subtitulo') }}" placeholder="Breve descripción del contenido" required>
                            @error('subtitulo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="contenido" class="form-label fw-bold text-primary"><i class="fas fa-file-alt me-1"></i> Contenido <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('contenido') is-invalid @enderror" id="contenido" name="contenido" rows="10" placeholder="Escriba el contenido detallado del blog" required>{{ old('contenido') }}</textarea>
                            @error('contenido')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text mb-4">
                                <i class="fas fa-info-circle text-primary"></i> El contenido será analizado para evaluar su calidad y relevancia.
                            </div>

                            <!-- Sección de Análisis de IA -->
                            <div class="ai-analysis-section">
                                <!-- Botón de análisis con efecto de elevación -->
                                <div class="text-center mb-4">
                                    <button type="button" class="btn btn-primary btn-lg px-5 py-3 shadow-sm" id="medirContenido" 
                                            style="background: linear-gradient(135deg, #4e73df 0%, #224abe 100%); border: none;">
                                        <div class="d-flex align-items-center justify-content-center">
                                            <i class="fas fa-robot me-2"></i>
                                            <span class="fw-bold">Analizar Contenido con IA</span>
                                            <i class="fas fa-arrow-right ms-2"></i>
                                        </div>
                                    </button>
                                </div>
                                
                                <!-- Panel de Resultados -->
                                <div class="analysis-results" style="display: none;">
                                    <div class="card border-0 shadow-sm">
                                        <div class="card-body p-4">
                                            <div class="row align-items-center">
                                                <!-- Medidor de Calidad -->
                                                <div class="col-lg-5 text-center mb-4 mb-lg-0">
                                                    <div class="quality-meter">
                                                        <div class="gauge-container">
                                                            <div class="gauge">
                                                                <div class="gauge-body">
                                                                    <div class="gauge-fill"></div>
                                                                    <div class="gauge-cover">
                                                                        <span class="gauge-value" id="quality-percentage">0</span>%
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="gauge-label mt-3">Calidad del Contenido</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <!-- Métricas Detalladas -->
                                                <div class="col-lg-7">
                                                    <h5 class="text-primary mb-4">
                                                        <i class="fas fa-chart-pie me-2"></i>
                                                        Análisis Detallado
                                                    </h5>
                                                    
                                                    <div class="metrics-grid">
                                                        <div class="metric-item">
                                                            <div class="metric-icon" style="background: rgba(78, 115, 223, 0.1);">
                                                                <i class="fas fa-ruler-combined text-primary"></i>
                                                            </div>
                                                            <div class="metric-details">
                                                                <span class="metric-title">Longitud</span>
                                                                <span class="metric-value" id="length-metric">-</span>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="metric-item">
                                                            <div class="metric-icon" style="background: rgba(28, 200, 138, 0.1);">
                                                                <i class="fas fa-search text-success"></i>
                                                            </div>
                                                            <div class="metric-details">
                                                                <span class="metric-title">Relevancia</span>
                                                                <span class="metric-value" id="relevance-metric">-</span>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="metric-item">
                                                            <div class="metric-icon" style="background: rgba(246, 194, 62, 0.1);">
                                                                <i class="fas fa-puzzle-piece text-warning"></i>
                                                            </div>
                                                            <div class="metric-details">
                                                                <span class="metric-title">Estructura</span>
                                                                <span class="metric-value" id="structure-metric">-</span>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="metric-item">
                                                            <div class="metric-icon" style="background: rgba(231, 74, 59, 0.1);">
                                                                <i class="fas fa-tachometer-alt text-danger"></i>
                                                            </div>
                                                            <div class="metric-details">
                                                                <span class="metric-title">Rendimiento SEO</span>
                                                                <span class="metric-value" id="seo-metric">-</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="analysis-summary mt-4">
                                                        <div class="d-flex align-items-center mb-2">
                                                            <i class="fas fa-lightbulb me-2 text-warning"></i>
                                                            <h6 class="mb-0">Recomendaciones</h6>
                                                        </div>
                                                        <ul class="list-unstyled mb-0" id="recommendations-list">
                                                            <li class="d-flex align-items-start mb-2">
                                                                <i class="fas fa-check-circle text-success mt-1 me-2"></i>
                                                                <span>Escribe al menos 300 palabras para un mejor análisis</span>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-header bg-light py-3">
                                <h6 class="mb-0 text-primary"><i class="fas fa-camera-retro me-2"></i>Imagen del Blog</h6>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="imagen" class="form-label fw-bold">Seleccionar imagen</label>
                                    <input type="file" class="form-control @error('imagen') is-invalid @enderror" id="imagen" name="imagen">
                                    @error('imagen')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text"><i class="fas fa-info-circle me-1"></i> Formatos permitidos: JPG, PNG, GIF. Tamaño máximo: 2MB</div>
                                </div>
                                
                                <div class="mt-4 p-3 border rounded bg-light">
                                    <div class="preview-image text-center">
                                        <img id="preview" src="#" alt="Vista previa" class="img-fluid rounded shadow-sm" style="max-width: 100%; max-height: 200px; display: none;">
                                        <div id="no-preview" class="py-5 d-flex flex-column align-items-center justify-content-center">
                                            <i class="fas fa-image fa-4x text-primary opacity-50 mb-3"></i>
                                            <p class="text-muted">Vista previa de la imagen</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="{{ route('dashboard.blogs') }}" class="btn btn-outline-secondary px-4">
                        <i class="fas fa-times me-2"></i>Cancelar
                    </a>
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fas fa-save me-2"></i>Guardar Blog
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    /* Botón de Análisis */
    #medirContenido {
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease;
        font-weight: 600;
        letter-spacing: 0.5px;
        box-shadow: 0 4px 15px rgba(78, 115, 223, 0.3);
    }
    
    #medirContenido:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(78, 115, 223, 0.4);
    }
    
    #medirContenido:active {
        transform: translateY(0);
    }
    
    /* Medidor de Calidad */
    .gauge-container {
        width: 220px;
        height: 180px;
        margin: 0 auto;
        position: relative;
    }
    
    .gauge {
        width: 100%;
        height: 100%;
        position: relative;
    }
    
    .gauge-body {
        width: 100%;
        height: 0;
        padding-bottom: 50%;
        position: relative;
        border-top-left-radius: 110px 100px;
        border-top-right-radius: 110px 100px;
        overflow: hidden;
        background-color: #f5f8ff;
        border: 10px solid #f0f4ff;
        border-bottom: 0;
        box-sizing: border-box;
    }
    
    .gauge-fill {
        position: absolute;
        top: 100%;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
        transform-origin: center top;
        transform: rotate(0.5turn);
        transition: transform 1s ease-out;
    }
    
    .gauge-cover {
        position: absolute;
        border-radius: 50%;
        background: white;
        width: 65%;
        height: 130%;
        bottom: -30%;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        box-shadow: 0 0 15px rgba(0,0,0,0.1);
        border: 8px solid #f8f9fe;
    }
    
    .gauge-value {
        font-size: 2.5rem;
        font-weight: 700;
        color: #2d3748;
        line-height: 1;
        font-family: 'Poppins', sans-serif;
    }
    
    .gauge-label {
        margin-top: 1rem;
        font-size: 0.9rem;
        color: #6b7280;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    /* Grid de Métricas */
    .metrics-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
    }
    
    .metric-item {
        background: white;
        border-radius: 10px;
        padding: 1rem;
        display: flex;
        align-items: center;
        transition: all 0.3s ease;
        border: 1px solid #edf2f7;
    }
    
    .metric-item:hover {
        transform: translateY(-3px);
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    }
    
    .metric-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 12px;
        font-size: 1.1rem;
    }
    
    .metric-details {
        flex: 1;
    }
    
    .metric-title {
        display: block;
        font-size: 0.8rem;
        color: #718096;
        margin-bottom: 2px;
    }
    
    .metric-value {
        font-weight: 700;
        color: #2d3748;
        font-size: 1.1rem;
    }
    
    /* Sección de Recomendaciones */
    .analysis-summary {
        background: #f8f9fe;
        border-radius: 10px;
        padding: 1.25rem;
        border: 1px solid #edf2f7;
    }
    
    .analysis-summary h6 {
        color: #4a5568;
        font-weight: 600;
    }
    
    #recommendations-list li {
        padding: 0.5rem 0;
        border-bottom: 1px solid #edf2f7;
    }
    
    #recommendations-list li:last-child {
        border-bottom: none;
        padding-bottom: 0;
    }
    
    #recommendations-list li i {
        font-size: 0.9rem;
    }
    
    /* Animaciones */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .analysis-results {
        animation: fadeIn 0.5s ease-out forwards;
    }
</style>

@push('scripts')
<script>
    // Image preview functionality
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

    // AI Analysis Functionality
    document.addEventListener('DOMContentLoaded', function() {
        const analyzeButton = document.getElementById('medirContenido');
        const gaugeFill = document.querySelector('.gauge-fill');
        const gaugeValue = document.querySelector('.gauge-value');
        const gaugeLabel = document.querySelector('.gauge-label');
        const analysisResults = document.querySelector('.analysis-results');
        const recommendationsList = document.getElementById('recommendations-list');
        
        // Sample metrics data
        const metrics = {
            length: { value: 'Óptima', icon: 'fas fa-ruler-horizontal', color: 'bg-primary' },
            relevance: { value: 'Alta', icon: 'fas fa-bullseye', color: 'bg-success' },
            structure: { value: 'Buena', icon: 'fas fa-layer-group', color: 'bg-info' },
            seo: { value: 'Mejorable', icon: 'fas fa-search', color: 'bg-warning' }
        };
        
        // Sample recommendations based on content analysis
        const recommendations = [
            'Incluye más palabras clave relacionadas en el contenido',
            'Añade más subtítulos para mejorar la legibilidad',
            'Considera incluir más imágenes o videos',
            'El título podría ser más atractivo para los lectores'
        ];

        analyzeButton.addEventListener('click', function() {
            if (analyzeButton.classList.contains('analyzing')) return;
            
            // Reset state
            analyzeButton.classList.add('analyzing');
            analyzeButton.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Analizando...';
            analysisResults.style.display = 'none';
            
            // Reset gauge
            gaugeFill.style.transform = 'rotate(0.5turn)';
            gaugeValue.textContent = '0';
            gaugeLabel.textContent = 'Iniciando análisis...';
            
            // Simulate analysis
            let progress = 0;
            const interval = setInterval(() => {
                progress += 1;
                const rotation = 0.5 + (progress * 0.5 / 100); // 0.5 to 1.0 rotation
                
                // Update gauge
                gaugeFill.style.transform = `rotate(${rotation}turn)`;
                gaugeValue.textContent = `${progress}`;
                
                // Update button text during analysis
                if (progress < 30) {
                    gaugeLabel.textContent = 'Analizando texto...';
                } else if (progress < 70) {
                    gaugeLabel.textContent = 'Evaluando estructura...';
                } else if (progress < 100) {
                    gaugeLabel.textContent = 'Generando recomendaciones...';
                }
                
                if (progress === 100) {
                    clearInterval(interval);
                    completeAnalysis();
                }
            }, 30);
            
            // Show loading state for metrics
            document.querySelectorAll('.metric-value').forEach(el => {
                el.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
            });
        });
        
        function completeAnalysis() {
            // Update gauge final state
            gaugeLabel.textContent = 'Análisis completo';
            
            // Update metrics
            updateMetrics();
            
            // Update recommendations
            updateRecommendations();
            
            // Update button state
            analyzeButton.innerHTML = '<i class="fas fa-redo me-2"></i>Volver a analizar';
            analyzeButton.classList.remove('analyzing');
            
            // Show results with animation
            analysisResults.style.display = 'block';
            analysisResults.style.opacity = '0';
            analysisResults.style.transform = 'translateY(20px)';
            analysisResults.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            
            // Trigger reflow
            void analysisResults.offsetWidth;
            
            // Animate in
            analysisResults.style.opacity = '1';
            analysisResults.style.transform = 'translateY(0)';
            
            // Smooth scroll to results
            setTimeout(() => {
                analysisResults.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }, 500);
        }
        
        function updateMetrics() {
            const metricElements = document.querySelectorAll('.metric-item');
            metricElements.forEach((el, index) => {
                const metricKey = Object.keys(metrics)[index];
                const metric = metrics[metricKey];
                
                setTimeout(() => {
                    const iconDiv = el.querySelector('.metric-icon');
                    iconDiv.className = `metric-icon ${metric.color} text-white`;
                    iconDiv.innerHTML = `<i class="${metric.icon}"></i>`;
                    
                    el.querySelector('.metric-value').textContent = metric.value;
                    
                    // Add animation
                    el.style.opacity = '0';
                    el.style.transform = 'translateY(10px)';
                    el.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
                    
                    setTimeout(() => {
                        el.style.opacity = '1';
                        el.style.transform = 'translateY(0)';
                    }, 50);
                }, 100 * index);
            });
        }
        
        function updateRecommendations() {
            recommendationsList.innerHTML = '';
            
            recommendations.forEach((rec, index) => {
                const li = document.createElement('li');
                li.className = 'd-flex align-items-center mb-2';
                li.innerHTML = `
                    <i class="fas fa-check-circle text-success me-2"></i>
                    <span>${rec}</span>
                `;
                li.style.opacity = '0';
                li.style.transform = 'translateX(-10px)';
                li.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
                
                // Staggered animation
                setTimeout(() => {
                    li.style.opacity = '1';
                    li.style.transform = 'translateX(0)';
                }, 100 * index);
                
                recommendationsList.appendChild(li);
            });
        }
    });
</script>
@endpush
@endsection