@extends('admin.layouts.dashboard')

@section('title', 'الرسائل')

@section('content')
    <div class="card">
    <div class="card-header text-center">
        <h3 class="card-title w-100">جميع الرسائل الواردة</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive">

        @if (@isset($messages) and $messages->isNotEmpty())
            <table id="example2" class="table table-striped table-bordered table-auto">
                <thead>
                <tr>
                    <th>الاسم</th>
                    <th>البريد الإلكتروني</th>
                    <th>العنوان</th>
                    <th>الرسالة</th>
                    <th>تاريخ الإرسال</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($messages as $msg)
                    <tr>
                        <td>{{ $msg->name }}</td>
                        <td>{{ $msg->email }}</td>
                        <td>{{ $msg->address ?? 'لا يوجد' }}</td>
                        <td>{{ $msg->message }}</td>
                        <td>{{ $msg->created_at->format('Y-m-d H:i') }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <p class="text-center">لا توجد رسائل لعرضها.</p>
        @endif

    </div>
    </div>
@endsection
