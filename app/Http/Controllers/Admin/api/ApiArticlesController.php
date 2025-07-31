<?php

namespace App\Http\Controllers\Admin\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticlesRequest;
use App\Models\Article;
use Illuminate\Http\Request;

class ApiArticlesController extends Controller
{
    public function index()
    {
        $articles = Article::with('category') // تحميل القسم مع المقال
        ->where('is_active', 1)
            ->get();

        $formatted = $articles->map(function ($article) {
            // نحول كل بيانات المقال إلى مصفوفة
            $data = $article->toArray();

            // نضيف عليها اسم القسم
            $data['category_name'] = $article->category->name ?? 'غير معروف';

            return $data;
        });

        return response()->json($formatted, 200);
    }

    public function updateStats(Request $request, $id)
    {
        $action = $request->input('action');

        $article = Article::find($id);
        if (!$article) {
            return response()->json(['message' => 'Article not found'], 404);
        }

        if ($action === 'view') {
            $article->views = $article->views + 1;
        } elseif ($action === 'like') {
            $article->likes = $article->likes + 1;
        } else {
            return response()->json(['message' => 'Invalid action'], 400);
        }

        $article->save();

        return response()->json(['views' => $article->views, 'likes' => $article->likes]);
    }


    public function show($id)
    {
        $article = Article::with('images')->findOrFail($id);
        return response()->json($article);
    }



}
