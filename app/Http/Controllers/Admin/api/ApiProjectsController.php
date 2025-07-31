<?php

namespace App\Http\Controllers\Admin\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectsRequest;
use App\Models\Project;
use Illuminate\Http\Request;

class ApiProjectsController extends Controller
{
    public function index()
    {
        $projects = Project::with('category') // تحميل القسم مع المشروع
        ->where('is_active', 1)
            ->get();

        $formatted = $projects->map(function ($project) {
            // نحول كل بيانات المشروع إلى مصفوفة
            $data = $project->toArray();

            // نضيف عليها اسم القسم
            $data['category_name'] = $project->category->name ?? 'غير معروف';


            return $data;
        });

        return response()->json($formatted, 200);
    }

// في ApiProjectsController.php (كمثال)
    public function updateStats(Request $request, $id)
    {
        $action = $request->input('action');

        $project = Project::find($id);
        if (!$project) {
            return response()->json(['message' => 'Project not found'], 404);
        }

        if ($action === 'view') {
            $project->views = $project->views + 1;
        } elseif ($action === 'like') {
            $project->likes = $project->likes + 1;
        } else {
            return response()->json(['message' => 'Invalid action'], 400);
        }

        $project->save();

        return response()->json(['views' => $project->views, 'likes' => $project->likes]);
    }



    public function show($id)
    {
        $project = Project::with('images', 'category')->findOrFail($id);
        return response()->json($project);
    }



}
