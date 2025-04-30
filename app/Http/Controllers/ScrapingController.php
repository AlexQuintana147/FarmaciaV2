<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ScrapingController extends Controller
{
    /**
     * Endpoint para autogenerar descripción usando humata_scraper.py
     */
    public function autogenerarDescripcion(Request $request)
    {
        Log::info('[SCRAPING] Petición recibida', $request->all());
        $request->validate([
            'titulo' => 'required|string|min:3',
        ]);
        $titulo = $request->input('titulo');
        Log::info('[SCRAPING] Título recibido', ['titulo' => $titulo]);
        $output = null;
        $return_var = null;
        $pythonCmd = strtoupper(substr(PHP_OS, 0, 3)) === 'WIN' ? 'python' : 'python3';
        $scriptPath = base_path('HumataScraping/humata_scraper.py');
        $command = escapeshellcmd("$pythonCmd \"$scriptPath\" " . escapeshellarg($titulo));
        Log::info('[SCRAPING] Ejecutando comando', ['command' => $command]);
        exec($command . ' 2>&1', $output, $return_var);
        Log::info('[SCRAPING] Salida', ['output' => $output, 'return_var' => $return_var]);
        if ($return_var !== 0 || empty($output)) {
            Log::error('[SCRAPING] Error ejecutando script', ['output' => $output, 'return_var' => $return_var]);
            $errorMsg = !empty($output) ? implode("\n", $output) : 'No se pudo generar la descripción.';
            return response()->json(['error' => $errorMsg], 500);
        }
        $descripcion = implode("\n", $output);
        $descripcion = mb_convert_encoding($descripcion, 'UTF-8', 'auto');
        Log::info('[SCRAPING] Descripción generada', ['descripcion' => $descripcion]);
        return response()->json(['descripcion' => $descripcion]);
    }
}
