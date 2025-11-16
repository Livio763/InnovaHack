<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ChatHistory;
use App\Services\GroqService;
use Illuminate\Http\Request;

class AssistantController extends Controller
{
    protected GroqService $groqService;

    public function __construct(GroqService $groqService)
    {
        $this->groqService = $groqService;
    }

    /**
     * Endpoint principal de chat
     */
    public function chat(Request $request)
    {
        $validated = $request->validate([
            'message' => 'required|string|max:1000',
            'context' => 'nullable|string|max:255',
        ]);

        $user = $request->user();
        $message = $validated['message'];
        $context = $validated['context'] ?? 'general';

        // Construir prompt con contexto del usuario
        $systemPrompt = $this->buildSystemPrompt($user, $context);

        // Obtener respuesta de Groq
        $response = $this->groqService->chat($systemPrompt, $message);

        // Guardar conversación en historial
        ChatHistory::create([
            'user_id' => $user->id,
            'message' => $message,
            'response' => $response,
            'context' => $context,
        ]);

        return response()->json([
            'response' => $response,
            'context' => $context,
        ]);
    }

    /**
     * Generar saludo personalizado al entrar
     */
    public function greeting(Request $request)
    {
        $user = $request->user();
        $context = $request->input('context', 'dashboard');

        $levelMap = [
            'pre' => 'Pre-incubación',
            'incubadora' => 'Incubadora',
            'pending' => 'en evaluación'
        ];

        $levelName = $levelMap[$user->level] ?? 'Emprendedor';
        $firstName = explode(' ', $user->name)[0];

        $greeting = $this->groqService->generateGreeting($firstName, $levelName, $context);

        return response()->json([
            'greeting' => $greeting,
            'user' => $firstName,
        ]);
    }

    /**
     * Construir prompt del sistema con contexto
     */
    private function buildSystemPrompt($user, $context): string
    {
        $firstName = explode(' ', $user->name)[0];
        $levelMap = [
            'pre' => 'Pre-incubación (validación de idea)',
            'incubadora' => 'Incubadora (crecimiento de negocio)',
            'pending' => 'en proceso de evaluación'
        ];
        $levelDesc = $levelMap[$user->level] ?? 'emprendedor';

        $basePrompt = "Eres GIA, el asistente virtual de ChildFund Bolivia especializado en emprendimiento.

Información del usuario:
- Nombre: {$firstName}
- Nivel: {$levelDesc}
- Puntos: {$user->total_points}
- Contexto actual: {$context}

Tu misión:
- Responder de forma amigable, breve (máximo 3-4 líneas) y práctica
- Motivar al usuario a seguir aprendiendo
- Si pregunta sobre un video/misión, dar consejos aplicables
- Si pide resumen, ser conciso y estructurado
- Usar emojis ocasionales para hacer la conversación más cercana

Tono: Amigable, motivador, profesional pero cercano.";

        // Agregar contexto específico según la página
        if (str_starts_with($context, 'mission:')) {
            $basePrompt .= "\n\nEl usuario está trabajando en una misión específica. Ayúdalo a entender el contenido y aplicarlo a su emprendimiento.";
        } elseif ($context === 'modules') {
            $basePrompt .= "\n\nEl usuario está viendo sus módulos de aprendizaje. Motívalo a completar el siguiente paso.";
        }

        return $basePrompt;
    }
}
