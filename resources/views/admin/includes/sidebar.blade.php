<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4 h-100 ">
    <!-- Brand Logo -->
    <a href="{{ route('admin.profile') }}" class="brand-link text-decoration-none">
        <img src="{{ asset('public/' . Auth::user()->photo) }}" alt="AdminLTE Logo"
             class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">{{ Auth::user()->name }}</span>
    </a>


    <div class="sidebar fixed">
        <!-- Sidebar user panel (optional) -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item has-treeview menu-open mt-3 border-bottom">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link active mb-3">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            الصفحة الرئيسية
                        </p>
                    </a>
                </li>


                <li class="nav-item has-treeview mt-2 border-transparent">
                    <a href="{{ route('admin.category') }}" class="nav-link ">
                        <i class="nav-icon fas fa-network-wired"></i>
                        <p class="text-white">
                             الاقسام
                        </p>
                    </a>
                </li>

                <li class="nav-item has-treeview mt-2">
                    <a href="{{ route('admin.projects') }}" class="nav-link ">
                        <i class="nav-icon fas fa-code"></i>
                        <p class="text-white">
                            المشاريع
                        </p>
                    </a>
                </li>


                <li class="nav-item has-treeview mt-2">
                    <a href="{{ route('admin.articles') }}" class="nav-link ">
                        <i class="nav-icon far fa-newspaper"></i>
                        <p class="text-white">
                            المقالات
                        </p>
                    </a>
                </li>


                <li class="nav-item has-treeview mt-2">
                    <a href="{{ route('messages.show') }}" class="nav-link ">
                        <i class="nav-icon fas fa-envelope"></i>
                        <p class="text-white">
                            الرسائل
                        </p>
                    </a>
                </li>



                </li>


            </ul>
            </li>


            </ul>


        </nav>
        <!-- /.sidebar-menu -->
    </div>


</aside>
