<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function updateLevel(Request $request)
    {
        $validated = $request->validate([
            'level' => 'required|in:pre,incubadora,pending',
            // Puede venir como string (idea/negocio) o entero (1..10)
            'diagnostic_option' => 'nullable',
            'stage' => 'nullable|in:P,I',
        ]);

        $updateData = ['level' => $validated['level']];

        if (array_key_exists('diagnostic_option', $validated)) {
            $diag = $validated['diagnostic_option'];
            if (is_string($diag)) {
                $diagLower = strtolower($diag);
                // Mapear valores de texto a códigos numéricos existentes en la DB
                // 1 = idea, 2 = negocio (ajustable si defines más opciones)
                $mapped = match ($diagLower) {
                    'idea' => 1,
                    'negocio' => 2,
                    default => null,
                };
                if (!is_null($mapped)) {
                    $updateData['diagnostic_option'] = $mapped;
                }
            } elseif (is_numeric($diag)) {
                $updateData['diagnostic_option'] = (int)$diag;
            }
        }
        if (isset($validated['stage'])) {
            $updateData['stage'] = $validated['stage'];
        }

        $request->user()->update($updateData);

        return response()->json($request->user());
    }

    public function updateDiagnostic(Request $request)
    {
        $validated = $request->validate([
            'diagnostic_option' => 'required|integer|min:1|max:10',
        ]);

        $request->user()->update([
            'diagnostic_option' => $validated['diagnostic_option'],
        ]);

        return response()->json($request->user());
    }

    public function stats(Request $request)
    {
        $user = $request->user();
        
        return response()->json([
            'total_points' => $user->total_points,
            'total_badges' => $user->badges()->count(),
            'missions_completed' => $user->progress()->where('status', 'completed')->count(),
            'missions_in_progress' => $user->progress()->where('status', 'in_progress')->count(),
        ]);
    }
}
