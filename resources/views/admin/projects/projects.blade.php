@extends('admin.layouts.dashboard')

@section('title', 'المشاريع')

@section('content')


    @include('admin.includes.alerts.success')
    @include('admin.includes.alerts.errors')


    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2 align-items-center">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">الرئيسية</a></li>
                        <li class="breadcrumb-item active"> المشاريع</li>

                    </ol>
                </div>


                <div class="col-sm-6 text-right">
                    <h1>لوحة التحكم</h1> <!-- بدلنا General Form بنموذج عام حسب اللغة -->
                </div>


            </div>
        </div><!-- /.container-fluid -->
    </section>

    {{-- <a href="{{ route('admin.add.daily-donation') }}" class="btn btn-primary mb-5 mt-5"> إضافة تبرع جديد مستلم</a> --}}
    <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addProjectModal">
        <i class="fas fa-plus"></i> إضافة مشروع جديد
    </button>

    <div class="modal fade" id="addProjectModal" tabindex="-1" role="dialog" aria-labelledby="addProjectModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title" id="addProjectModalLabel">إضافة مشروع جديد</h5>
                        <button type="button" class="close"  data-dismiss="modal" aria-label="إغلاق">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body ">
                        <div class="row">
                            <div class="col-md-6">


                                <div class="form-group">
                                    <label>اسم المشروع</label>
                                    <input type="text" name="title" class="form-control"
                                        placeholder="مثال: موقع حجز مطاعم" required>
                                </div>
                                @error('title')
                                    <p class="text-danger mt-3">{{ $message }}</p>
                                @enderror

                                <div class="form-group">
                                    <label>رابط المشروع</label>
                                    <input type="url" name="live_link" class="form-control"
                                        placeholder="https://example.com">
                                </div>
                                @error('live_link')
                                    <p class="text-danger mt-3">{{ $message }}</p>
                                @enderror


                                <div class="form-group">
                                    <label>رابط المشروع على قيت هاب</label>
                                    <input type="url" name="github_link" class="form-control"
                                        placeholder="https://example.com">
                                </div>
                                @error('github_link')
                                    <p class="text-danger mt-3">{{ $message }}</p>
                                @enderror



                                <div class="form-group">
                                    <label>التصنيف</label>
                                    <select name="category_id" class="form-control" required>
                                        <option value="">اختر تصنيف</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @error('category_id')
                                <p class="text-danger mt-3">{{ $message }}</p>
                            @enderror



                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>الوصف</label>
                                    <textarea name="description" rows="6" class="form-control" placeholder="شرح موجز عن المشروع..." required></textarea>
                                </div>
                                @error('description')
                                    <p class="text-danger mt-3">{{ $message }}</p>
                                @enderror


                                <div class="form-group">
                                    <label for="projectImage">صورة الغلاف</label>
                                    <input type="file"  name="image"   class="form-control-file" id="projectImage" multiple  required>
                                </div>

                                <div class="form-group">
                                    <label for="projectImage">صورة المشروع</label>
                                    <input type="file"  name="images[]"   class="form-control-file" id="projectImage" multiple  required>
                                </div>

                                @error('image')
                                    <p class="text-danger mt-3">{{ $message }}</p>
                                @enderror


                            </div>
                        </div>
                    </div>

                    <div class="modal-footer justify-content-between">
                        <div>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">إغلاق</button>
                            <button type="reset" class="btn btn-warning">إعادة</button>
                        </div>
                        <button type="submit" class="btn btn-primary">حفظ المشروع</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="card">

        <div class="card-header text-center">
            <h3 class="card-title w-100">التبرعات اليومية المستلمة</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive">

            @if (@isset($projects) and !@empty($projects))
                <table id="example2" class="table table-striped table-bordered table-auto  ">
                    <thead>
                        <tr>
                            <th>العنوان</th>
                            <th>التفاصيل</th>
                            <th>رابط المشروع </th>
                            <th>رابط المشروع على github </th>
                            <th>القسم </th>
                            <th style="border-left: 1px solid #DDDDDD; width: 150px">صورة الغلاف</th>
                            <th>اليوم </th>
                            <th style="border-left: #DDDDDD solid 1px">التاريخ الهجري </th>
                            <th style="border-left: #DDDDDD solid 1px">التاريخ </th>

                            <th>الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($projects as $item)
                            <tr>
                                <td>{{ $item->title }}</td>
                                <td>{{ $item->description }}</td>
                                <td>{{ $item->live_link }}</td>
                                <td>{{ $item->github_link }}</td>
                                <td>{{ $item->category->name}}</td>



                                <td style="border-left: 1px solid #ddd;">
                                    @if ($item->image === null)
                                        <img src="" class="w-25 h-25 img-fluid img-thumbnail" alt="لا توجد صورة">
                                    @else
                                    <div class="project-images">
                                        <img src="{{ asset('public/' . $item->image) }}" style="width: 100%; height: 100%;" class="w-25 h-25" alt="10"
                                        srcset="">
                                        {{-- @foreach ($item->images as $image)
                                            <img src="{{ asset('public/'.$image->path) }}" alt="صورة المشروع" style="max-width:200px; margin:10px;">
                                        @endforeach --}}
                                    </div>
                                    @endif

                                </td>

                                <td>{{ $item->day}}</td>
                                <td style="border-left: #DDDDDD solid 1px">{{ $item->hijri_date }}</td>
                                <td style="border-left: #DDDDDD solid 1px">{{ $item->date }} ({{$item->time}})</td>






{{-- {{ route('admin.daily-donation.show', $item->id) }}{{ route('admin.delete.daily-donation', ['id' => $item->id]) }} --}}
                                <td class="d-flex align-items-center" style="gap: 10px;">
                                    {{-- زر العرض --}}
                                    <a href="{{ route('admin.projects.show', ['id' => $item->id]) }}"
                                        class="btn btn-sm btn-info" title="عرض">
                                        <i class="fas fa-eye"></i>
                                    </a>

                                    {{-- زر التعديل --}}
                                    <a href="{{ route('admin.projects.edit', ['id' => $item->id]) }}"
                                        class="btn btn-sm btn-primary" title="تعديل">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    {{-- زر الحذف --}}

                                    <form action="{{ route('admin.projects.destroy', $item->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من الحذف؟')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="حذف"><i class="far fa-trash-alt"></i> </button>


                                    </form>



                                    <a href="{{ route('admin.projects.active', $item->id) }}" class="btn btn-sm {{ $item->is_active ? 'btn-success' : 'btn-secondary' }}">
                                        {{ $item->is_active ? 'مفعل' : 'غير مفعل' }}
                                    </a>
                                </td>


                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr >
                            <th>العنوان</th>
                            <th>التفاصيل</th>
                            <th>رابط المشروع </th>
                            <th>رابط المشروع على github </th>
                            <th>القسم </th>
                            <th style="border-left: 1px solid #ddd;">صورة الغلاف</th>
                            <th>اليوم </th>
                            <th style="border-left: #DDDDDD solid 1px">التاريخ الهجري </th>
                            <th style="border-left: #DDDDDD solid 1px">التاريخ </th>
                            <th>الإجراءات</th>
                        </tr>
                    </tfoot>
                </table>
            @else
                <h4 class="bg-danger text-center mb-5 mt-5 pb-3 pt-3 rounded">لاتوجد بيانات لعرضها</h4>
            @endif

        </div>
        <!-- /.card-body -->
    </div>


@endsection
