@extends('admin.layouts.Loginroute')

@section('title','نسجيل الدخول')

@section('content')
<div class="login-box">
  <div class="login-logo">
    <a href="{{ asset('assets/admin/index2.html') }}"><b>Barara</b>GOOD</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">




      <p class="login-box-msg">سجل دخولك الان</p>
      @if (Session::has('error'))
        <div class="alert alert-danger text-center" role="alert">
          {{ Session::get('error') }}
        </div>
      @endif

      <form action="{{ route('admin.login') }}" method="post">

        @csrf

        <div class="input-group mb-3">
          <input type="text" class="form-control text-right" name="username" placeholder="إسم المستخدم">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>

        @error('username')
        <p class="text-danger text-right">{{$message}}</p>
        @enderror

        <div class="input-group mb-3">
          <input type="password" class="form-control text-right" name="password" placeholder="كلمة المرور">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>

        @error('password')
        <p class="text-danger text-right">{{$message}}</p>
        @enderror

        <div class="row">

          <!-- /.col -->
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block btn-flat">سجل دخولك</button>
          </div>
          <!-- /.col -->
        </div>
      </form>


    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

@endsection
