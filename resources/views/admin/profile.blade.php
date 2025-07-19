@extends('admin.layouts.dashboard')

@section('title', 'المشاريع')

@section('content')


    @include('admin.includes.alerts.success')
    @include('admin.includes.alerts.errors')


    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle" src="../../dist/img/user4-128x128.jpg"
                                alt="User profile picture">
                        </div>

                        <h3 class="profile-username text-center">{{ $admin->name }}</h3>

                        <p class="text-muted text-center">{{ $admin->title }}</p>

                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>الموقع :</b> <a class="">{{ $admin->location }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>رقم الهاتف :</b> <a class="">{{ $admin->phone }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>البريد الالكتروني :</b> <a class="">{{ $admin->email }}</a>
                            </li>
                        </ul>

                        <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <!-- About Me Box -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">About Me</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <strong><i class="fas fa-book mr-1"></i> Education</strong>

                        <p class="text-muted">
                            {{ $admin->description }}
                        </p>

                        <hr>

                        <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

                        <p class="text-muted">{{ $admin->location }}</p>

                        <hr>

                        <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>
@if (@isset($skills) and !@empty($skills))
                        <p class="text-muted">
                            @foreach ($skills as $skill)
                            <span class="tag tag-danger">,{{ $skill -> name }}</span>
                            @endforeach .

                        </p>
                        @endif

                        <hr>

                        <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>

                        <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim
                            neque.</p>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">البيانات</a>
                            </li>
                            <li class="nav-item"><a class="nav-link " href="#links" data-toggle="tab">الروابط</a></li>
                            <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">المهارات</a></li>

                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">


                        <div class="tab-content">

                            <div class="tab-pane active" id="settings">
 
                            <form action="{{ route('admin.profile.update') }}" method="POST" class="form-horizontal">
                                @csrf
                                @method('PUT')
                            
                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">الاسم</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="name" class="form-control" value="{{ old('name', $admin->name) }}" placeholder="الاسم">
                                    </div>
                                </div>
                            
                                <div class="form-group row">
                                    <label for="email" class="col-sm-2 col-form-label">البريد الإلكتروني</label>
                                    <div class="col-sm-10">
                                        <input type="email" name="email" class="form-control" value="{{ old('email', $admin->email) }}" placeholder="البريد الإلكتروني">
                                    </div>
                                </div>
                            
                                <div class="form-group row">
                                    <label for="password" class="col-sm-2 col-form-label">كلمة المرور (اختياري)</label>
                                    <div class="col-sm-10">
                                        <input type="password" name="password" class="form-control" placeholder="اتركه فارغًا إذا لا تريد تغييره">
                                    </div>
                                </div>
                            
                                <div class="form-group row">
                                    <label for="summary" class="col-sm-2 col-form-label">الشرح المختصر</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="summary" class="form-control" value="{{ old('summary', $admin->title) }}" placeholder="شرح مختصر">
                                    </div>
                                </div>
                            
                                <div class="form-group row">
                                    <label for="phone" class="col-sm-2 col-form-label">رقم الهاتف</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="phone" class="form-control" value="{{ old('phone', $admin->phone) }}" placeholder="رقم الهاتف">
                                    </div>
                                </div>
                            
                                <div class="form-group row">
                                    <label for="location" class="col-sm-2 col-form-label">الموقع</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="location" class="form-control" value="{{ old('location', $admin->location) }}" placeholder="موقعك">
                                    </div>
                                </div>
                            
                                <div class="form-group row">
                                    <label for="description" class="col-sm-2 col-form-label">الوصف الكامل</label>
                                    <div class="col-sm-10">
                                        <textarea name="description" class="form-control" rows="4" placeholder="الوصف">{{ old('description', $admin->description) }}</textarea>
                                    </div>
                                </div>
                           
                            

                            
                                <div class="form-group row mt-4">
                                    <div class="col-sm-10 offset-sm-2">
                                        <button type="submit" class="btn btn-primary">تحديث البيانات</button>
                                    </div>
                                </div>
                            </form>
                         </div>    
                            

                         <div class="tab-pane" id="links">
                                <form action="{{ route('admin.social-links.update') }}" method="POST">
                                    @csrf
                                    
                                    <div class="form-group">
                                        <label for="facebook">رابط الفيسبوك</label>
                                        <input type="url" name="facebook" id="facebook" class="form-control" value="{{ old('facebook', $social->facebook) }}" placeholder="https://facebook.com/yourpage">
                                    </div>
                                
                                    <div class="form-group">
                                        <label for="x">رابط التويتر</label>
                                        <input type="url" name="x" id="x" class="form-control" value="{{ old('x', $social->x) }}" placeholder="https://x.com/yourhandle">
                                    </div>
                                
                                    <div class="form-group">
                                        <label for="instagram">رابط الانستغرام</label>
                                        <input type="url" name="instagram" id="instagram" class="form-control" value="{{ old('instagram', $social->instagram) }}" placeholder="https://instagram.com/yourprofile">
                                    </div>
                                
                                    <div class="form-group">
                                        <label for="telegram">رابط التيليجرام</label>
                                        <input type="url" name="telegram" id="telegram" class="form-control" value="{{ old('telegram', $social->telegram) }}" placeholder="https://t.me/yourchannel">
                                    </div>
                                
                                    <div class="form-group">
                                        <label for="linkedin">رابط اللينكدإن</label>
                                        <input type="url" name="linkedin" id="linkedin" class="form-control" value="{{ old('linkedin', $social->linkedin) }}" placeholder="https://linkedin.com/in/yourprofile">
                                    </div>
                                
                                    <div class="form-group">
                                        <label for="youtube">رابط اليوتيوب</label>
                                        <input type="url" name="youtube" id="youtube" class="form-control" value="{{ old('youtube', $social->youtube) }}" placeholder="https://youtube.com/channel/yourchannel">
                                    </div>
                                
                                    <button type="submit" class="btn btn-primary">إضافة الروابط</button>
                                </form>
                                
                            </div>



                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="timeline">
                                <!-- The timeline -->
                                <div class="timeline timeline-inverse">
                                    <button class="btn btn-primary" data-toggle="modal" data-target="#addSkillModal">إضافة مهارة جديدة</button>
                                </div>
                            
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>الاسم</th>
                                            <th>المستوى</th>
                                            <th>النبذة</th>
                                            <th>الحالة</th>
                                            <th>الإجراءات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($skills as $skill)
                                        <tr>
                                            <td>{{ $skill->name }}</td>
                                            <td>{{ $skill->level }}%</td>
                                            <td>{{ $skill->summary }}</td>
                                            <td>
                                                @if($skill->is_active)
                                                    <span class="badge badge-success">مفعلة</span>
                                                @else
                                                    <span class="badge badge-secondary">غير مفعلة</span>
                                                @endif
                                            </td>
                                            <td>
                                                <!-- تفعيل / الغاء -->
                                                <form action="{{ route('skills.toggle', $skill) }}" method="POST" style="display:inline-block">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-warning">
                                                        {{ $skill->is_active ? 'إلغاء التفعيل' : 'تفعيل' }}
                                                    </button>
                                                </form>
                            
                                                <!-- زر التعديل يفتح مودال -->
                                                <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#editSkillModal{{ $skill->id }}">
                                                    تعديل
                                                </button>
                            
                                                <!-- حذف -->
                                                <form action="{{ route('skills.destroy', $skill) }}" method="POST" style="display:inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('هل أنت متأكد من الحذف؟')">
                                                        حذف
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                            
                                        <!-- مودال التعديل -->
                                        <div class="modal fade" id="editSkillModal{{ $skill->id }}" tabindex="-1" role="dialog" aria-labelledby="editSkillModalLabel{{ $skill->id }}" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <form action="{{ route('skills.update', $skill) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">تعديل المهارة</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="إغلاق">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label>اسم المهارة</label>
                                                                <input type="text" name="name" value="{{ $skill->name }}" class="form-control" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>المستوى (%)</label>
                                                                <input type="number" name="level" value="{{ $skill->level }}" min="0" max="100" class="form-control" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>نبذة مختصرة</label>
                                                                <input type="text" name="summary" value="{{ $skill->summary }}" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                                                            <button type="submit" class="btn btn-primary">حفظ التغييرات</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            
                            <!-- مودال الإضافة -->
                            <div class="modal fade" id="addSkillModal" tabindex="-1" role="dialog" aria-labelledby="addSkillModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <form action="{{ route('skills.store') }}" method="POST">
                                        @csrf
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">إضافة مهارة جديدة</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="إغلاق">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>اسم المهارة</label>
                                                    <input type="text" name="name" class="form-control" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>المستوى (%)</label>
                                                    <input type="number" name="level" min="0" max="100" class="form-control" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>نبذة مختصرة</label>
                                                    <input type="text" name="summary" class="form-control">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                                                <button type="submit" class="btn btn-primary">إضافة</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                </div>
                            </div>
                            <!-- /.tab-pane -->


                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->


@endsection
