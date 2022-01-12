<div class="container">
    <div wire:poll.keep-alive.6000ms>
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Panel Control</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header border-0">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title">Estado General</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="col-md-4">
                                <div class="info-box">
                                    <span class="info-box-icon bg-danger elevation-1"><i
                                            class="far fa-calendar-alt"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Fecha de Hoy</span>
                                        <span class="info-box-number">
                                            {{ now() }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="info-box">
                                    @if ($sin_ver > 0)
                                        <span class="info-box-icon bg-info elevation-1">
                                            <i class="fas fa-cog fa-spin"></i>
                                        </span>
                                    @else
                                        <span class="info-box-icon bg-info elevation-1"><i
                                                class="fas fa-cog"></i></span>
                                    @endif
                                    <div class="info-box-content">
                                        <span class="info-box-text">Notas Sin Abrir</span>
                                        @if ($sin_ver > 0)
                                            <a href="{{route('admin.notas.list')}}">
                                                <span class="info-box-number">
                                                    {{ $sin_ver }} Resolver!!!!
                                                </span>
                                            </a>
                                        @else
                                            <span class="info-box-number">
                                                {{$sin_ver}}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="info-box">
                                    @if ($cant_pendientes > 0)
                                        <span class="info-box-icon bg-primary elevation-1">
                                            <i class="fa fa-spinner fa-pulse fa-1x fa-fw"></i></span>

                                    @else
                                        <span class="info-box-icon bg-primary elevation-1"><i
                                                class="fas fa-cog"></i></span>
                                    @endif
                                    <div class="info-box-content">
                                        <span class="info-box-text">Notas Pendientes</span>
                                        @if ($cant_pendientes > 0)
                                            <a href="{{route('admin.notas.list')}}">
                                                <span class="info-box-number">
                                                    {{ $cant_pendientes }} Resolver!!!!
                                                </span>
                                            </a>
                                        @else
                                            <span class="info-box-number">
                                                {{ $cant_pendientes }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header border-0">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title">Resumen Diario</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="col-md-4">
                                <div class="info-box">
                                    <span class="info-box-icon bg-info"><i class="fas fa-clipboard"></i></span>

                                    <div class="info-box-content">
                                        <span class="info-box-text">Trámites Recibidos Hoy </span>
                                        <span class="info-box-number">{{$creadas_hoy}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="info-box">
                                    <span class="info-box-icon bg-warning"><i class="fas fa-share"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Mis Trámites Creados Hoy</span>
                                        <span class="info-box-number">{{$mis_tramites}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="info-box">
                                    <span class="info-box-icon bg-success"><i class="fas fa-thumbs-up"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Trámites Resueltos</span>
                                        <span class="info-box-number">{{$cant_resueltos}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
