<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\ChatbotLog;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ChatbotController extends Controller
{
    protected $apiKey;
    protected $apiUrl = 'https://openrouter.ai/api/v1/chat/completions';
    protected $model = 'deepseek/deepseek-chat:free';
    protected $catalogPath;

    public function __construct()
    {
        $this->apiKey = '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';
        $this->catalogPath = public_path('catalogo.txt');
    }

    public function metrics()
    {
        // Métricas básicas
        $totalInteracciones = ChatbotLog::count();
        $interaccionesHoy = ChatbotLog::whereDate('created_at', Carbon::today())->count();
        $preguntasUnicas = ChatbotLog::distinct('pregunta')->count('pregunta');

        // Obtener registros del chatbot paginados (10 por página)
        $chatbotLogs = ChatbotLog::with('trabajador')
            ->orderByDesc('created_at')
            ->paginate(10);

        // Preguntas frecuentes con tendencia
        $preguntasFrecuentes = ChatbotLog::select(
            'pregunta',
            DB::raw('count(*) as total'),
            DB::raw('count(case when created_at >= ? then 1 end) as recientes')
        )
            ->addBinding(Carbon::now()->subDays(7), 'select')
            ->groupBy('pregunta')
            ->orderByDesc('total')
            ->limit(5)
            ->get()
            ->map(function($item) {
                $tendencia = $item->total > 0 ? ($item->recientes / $item->total) * 100 : 0;
                return [
                    'pregunta' => $item->pregunta,
                    'total' => $item->total,
                    'tendencia' => round($tendencia)
                ];
            });

        // Interacciones por usuario con última actividad
        $interaccionesPorUsuario = ChatbotLog::select(
            'trabajador_id',
            DB::raw('count(*) as total'),
            DB::raw('MAX(created_at) as ultima_actividad')
        )
            ->groupBy('trabajador_id')
            ->orderByDesc('total')
            ->get()
            ->map(function($item) {
                return [
                    'trabajador_id' => $item->trabajador_id,
                    'total' => $item->total,
                    'ultima_actividad' => Carbon::parse($item->ultima_actividad)->diffForHumans()
                ];
            });

        // Estadísticas adicionales
        $tiempoPromedioRespuesta = ChatbotLog::select(
            DB::raw('AVG(EXTRACT(EPOCH FROM (updated_at - created_at))) as promedio')
        )->first()->promedio ?? 0;

        return view('dashboard.chatbot-metrics', compact(
            'totalInteracciones',
            'interaccionesHoy',
            'preguntasUnicas',
            'preguntasFrecuentes',
            'interaccionesPorUsuario',
            'tiempoPromedioRespuesta',
            'chatbotLogs'
        ));
    }

    public function chat(Request $request)
    {
        try {
            $userMessage = $request->input('message');
            $catalogContent = file_get_contents($this->catalogPath);

            $systemMessage = "Eres un asistente farmacéutico, tu nombre es DrodiBot. Utiliza solo la información del siguiente catálogo para responder preguntas y no respondas lo mismo siempre, intenta tener una personalidad alegre con emojis y no uses respuestas tan largas. Si la información solicitada no está en el catálogo, indica que no tienes esa información. Catálogo:\n" . $catalogContent;

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'HTTP-Referer' => config('app.url'),
                'Content-Type' => 'application/json',
            ])->post($this->apiUrl, [
                'model' => $this->model,
                'messages' => [
                    ['role' => 'system', 'content' => $systemMessage],
                    ['role' => 'user', 'content' => $userMessage]
                ]
            ]);

            if ($response->successful()) {
                $result = $response->json();
                return response()->json([
                    'success' => true,
                    'message' => $result['choices'][0]['message']['content'] ?? 'Lo siento, no pude procesar tu mensaje.'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Error al procesar la solicitud.'
                ], 500);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error del servidor: ' . $e->getMessage()
            ], 500);
        }
    }
}