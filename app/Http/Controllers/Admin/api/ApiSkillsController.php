<?php

namespace App\Http\Controllers\Admin\api;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\Request;

class ApiSkillsController extends Controller
{
    // ترجع كل المهارات
    public function index()
    {
        return response()->json(Skill::where('is_active', 1)->get(), 200);
    }

    // ترجع مهارة واحدة حسب ID
    public function show($id)
    {
        $skill = Skill::find($id);

        if (!$skill) {
            return response()->json(['message' => 'Skill not found'], 404);
        }

        return response()->json($skill, 200);
    }
}
