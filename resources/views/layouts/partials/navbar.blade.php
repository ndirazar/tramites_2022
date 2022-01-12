<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
    <ul class="navbar-nav">
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{route('admin.inicio')}}" class="nav-link">Inicio</a>
        </li>
        @if (auth()->user()->isAdmin())
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{route('admin.dependencias')}}" class="nav-link">Oficinas</a>
            </li>
        @endif

        {{-- {{dd(canGenerateTramite('genera_tramite'))}} --}}
        @if (canGenerateTramite('genera_tramite')==true)

            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{ route('admin.notas.create') }}" class="nav-link">Cargar Trámite</a>
            </li>
         @endif
         <li class="nav-item d-none d-sm-inline-block">
            <a href="{{route('admin.notas.list')}}" class="nav-link">Trámites</a>
        </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="ml-1" x-ref="username">{{ auth()->user()->name }}</span>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('admin.profile.edit') }}" x-ref="changePasswordLink">Cambiar Clave</a>
                <a class="dropdown-item" href="{{ route('admin.settings') }}">Ajustes</a>
                <div class="dropdown-divider"></div>
                <form method="POST" action="{{ route('logout') }}">
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">Salir</a>
                </form>
            </div>
        </li>
    </ul>
</nav>
