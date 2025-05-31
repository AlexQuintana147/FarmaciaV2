<?php

namespace App\Http\Controllers;

use App\Models\BlogMedida;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class BlogMedidaController extends Controller
{
    protected $apiKey;
    protected $apiUrl = 'https://openrouter.ai/api/v1/chat/completions';
    protected $model = 'deepseek/deepseek-chat:free';

    public function __construct()
    {
        $this->middleware('auth');
        $this->apiKey = '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';
    }
    
    /**
     * Evaluate content quality via AJAX
     */
    public function evaluateContent(Request $request)
    {
        try {
            // Log the incoming request
            Log::info('evaluateContent request:', [
                'all' => $request->all(),
                'headers' => $request->headers->all(),
                'ajax' => $request->ajax(),
                'wantsJson' => $request->wantsJson()
            ]);

            // Validate request with minimum length
            $validated = $request->validate([
                'titulo' => 'required|string|min:3|max:255',
                'contenido' => 'required|string|min:3',
            ], [
                'titulo.min' => 'El título debe tener al menos 3 caracteres.',
                'contenido.min' => 'El contenido debe tener al menos 3 caracteres.'
            ]);
            
            // Log validation passed
            Log::info('Validation passed', $validated);
            
            // Prepare the prompt for content analysis
            $prompt = "Analiza el siguiente título y contenido de blog:\n\n"
                   . "Título: " . $validated['titulo'] . "\n\n"
                   . "Contenido: " . $validated['contenido'] . "\n\n"
                   . "Proporciona un análisis detallado que incluya:\n"
                   . "1. Un porcentaje de calidad general (0-100)\n"
                   . "2. Puntos fuertes del contenido\n"
                   . "3. Áreas de mejora\n"
                   . "4. Recomendaciones específicas para mejorar el SEO\n"
                   . "5. Sugerencias para aumentar el engagement\n"
                   . "Formato la respuesta en JSON con las claves: 'puntuacion', 'fortalezas' (array), 'mejoras' (array), 'recomendaciones_seo' (array), 'sugerencias_engagement' (array)";
                   
            // Log the prompt being sent
            Log::info('Sending prompt to API', ['prompt_length' => strlen($prompt)]);
            
            // Make API call to OpenRouter
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'HTTP-Referer' => config('app.url'),
                'Content-Type' => 'application/json',
            ])->post($this->apiUrl, [
                'model' => $this->model,
                'messages' => [
                    ['role' => 'system', 'content' => 'Eres un experto en análisis de contenido y SEO. Proporciona un análisis detallado en formato JSON.'],
                    ['role' => 'user', 'content' => $prompt]
                ],
                'temperature' => 0.7,
                'max_tokens' => 1500
            ]);

            if ($response->successful()) {
                $result = $response->json();
                $analysis = json_decode(trim($result['choices'][0]['message']['content']), true);
                
                if (json_last_error() !== JSON_ERROR_NONE) {
                    throw new \Exception('Error al analizar la respuesta de la API');
                }
                
                // Ensure score is between 0 and 100
                $score = max(0, min(100, (int)($analysis['puntuacion'] ?? 50)));
                
                return response()->json([
                    'success' => true,
                    'puntuacion' => $score,
                    'fortalezas' => $analysis['fortalezas'] ?? [],
                    'mejoras' => $analysis['mejoras'] ?? [],
                    'recomendaciones_seo' => $analysis['recomendaciones_seo'] ?? [],
                    'sugerencias_engagement' => $analysis['sugerencias_engagement'] ?? [],
                    'message' => $this->getScoreMessage($score),
                    'class' => $this->getScoreClass($score)
                ]);
            }
            
            throw new \Exception('Error en la respuesta de la API');
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error de validación: ' . $e->getMessage(),
                'errors' => $e->errors()
            ], 422);
            
        } catch (\Exception $e) {
            Log::error('Error en BlogMedidaController', [
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Error al procesar la solicitud. Por favor, intente nuevamente.'
            ], 500);
        }
    }
    
    /**
     * Get a message based on similarity score
     */
    protected function getSimilarityMessage($score)
    {
        if ($score < 30) {
            return 'Contenido altamente original. ¡Excelente trabajo!';
        } elseif ($score < 70) {
            return 'Contenido con cierta similitud a otros. Considera hacerlo más único.';
        } else {
            return 'Contenido con alta similitud a otros. Se recomienda revisar y modificar.';
        }
    }
    
    /**
     * Get CSS class based on similarity score
     */
    protected function getSimilarityClass($score)
    {
        if ($score < 30) {
            return 'text-success';
        } elseif ($score < 70) {
            return 'text-warning';
        } else {
            return 'text-danger';
        }
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $medidas = BlogMedida::all();
        return view('dashboard.blog_medidas.index', compact('medidas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.blog_medidas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'contenido' => 'required|string',
            'trabajador_id' => 'required|exists:trabajadores,id',
            'id_blog' => 'required|exists:blogs,id',
            'valoracion' => 'nullable|integer|min:0|max:100',
        ]);

        // Calcular puntuación de calidad
        $puntuacion = $this->evaluarCalidadContenido($request->titulo, $request->contenido);
        
        $data = $request->only(['titulo', 'descripcion', 'contenido', 'trabajador_id', 'id_blog', 'valoracion']);
        $data['puntuacion_calidad'] = $puntuacion;

        BlogMedida::create($data);

        return redirect()->route('blog-medidas.index')
            ->with('success', 'Medida creada exitosamente. Puntuación de calidad: ' . $puntuacion . '%');
    }
    
    /**
     * Evalúa la calidad del contenido basado en el título y contenido
     *
     * @param string $titulo
     * @param string $contenido
     * @return int Puntuación de 0 a 100
     */
    protected function evaluarCalidadContenido($titulo, $contenido)
    {
        try {
            $prompt = "Evalúa la calidad del siguiente contenido de blog basándote en su título y contenido. 
            Solo devuelve un número del 0 al 100 que represente el porcentaje de calidad.\n\n" .
            "Título: " . $titulo . "\n\n" .
            "Contenido: " . $contenido . "\n\n" .
            "Solo devuelve el número, sin texto adicional.";

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ])->post($this->apiUrl, [
                'model' => $this->model,
                'messages' => [
                    ['role' => 'user', 'content' => $prompt]
                ],
                'temperature' => 0.3,
                'max_tokens' => 5
            ]);

            $responseData = $response->json();
            $puntuacion = (int) trim($responseData['choices'][0]['message']['content'] ?? '0');
            
            // Asegurarse de que la puntuación esté entre 0 y 100
            return max(0, min(100, $puntuacion));
            
        } catch (\Exception $e) {
            Log::error('Error al evaluar la calidad del contenido: ' . $e->getMessage());
            return 0; // En caso de error, retornar 0
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(BlogMedida $blogMedida)
    {
        return view('dashboard.blog_medidas.show', compact('blogMedida'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BlogMedida $blogMedida)
    {
        return view('dashboard.blog_medidas.edit', compact('blogMedida'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BlogMedida $blogMedida)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'contenido' => 'required|string',
            'trabajador_id' => 'required|exists:trabajadores,id',
            'id_blog' => 'required|exists:blogs,id',
            'valoracion' => 'nullable|integer|min:0|max:100',
        ]);

        // Recalcular puntuación de calidad si el título o contenido cambiaron
        if ($request->titulo !== $blogMedida->titulo || $request->contenido !== $blogMedida->contenido) {
            $puntuacion = $this->evaluarCalidadContenido($request->titulo, $request->contenido);
            $request->merge(['puntuacion_calidad' => $puntuacion]);
        }

        $blogMedida->update($request->only(['titulo', 'descripcion', 'contenido', 'trabajador_id', 'id_blog', 'valoracion', 'puntuacion_calidad']));

        return redirect()->route('blog-medidas.index')
            ->with('success', 'Medida actualizada exitosamente. ' . 
                (isset($puntuacion) ? "Nueva puntuación de calidad: {$puntuacion}%" : ''));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BlogMedida $blogMedida)
    {
        $blogMedida->delete();

        return redirect()->route('blog-medidas.index')
            ->with('success', 'Medida eliminada exitosamente');
    }
}
