@extends('admin.layouts.dashboard')

@section('title', 'المقالات')

@section('content')


    @include('admin.includes.alerts.success')
    @include('admin.includes.alerts.errors')




    <div class="container">
        <h2>تعديل المشروع</h2>

        @if ($article->image)
            <img src="{{ asset('public/' . $article->image) }}" alt="صورة المشروع" class="img-thumbnail mt-2" width="150">
        @endif

        <form action="{{ route('admin.articles.update', $article->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="title" class="form-label">العنوان</label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $article->title) }}">
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">الوصف</label>
                <textarea name="content" class="form-control">{{ old('description', $article->content) }}</textarea>
            </div>

            <div class="mb-3">
                <label for="category_id" class="form-label">التصنيف</label>
                <select name="category_id" class="form-select">
                    <option value="">اختر تصنيف</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $article->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>



            <div class="mb-3">
                <label for="image" class="form-label">صورة الغلاف</label>
                <input type="file" name="image" class="form-control">

            </div>


            @if (isset($article)) 
            <div class="mt-3">
                <label class="form-label">الصور الحالية (اختر الصور التي تريد حذفها):</label>
                <div class="d-flex flex-wrap gap-2">
                    @foreach ($article->images as $img)
                        <div style="position: relative; display:inline-block;">
                            <input type="checkbox" name="delete_images[]" value="{{ $img->id }}" style="position: absolute; top: 5px; right: 5px; z-index: 10;">
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



            <button type="submit" class="btn btn-primary">تحديث</button>
            <button type="reset" class="btn btn-warning">إعادة</button>
            <a href="{{ route('admin.articles') }}" class="btn btn-secondary">إلغاء</a>
        </form>
    </div>

@endsection
