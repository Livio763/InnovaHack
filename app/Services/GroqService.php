<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GroqService
{
    private string $apiKey;
    private string $apiUrl = 'https://api.groq.com/openai/v1/chat/completions';
    private string $model; // Modelo principal configurable
    private array $fallbackModels = [
        'llama-3.1-70b',
        'llama-3.1-8b-instant',
    ];

    public function __construct()
    {
        $this->apiKey = env('GROQ_API_KEY', '');
        // Permitimos configurar el modelo por .env y damos un default actualizado
        $this->model = env('GROQ_MODEL', 'llama-3.1-70b');
    }

    /**
     * Enviar mensaje a Groq y obtener respuesta
     */
    public function chat(string $systemPrompt, string $userMessage): string
    {
        if (empty($this->apiKey)) {
            return "⚠️ API key no configurada. Agrega GROQ_API_KEY en tu archivo .env";
        }

        $modelsToTry = array_unique(array_merge([$this->model], $this->fallbackModels));

        foreach ($modelsToTry as $model) {
            try {
                $response = Http::withHeaders([
                    'Authorization' => 'Bearer ' . $this->apiKey,
                    'Content-Type' => 'application/json',
                ])->timeout(30)->post($this->apiUrl, [
                    'model' => $model,
                    'messages' => [
                        [
                            'role' => 'system',
                            'content' => $systemPrompt
                        ],
                        [
                            'role' => 'user',
                            'content' => $userMessage
                        ]
                    ],
                    'temperature' => 0.7,
                    'max_tokens' => 500,
                ]);

                if ($response->successful()) {
                    $data = $response->json();
                    return $data['choices'][0]['message']['content'] ?? 'Sin respuesta';
                }

                // Si falla, registramos y probamos siguiente modelo si aplica
                $body = $response->body();
                Log::error('Groq API error', ['model' => $model, 'response' => $body, 'status' => $response->status()]);

                // Si es un error de modelo deprecado o inexistente, intentar siguiente
                $shouldTryNext = false;
                try {
                    $err = $response->json('error.code');
                    if (in_array($err, ['model_decommissioned', 'model_not_found'])) {
                        $shouldTryNext = true;
                    }
                } catch (\Throwable $t) {
                    $shouldTryNext = false;
                }

                if (!$shouldTryNext) {
                    break; // errores distintos: salimos
                }
            } catch (\Exception $e) {
                Log::error('Groq API exception', ['model' => $model, 'error' => $e->getMessage()]);
                // si es el último intento, devolvemos el genérico
                continue;
            }
        }

        return "Lo siento, tuve un problema al procesar tu mensaje. Intenta de nuevo.";
    }

    /**
     * Generar saludo personalizado
     */
    public function generateGreeting(string $userName, string $userLevel, string $context): string
    {
        $systemPrompt = "Eres GIA, el asistente virtual de ChildFund Bolivia. Eres amigable, motivador y conciso.";
        
        $userMessage = "Genera un saludo breve y personalizado para {$userName}, nivel {$userLevel}, que está en {$context}. Máximo 2 líneas.";

        return $this->chat($systemPrompt, $userMessage);
    }
}
