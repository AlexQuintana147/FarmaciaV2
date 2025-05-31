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
        
        // Log controller initialization
        if (Auth::check()) {
            Log::debug('BlogMedidaController initialized', [
                'auth_user' => Auth::id(),
                'is_ajax' => request()->ajax(),
                'path' => request()->path()
            ]);
        } else {
            Log::debug('BlogMedidaController initialized - No authenticated user', [
                'is_ajax' => request()->ajax(),
                'path' => request()->path()
            ]);
        }
    }
    
    /**
     * Evaluate content quality via AJAX
     */
    public function evaluateContent(Request $request)
    {
        // Log the raw input for debugging
        Log::info('Raw input:', ['input' => $request->getContent()]);
        
        Log::info('evaluateContent called', [
            'request_data' => $request->all(),
            'is_ajax' => $request->ajax(),
            'wants_json' => $request->wantsJson(),
            'content_type' => $request->header('Content-Type'),
            'headers' => $request->headers->all()
        ]);

        try {
            // Validate request
            $validated = $request->validate([
                'titulo' => 'required|string|max:255',
                'contenido' => 'required|string',
            ]);
            
            Log::info('Validation passed', [
                'titulo_length' => strlen($validated['titulo']), 
                'contenido_length' => strlen($validated['contenido'])
            ]);
            
            // For testing, return a fixed response first
            return response()->json([
                'success' => true,
                'puntuacion' => 85,
                'message' => 'Prueba exitosa. Conexión establecida correctamente.',
                'class' => 'text-success'
            ]);
            
            
        } catch (\Exception $e) {
            Log::error('Error in evaluateContent', [
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->all()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Error al evaluar el contenido: ' . $e->getMessage(),
                'debug' => [
                    'exception' => get_class($e),
                    'file' => $e->getFile() . ':' . $e->getLine()
                ]
            ], 500);
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
