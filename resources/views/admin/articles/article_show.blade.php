@extends('admin.layouts.dashboard')

@section('title', 'المشاريع')

@section('content')


    @include('admin.includes.alerts.success')
    @include('admin.includes.alerts.errors')



    <style>
        .product-image {
            width: 100%;
            height: 400px;
            object-fit: cover;
            border: 1px solid #ccc;
            border-radius: 8px;
        }
        
        .product-image-thumb {
            margin: 5px;
            cursor: pointer;
        }
        
        .product-image-thumb img {
            height: 80px;
            object-fit: cover;
            border: 2px solid transparent;
            border-radius: 5px;
            transition: 0.3s;
        }
        
        .product-image-thumb.active img {
            border-color: #007bff;
        }
        </style>
        
        <div class="card card-solid">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <h3 class="d-inline-block d-sm-none">{{ $article->title }}</h3>
                        <div class="col-12 mb-2">
                            <img src="{{ asset('public/' . $article->image) }}" class="product-image main-image" alt="صورة الغلاف">
                        </div>
                        <div class="col-12 d-flex flex-wrap product-image-thumbs">
                            <div class="product-image-thumb active" data-image="{{ asset('public/' . $article->image) }}">
                                <img src="{{ asset('public/' . $article->image) }}" alt="صورة الغلاف">
                            </div>
                            @foreach ($article->images as $img)
                                <div class="product-image-thumb" data-image="{{ asset('public/' . $img->path) }}">
                                    <img src="{{ asset('public/' . $img->path) }}" alt="صورة إضافية">
                                </div>
                            @endforeach
                        </div>
                    </div>
        
                    <div class="col-12 col-sm-6">
                        <h3 class="my-3">{{ $article->title }}</h3>
                        <p>{{ $article->content }}</p>
        
                        <div class="mt-4 product-share">
                            <a href="#" class="text-gray"><i class="fab fa-facebook-square fa-2x"></i></a>
                            <a href="#" class="text-gray"><i class="fab fa-twitter-square fa-2x"></i></a>
                            <a href="#" class="text-gray"><i class="fas fa-envelope-square fa-2x"></i></a>
                            <a href="#" class="text-gray"><i class="fas fa-rss-square fa-2x"></i></a>
                        </div>
                    </div>
                </div>
        
                <div class="row mt-4">
                    <nav class="w-100">
                        <div class="nav nav-tabs" id="product-tab" role="tablist">
                            <a class="nav-item nav-link active" id="desc-tab" data-toggle="tab" href="#desc" role="tab">الوصف</a>
                            <a class="nav-item nav-link" id="comments-tab" data-toggle="tab" href="#comments" role="tab">تعليقات</a>
                            <a class="nav-item nav-link" id="rating-tab" data-toggle="tab" href="#rating" role="tab">تقييم</a>
                        </div>
                    </nav>
                    <div class="tab-content p-3" id="product-tab-content">
                        <div class="tab-pane fade show active" id="desc" role="tabpanel">
                            {{ $article->content }}
                        </div>
                        <div class="tab-pane fade" id="comments" role="tabpanel">
                            لا توجد تعليقات حالياً.
                        </div>
                        <div class="tab-pane fade" id="rating" role="tabpanel">
                            لم يتم تقييم المقالة بعد.
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        {{-- JavaScript --}}
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const thumbs = document.querySelectorAll('.product-image-thumb');
                const mainImage = document.querySelector('.main-image');
        
                thumbs.forEach(thumb => {
                    thumb.addEventListener('click', function () {
                        // تغيير الصورة
                        const newSrc = this.getAttribute('data-image');
                        mainImage.setAttribute('src', newSrc);
        
                        // تغيير الحالة النشطة
                        thumbs.forEach(t => t.classList.remove('active'));
                        this.classList.add('active');
                    });
                });
            });
        </script>
        



























    
@endsection
 