@extends('admin.layouts.dashboard')

@section('title', 'الأقسام')

@section('content')


    @include('admin.includes.alerts.success')
    @include('admin.includes.alerts.errors')


    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2 align-items-center">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">الرئيسية</a></li>
                        <li class="breadcrumb-item active">الأقسام</li>

                    </ol>
                </div>


                <div class="col-sm-6 text-right">
                    <h1>لوحة التحكم</h1> <!-- بدلنا General Form بنموذج عام حسب اللغة -->
                </div>


            </div>
        </div><!-- /.container-fluid -->
    </section>

    {{-- <a href="{{ route('admin.add.daily-donation') }}" class="btn btn-primary mb-5 mt-5"> إضافة تبرع جديد مستلم</a> --}}
    <button type="button" class="btn btn-success mb-2" data-toggle="modal" data-target="#addCategoryModal">
        <i class="fas fa-folder-plus"></i> إضافة قسم جديد
    </button>

    <div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="addCategoryModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('admin.category.store') }}" method="POST">
                    @csrf
                    <div class="modal-header bg-success">
                        <h5 class="modal-title" id="addCategoryModalLabel">إضافة قسم</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="إغلاق">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">اسم القسم</label>
                            <input type="text" name="name" class="form-control" placeholder="مثال: مواقع الويب"
                                required>
                        </div>
                    </div>

                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                        <button type="submit" class="btn btn-success">حفظ القسم</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="card">

        <div class="card-header text-center">
            <h3 class="card-title w-100">الأقسام</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive">

            @if (@isset($categories) and !@empty($categories))
                <table id="example2" class="table table-bordered  ">
                    <thead>
                        <tr>
                            <th>الرقم</th>


                            <th style="border-left: 1px solid #ddd;">الإسم</th>
                            <th>الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($categories as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->name }}</td>



                                <td class="d-flex align-items-center" style="gap: 10px; border-left: 1px solid #ddd;">



                                    {{-- زر التعديل --}}
                                    <a href="" class="btn btn-sm btn-primary" title="تعديل">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    {{-- زر الحذف --}}
                                    <form action="{{ route('admin.category.destroy', $item->id) }}" method="POST"
                                        onsubmit="return confirm('هل أنت متأكد من الحذف؟')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="حذف"><i
                                                class="far fa-trash-alt"></i> </button>
                                    </form>



                                    <a href="{{ route('admin.category.active', $item->id) }}"
                                        class="btn btn-sm {{ $item->is_active ? 'btn-success' : 'btn-secondary' }}">
                                        {{ $item->is_active ? 'مفعل' : 'غير مفعل' }}
                                    </a>

                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>الرقم</th>
                            <th style="border-left: 1px solid #ddd;">الإسم</th>
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
