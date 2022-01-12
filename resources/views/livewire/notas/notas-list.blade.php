<div class="container">
    <x-loading-indicator />

    @include('livewire.notas.mis-expedientes', ['expedientes' => $expedientes])
    @include('livewire.notas.mis-movimientos', ['movimientos' => $movimientos])
    @include('livewire.notas.exp-resueltos', ['resueltos' => $resueltos])

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Trámites</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.inicio') }}">Panel Control</a></li>
                        <li class="breadcrumb-item active">Trámites</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card-header">
                        <h5>Bandeja de Entrada - Nuevos </h5>
                    </div>
                    <div class="d-flex justify-content-between m-2">
                        <div class="d-flex align-items-end">
                            @if ($generaTramite)
                                <a href="{{ route('admin.notas.create') }}" class="btn btn-sm btn-primary">Crear Expediente</a>
                            @endif
                        </div>
                        <div class="d-flex align-items-start">
                            <a class="btn btn-success btn-sm" href="#" data-placement="bottom" title="Mis Trámites"
                            data-toggle="modal" data-target="#expresueltos">Expedientes Finalizados</a>
                            <div class="d-flex align-items-start ml-5">
                                <a class="btn btn-warning btn-sm" href="#" data-placement="bottom" title="Mis Trámites"
                                   data-toggle="modal" data-target="#detallemodal">Mis Expedientes</a>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <table class="table table-sm table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center">Nro.Nota</th>
                                        <th class="text-center">Fecha</th>
                                        <th class="text-left">Enviado a</th>
                                        <th class="text-left">Título</th>
                                        <th class="text-left">Creado Por</th>
                                        <th class="text-left">Estado</th>
                                        <th colspan="3" class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($notas as $nota)
                                    <tr>
                                        <th class="text-center align-middle">{{ $nota->id }}</th>
                                        <td class="text-center align-middle">{{ date_format($nota->created_at,'d-m-Y') }}</td>
                                        <td class="text-left align-middle small">{{ $nota->nombre }}</td>
                                        <td class="text-left align-middle small">{{ Str::limit($nota->titulo, 30, ' (...Ver más)') }}</small></td>
                                        <td class="text-left align-middle small">{{ $nota->name }}</td>
                                        <td class="text-left align-middle text-info small"><strong>{{ $nota->estado_nombre }}</strong></small></td>
                                        <td>
                                            @if ($this->isforme($nota->id) )
                                                <td class="text-center align-middle">
                                                    <a href="#" class="btn btn-sm btn-success" data-toggle="tooltip"
                                                       data-placement="top" title="Abrir"
                                                       wire:click="visto({{ $nota->id }})"
                                                       onclick="confirm('¿Desea Abrir esta Nota?') || event.stopImmediatePropagation()">
                                                       Abrir
                                                    </a>
                                                </td>
                                            @else
                                                <td class="text-center">
                                                    {{-- <a class="btn" href="{{ route('nota.notas.show', $nota->id) }}"> --}}
                                                    <a class="btn" href="{{ route('admin.notas.show', $nota->id ) }}">
                                                        <i class="far fa-eye text-danger" data-toggle="tooltip" data-placement="top" title="Ver Nota"></i>
                                                    </a>
                                                </td>
                                            @endif
                                        </td>
                                    </tr>
                                    @empty
                                        <tr class="text-center">
                                            <td colspan="10">
                                                    <p class="mt-2">No existen Trámites Recibidos</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer d-flex justify-content-end">
                            {!! $notas->links() !!}
                        </div>
                    </div>
                </div>
            </div>

            {{-- Tramites Pendientes --}}

            <div class="row">
                <div class="col-lg-12">
                    <div class="card-header">
                        <h5>Trámites/Notas Pendientes </h5>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-sm table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center">Nro.Nota</th>
                                        <th class="text-center">Fecha</th>
                                        <th class="text-left">Enviado a</th>
                                        <th class="text-left">Título</th>
                                        <th class="text-left">Creado Por</th>
                                        <th class="text-left">Estado</th>
                                        <th colspan="3" class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($notas_pendientes as $nota_pendiente)
                                    <tr>
                                        <th class="text-center align-middle">{{ $nota_pendiente->id }}</th>
                                        <td class="text-center align-middle">{{ date_format($nota_pendiente->created_at,'d-m-Y') }}</td>
                                        <td class="text-left align-middle small">{{ $nota_pendiente->nombre }}</td>
                                        <td class="text-left align-middle small">{{ Str::limit($nota_pendiente->titulo, 30, ' (...Ver más)') }}</small></td>
                                        <td class="text-left align-middle small">{{ $nota_pendiente->name }}</td>
                                        <td class="text-danger align-middle small"><strong>{{ $nota_pendiente->estado_nombre }}</strong></td>
                                        <td class="text-center">
                                            <a class="btn" href="{{route('admin.notas.show',$nota_pendiente->id)}}">
                                                <i class="far fa-eye text-dark" data-toggle="tooltip" data-placement="top" title="Ver Nota"></i>
                                            </a>
                                        <td class="text-center">
                                            <a href="#" class="btn"
                                                data-placement="bottom"
                                                data-toggle="modal"
                                                data-target="#movimientosModal"
                                                title="Movimientos"
                                                wire:click="selExpediente({{ $nota_pendiente->id }})">
                                                <i class="fas fa-clipboard-list text-primary"
                                                    data-toggle="tooltip"
                                                    data-placement="top"
                                                    title="Movimientos">
                                                </i>
                                            </a>

                                    </td>

                                    </tr>
                                    @empty
                                        <tr class="text-center">
                                            <td colspan="10">
                                                    <p class="mt-2">No existen Trámites Pendientes</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer d-flex justify-content-end">
                            {!! $notas_pendientes->links() !!}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <x-confirmation-alert />
</div>

@push('styles')
<style>
    .draggable-mirror {
        background-color: white;
        width: 950px;
        display: flex;
        justify-content: space-between;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }
</style>
@endpush

@push('after-livewire-scripts')
<script src="https://cdn.jsdelivr.net/gh/livewire/sortable@v0.x.x/dist/livewire-sortable.js"></script>
@endpush
