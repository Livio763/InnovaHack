<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Mission;
use App\Models\UserProgress;
use App\Models\Badge;
use Illuminate\Http\Request;

class ProgressController extends Controller
{
    public function index(Request $request)
    {
        $progress = $request->user()
            ->progress()
            ->with('mission')
            ->get();

        return response()->json($progress);
    }

    public function complete(Request $request, $missionId)
    {
        $mission = Mission::findOrFail($missionId);
        $user = $request->user();

        $existing = UserProgress::where('user_id', $user->id)
            ->where('mission_id', $mission->id)
            ->first();

        if ($existing && $existing->status === 'completed') {
            return response()->json([
                'message' => 'Misión ya completada',
                'progress' => $existing
            ]);
        }

        $progress = UserProgress::updateOrCreate(
            [
                'user_id' => $user->id,
                'mission_id' => $mission->id,
            ],
            [
                'status' => 'completed',
                'points_earned' => $mission->points,
                'completed_at' => now(),
            ]
        );

        $user->increment('total_points', $mission->points);

        if ($mission->badge_name && $mission->badge_icon) {
            Badge::firstOrCreate([
                'user_id' => $user->id,
                'mission_id' => $mission->id,
            ], [
                'name' => $mission->badge_name,
                'icon' => $mission->badge_icon,
            ]);
        }

        return response()->json([
            'message' => 'Misión completada',
            'progress' => $progress,
            'points_earned' => $mission->points,
            'total_points' => $user->total_points,
        ]);
    }

    public function updateStatus(Request $request, $missionId)
    {
        $validated = $request->validate([
            'status' => 'required|in:not_started,in_progress,completed',
        ]);

        $progress = UserProgress::updateOrCreate(
            [
                'user_id' => $request->user()->id,
                'mission_id' => $missionId,
            ],
            [
                'status' => $validated['status'],
            ]
        );

        return response()->json($progress);
    }
}
