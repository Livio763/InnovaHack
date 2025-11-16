<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Mission;
use App\Models\Module;
use Illuminate\Http\Request;

class MissionController extends Controller
{
    public function index(Request $request)
    {
        $modules = Module::with(['missions' => function ($query) use ($request) {
            $query->where('is_active', true);
            
            if ($request->user()) {
                $query->with(['progress' => function ($q) use ($request) {
                    $q->where('user_id', $request->user()->id);
                }]);
            }
        }])
        ->where('is_active', true)
        ->orderBy('order')
        ->get();

        return response()->json($modules);
    }

    public function show($id)
    {
        $mission = Mission::with('module')->findOrFail($id);
        
        if (auth()->check()) {
            $mission->load(['progress' => function ($q) {
                $q->where('user_id', auth()->id());
            }]);
        }

        return response()->json($mission);
    }

    public function submit(Request $request, $id)
    {
        $mission = Mission::findOrFail($id);
        
        $validated = $request->validate([
            'type' => 'required|in:photo,video,text,file',
            'content' => 'nullable|string',
            'file' => 'nullable|file|max:10240',
        ]);

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('submissions', 'public');
        }

        $submission = $request->user()->submissions()->create([
            'mission_id' => $mission->id,
            'type' => $validated['type'],
            'content' => $validated['content'] ?? null,
            'file_path' => $filePath,
            'status' => 'pending',
        ]);

        return response()->json($submission, 201);
    }
}
