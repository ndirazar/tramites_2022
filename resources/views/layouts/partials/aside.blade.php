<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="index3.html" class="brand-link">
    <img src="https://yt3.ggpht.com/yti/APfAmoGttBvvoOAMsBnAXftYUi5cJIEFmqfHEjEs8zh7=s88-c-k-c0x00ffffff-no-rj-mo" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
         style="opacity: .9">
    <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="info">
        <a href="#" class="d-block" x-ref="username">{{ auth()->user()->name }}</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        <li class="nav-item">
          <a href="{{ route('admin.inicio') }}" class="nav-link {{ request()->is('admin/inicio') ? 'active' : '' }}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Panel Control
            </p>
          </a>
        </li>
        @if (auth()->user()->isAdmin())
            <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        Oficinas - Areas
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.dependencias') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Administrar Areas</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.dependencias.user') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Asignar Usuarios</p>
                            </a>
                        </li>
                </ul>
            </li>
            {{-- <li class="nav-item">
            <a href="{{ route('admin.appointments') }}" class="nav-link {{ request()->is('admin/appointments*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-calendar-alt"></i>
                <p>
                Appointments
                </p>
            </a>
            </li> --}}

            <li class="nav-item">
            <a href="{{ route('admin.users') }}" class="nav-link {{ request()->is('admin/users') ? 'active' : '' }}">
                <i class="nav-icon fas fa-users"></i>
                <p>
                Usuarios
                </p>
            </a>
            </li>

            <li class="nav-item">
            <a href="{{ route('admin.settings') }}" class="nav-link {{ request()->is('admin/settings') ? 'active' : '' }}">
                <i class="nav-icon fas fa-cog"></i>
                <p>
                Opciones
                </p>
            </a>
            </li>

            <li class="nav-item">
            <a x-ref="profileLink" href="{{ route('admin.profile.edit') }}" class="nav-link {{ request()->is('admin/profile') ? 'active' : '' }}">
                <i class="nav-icon fas fa-user"></i>
                <p>
                Perfil
                </p>
            </a>
            </li>
        @endif

        <li class="nav-item">
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Salir
              </p>
            </a>
          </form>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
