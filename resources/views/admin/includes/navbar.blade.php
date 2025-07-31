
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('admin.dashboard') }}" class="nav-link">الصفحة الرئيسية</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('admin.logout') }}" class="nav-link">تسجيل الخروج</a>
      </li>
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav">
        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class=" fas fa-envelope" style="font-size: 30px;"></i>
                <span class="badge badge-danger navbar-badge" style="font-size: 10px; ">{{ $latestMessages->count() }}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-left">
                @foreach($latestMessages as $message)
                    <a href="#" class="dropdown-item">
                        <div class="media">

                            <div class="media-body">
                                <h3 class="dropdown-item-title">
                                    {{ $message->name }}
                                </h3>
                                <p class="text-sm">{{ Str::limit($message->message, 40) }}</p>
                                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> {{ $message->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                @endforeach
                <a href="{{ route('messages.show') }}" class="dropdown-item dropdown-footer">عرض جميع الرسائل</a>
            </div>
        </li>
    </ul>

</nav>
