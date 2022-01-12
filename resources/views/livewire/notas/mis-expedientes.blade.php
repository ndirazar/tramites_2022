<div wire:ignore.self class="modal fade bd-example-modal-lg" id="detallemodal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title w-100 text-center" id="exampleModalLabel">Notas Enviadas </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="basic-addon1">Buscar</span>
                    </div>
                    <input type="text" class="form-control text-capitalize" wire:model='nroTramite'
                           placeholder="Ingrese Nro. de Nota" id="nroTramite" name="nroTramite">
                </div>
                <small id="emailHelp" class="form-text text-muted mb-2">Ud puede buscar por Nro.Nota - Apellido y Nombre - Area Destino</small>
                <!-- {{-- Aca Va la tabla de clientessel --}} -->
                <table class="table table-sm table-hover">
                    <thead>
                        <tr>
                            <th style="width:20px" class="text-center">Nro.Exp.</th>
                            <th style="width:100px" class="text-left">Fecha</th>
                            <th style="width:200px">Título</th>
                            <th style="width:200px">Apellido y Nombre</th>
                            <th style="width:200px">Area Destino</th>
                            <th style="width:100px">Autor</th>
                            <th colspan="3" class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($expedientes as $expediente)
                            <tr>
                                <td class="text-center small">{{ $expediente->id }}</td>
                                <td class="text-left small">{{ date_format($expediente->created_at,'d-m-Y') }} </td>
                                <td class="text-left small">{{Str::limit($expediente->titulo, 30, '...') }} </td>
                                <td class="text-left small">{{ $expediente->apellido}} </td>
                                <td class="text-left small">{{$expediente->nombre}} </td>
                                <td class="text-left small
                                    @if ($expediente->estado_id === 1)
                                        text-secondary
                                    @elseif ($expediente->estado_id === 5)
                                        text-success
                                    @else
                                        text-danger
                                    @endif">
                                    {{$expediente->estado_nombre}}
                                </td>
                                <td class="text-center">
                                    <a class="btn" href="{{ route('admin.notas.show', $expediente->id ) }}">
                                        <i class="far fa-eye text-info" data-toggle="tooltip" data-placement="top" title="Ver Nota"></i>
                                    </a>
                                </td>
                                @if ($expediente->estado_id === 1)
                                    <td>
                                        <a class="btn" href="{{ route('admin.notas.edit', $expediente->id ) }}">
                                            <i class="fas fa-edit text-warning" data-toggle="tooltip" data-placement="top" title="Editar Nota">
                                            </i>
                                        </a>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{-- Fin Tabla--}}
                <div class="card-footer d-flex justify-content-end">
                    {{ $expedientes->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
    {{-- Focus and Select Value --}}

    <script>
        $('#detallemodal').on('shown.bs.modal', function () {

            console.log('aca');
        setTimeout(function (){
            $('#nroTramite').focus().select();
        }, 100);
    })
    </script>
@endpush
