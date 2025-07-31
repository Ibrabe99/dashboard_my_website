<?php

namespace App\Http\Controllers\Admin;

use Alkoumi\LaravelHijriDate\Hijri;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectsRequest;
use App\Models\Category;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\ProjectImage;
use Illuminate\Support\Facades\Storage;

class ProjectsController extends Controller
{

    public function index()
    {
        $projects = Project::with('category')->latest()->paginate(10);
        $categories = Category::where('is_active', 1)->get();


        return view('admin.projects.projects', compact('projects', 'categories'));
    }


    public function store(ProjectsRequest $request)
    {
        $data = $request->validated();

        // توليد slug فريد من العنوان
        $data['slug'] = Str::slug($data['title']) . '-' . uniqid();

        // إذا فيه صورة رئيسية واحدة (اختياري)
        if ($request->hasFile('image')) {
            $data['image'] = uploadImage('projects', $request->file('image'));
        }
        $hijriDate = Hijri::Date('Y-m-d' . ' هـ');
        $hijriDay = Hijri::Date('l');
        $date = date('Y-m-d');
        $time = date('H:i:s');


        $project = Project::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'slug' => $data['slug'],
            'hijri_date' => $hijriDate,
            'day' => $hijriDay,
            'date' => $date,
            'time' => $time,
            'live_link' => $data['live_link'],
            'github_link' => $data['github_link'],
            'category_id' => $data['category_id'],
            'image' => $data['image'] ?? null,
        ]);


        if ($request->hasFile('image')) {
            $data['image'] = uploadImage('articles', $request->file('image'));
        }
        // حفظ الصور الإضافية
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = uploadImage('projects', $image);

                ProjectImage::create([
                    'project_id' => $project->id,
                    'path' => $path
                ]);
            }
        }

        return redirect()->route('admin.projects')->with('success', 'تم إضافة المشروع بنجاح.');
    }


    public function edit($id)
    {
        $project = Project::findOrFail($id);
        $categories = Category::where('is_active', 1)->get();
        return view('admin.projects.projects_edit', compact('project', 'categories'));
    }


    public function update(ProjectsRequest $request, Project $project)
    {


        $data = $request->validated();

        // إنشاء slug جديد إذا تغير العنوان
        if ($project->title !== $data['title']) {
            $data['slug'] = Str::slug($data['title']) . '-' . uniqid();
        } else {
            $data['slug'] = $project->slug;
        }

        if ($request->has('delete_images')) {
            foreach ($request->delete_images as $imageId) {
                $image = ProjectImage::find($imageId);
                if ($image) {
                    Storage::delete($image->path); // حذف الصورة من التخزين
                    $image->delete(); // حذف من قاعدة البيانات
                }
            }
        }

        // تعديل الصورة الرئيسية إن وُجدت
        if ($request->hasFile('image')) {
            $data['image'] = uploadImage('projects', $request->file('image'));
        }

        // تعديل بيانات المشروع
        $project->update([
            'title' => $data['title'],
            'description' => $data['description'],
            'slug' => $data['slug'],
            'live_link' => $data['live_link'],
            'github_link' => $data['github_link'],
            'category_id' => $data['category_id'],
            'image' => $data['image'] ?? $project->image,
        ]);


        // حذف الصور القديمة لو فيه طلب حذف
        if ($request->has('delete_images')) {
            foreach ($request->input('delete_images') as $imageId) {
                $image = ProjectImage::find($imageId);
                if ($image) {
                    Storage::delete($image->path);
                    $image->delete();
                }
            }
        }

        // إضافة صور جديدة إن وُجدت
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = uploadImage('projects', $image);

                ProjectImage::create([
                    'project_id' => $project->id,
                    'path' => $path
                ]);
            }
        }

        return redirect()->route('admin.projects')->with('success', 'تم تعديل المشروع بنجاح.');
    }


    public function destroy($id)
    {
        $project = Project::findOrFail($id);

        // حذف الصور المرتبطة بالمشروع من التخزين
        foreach ($project->images as $image) {
            Storage::delete($image->path);
            $image->delete();
        }

        // حذف الصورة الرئيسية إن وجدت
        if ($project->image) {
            Storage::delete($project->image);
        }

        // حذف المشروع نفسه
        $project->delete();

        return redirect()->route('admin.projects')->with('success', 'تم حذف المشروع بنجاح.');
    }


    public function toggleStatus($id)
    {
        $project = Project::findOrFail($id);
        $project->is_active = !$project->is_active;
        $project->save();

        return back()->with('success', 'تم تغيير حالة المشروع.');
    }


    public function show($id)
    {
        $project = Project::with('images')->findOrFail($id);
        return view('admin.projects.porjects_show', compact('project'));
    }


}
