<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BadgeController extends Controller
{
    public function index(Request $request)
    {
        $badges = $request->user()
            ->badges()
            ->with('mission')
            ->latest()
            ->get();

        return response()->json($badges);
    }
}
