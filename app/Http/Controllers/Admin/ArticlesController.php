<?php

namespace App\Http\Controllers\Admin;

use Alkoumi\LaravelHijriDate\Hijri;
use App\Http\Controllers\Controller;
use App\Http\Requests\ArticlesRequest;
use App\Models\Article;
use App\Models\Category;
use Cassandra\Date;
use Illuminate\Support\Str;
use App\Models\ArticlesImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticlesController extends Controller
{
    // عرض جميع المقالات مع تصنيفاتها
    public function index()
    {
        $articles = Article::with('category')->latest()->paginate(15);
        $categories = Category::where('is_active', 1)->get();

        return view('admin.articles.article', compact('articles', 'categories'));
    }


    public function store(ArticlesRequest $request)
    {
        $data = $request->validated();

        // توليد slug فريد من العنوان
        $data['slug'] = Str::slug($data['title']) . '-' . uniqid();

        // إذا فيه صورة رئيسية واحدة (اختياري)
        if ($request->hasFile('image')) {
            $data['image'] = uploadImage('articles', $request->file('image'));
        }

        $hijriDate = Hijri::Date('Y-m-d');
        $hijriDay = Hijri::Date('l');
        $date = date('Y-m-d');
        $time = date('H:i:s');

        // إنشاء المشروع
        $article = Article::create([
            'title' => $data['title'],
            'content' => $data['content'],
            'slug' => $data['slug'],
            'hijri_date' => $hijriDate,
            'day' => $hijriDay,
            'date' => $date,
            'time' => $time,
            'category_id' => $data['category_id'],
            'image' => $data['image'] ?? null, // لو موجودة
        ]);


        if ($request->hasFile('image')) {
            $data['image'] = uploadImage('articles', $request->file('image'));
        }
        // حفظ الصور الإضافية
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = uploadImage('article', $image);

                ArticlesImage::create([
                    'article_id' => $article->id,
                    'path' => $path
                ]);
            }
        }


        return redirect()->route('admin.articles')->with('success', 'تم إضافة المشروع بنجاح.');
    }


    // عرض نموذج تعديل مقال
    public function edit($id)
    {
        $article = Article::findOrFail($id);
        $categories = Category::where('is_active', 1)->get();
        return view('admin.articles.article_edit', compact('article', 'categories'));
    }

    public function update(ArticlesRequest $request, Article $article)
    {
        $data = $request->validated();

        // تعديل slug فقط إذا تغير العنوان
        if ($article->title !== $data['title']) {
            $data['slug'] = Str::slug($data['title']) . '-' . uniqid();
        } else {
            $data['slug'] = $article->slug;
        }


        // حذف الصور المحددة من المستخدم
        if ($request->has('delete_images')) {
            foreach ($request->delete_images as $imageId) {
                $image = ArticlesImage::find($imageId);
                if ($image) {
                    Storage::delete($image->path); // حذف الصورة من التخزين
                    $image->delete(); // حذف من قاعدة البيانات
                }
            }
        }


        // تحديث الصورة الرئيسية إذا تم رفع صورة جديدة
        if ($request->hasFile('image')) {
            $data['image'] = uploadImage('articles', $request->file('image'));
        }

        // تعديل المقال
        $article->update([
            'title' => $data['title'],
            'content' => $data['content'],
            'slug' => $data['slug'],
            'category_id' => $data['category_id'],
            'image' => $data['image'] ?? $article->image,
        ]);



        // إضافة صور جديدة
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = uploadImage('article', $image);

                ArticlesImage::create([
                    'article_id' => $article->id,
                    'path' => $path
                ]);
            }
        }

        return redirect()->route('admin.articles')->with('success', 'تم تعديل المقال بنجاح.');
    }


    // حذف مقال
    public function destroy($id)
    {
        $article = Article::findOrFail($id);

        // حذف الصور الإضافية
        foreach ($article->images as $image) {
            Storage::delete($image->path);
            $image->delete();
        }

        // حذف الصورة الرئيسية إن وجدت
        if ($article->image) {
            Storage::delete($article->image);
        }

        // حذف المقالة
        $article->delete();

        return redirect()->route('admin.articles')->with('success', 'تم حذف المقالة بنجاح.');
    }


    public function toggleStatus($id)
{
    $project = Article::findOrFail($id);
    $project->is_active = !$project->is_active;
    $project->save();

    return back()->with('success', 'تم تغيير حالة المشروع.');
}

public function show($id)
{
    $article = Article::with('images')->findOrFail($id);
    return view('admin.articles.article_show', compact('article'));
}


}
