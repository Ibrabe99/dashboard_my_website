@extends('admin.layouts.dashboard')

@section('content')
    <div class="container">
        <h2>تعديل المشروع</h2>

        @if ($project->image)
            <img src="{{ asset('public/' . $project->image) }}" alt="صورة المشروع" class="img-thumbnail mt-2" width="150">
        @endif

        <form action="{{ route('admin.projects.update', $project->id) }}" method="POST" enctype="multipart/form-data">
            @csrf

            @method('PUT')



            <div class="mb-3">
                <label for="title" class="form-label">العنوان</label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $project->title) }}">
            </div>
            @error('title')
                <p class="text-danger mt-3">{{ $message }}</p>
            @enderror


            <div class="mb-3">
                <label for="description" class="form-label">الوصف</label>
                <textarea name="description" class="form-control">{{ old('description', $project->description) }}</textarea>
            </div>
            @error('description')
                <p class="text-danger mt-3">{{ $message }}</p>
            @enderror


            <div class="mb-3">
                <label for="category_id" class="form-label">التصنيف</label>
                <select name="category_id" class="form-select">
                    <option value="">اختر تصنيف</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $project->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            @error('category_id')
                <p class="text-danger mt-3">{{ $message }}</p>
            @enderror


            <div class="mb-3">
                <label for="live_link" class="form-label">رابط المشروع</label>
                <input type="url" name="live_link" class="form-control"
                    value="{{ old('live_link', $project->live_link) }}">
            </div>
            @error('live_link')
                <p class="text-danger mt-3">{{ $message }}</p>
            @enderror


            <div class="mb-3">
                <label for="github_link" class="form-label">رابط GitHub</label>
                <input type="url" name="github_link" class="form-control"
                    value="{{ old('github_link', $project->github_link) }}">
            </div>
            @error('github_link')
                <p class="text-danger mt-3">{{ $message }}</p>
            @enderror


            <div class="mb-3">
                <label for="image" class="form-label">الصورة</label>
                <input type="file" name="image" class="form-control">

            </div>
            @error('image')
                <p class="text-danger mt-3">{{ $message }}</p>
            @enderror



            @if (isset($project))
                <div class="mt-3">
                    <label class="form-label">الصور الحالية (اختر الصور اللي تبي تحذفهم):</label>
                    <div class="d-flex flex-wrap gap-2">
                        @foreach ($project->images as $img)
                            <div style="position: relative; display:inline-block;">
                                <input type="checkbox" name="delete_images[]" value="{{ $img->id }}"
                                    style="position: absolute; top: 5px; right: 5px; z-index: 10;">
                                <img src="{{ asset('public/' . $img->path) }}" width="100" class="img-thumbnail">
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <div class="mb-3">
                <label for="images" class="form-label">الصور الإضافية</label>
                <input type="file" name="images[]" id="images" class="form-control" multiple>
            </div>
            @error('images')
                <p class="text-danger mt-3">{{ $message }}</p>
            @enderror



            <button type="submit" class="btn btn-primary">تحديث</button>
            <button type="reset" class="btn btn-warning">إعادة</button>
            <a href="{{ route('admin.projects') }}" class="btn btn-secondary">إلغاء</a>
        </form>
    </div>
@endsection
