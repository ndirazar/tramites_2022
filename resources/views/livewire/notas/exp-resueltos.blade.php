<div wire:ignore.self class="modal fade bd-example-modal-lg" id="expresueltos" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title w-100 text-center" id="exampleModalLabel">Expedientes Resueltos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- {{-- Aca Va la tabla de clientessel --}} -->
                <table class="table table-sm table-hover">
                    <thead>
                        <tr>
                            <th class="text-center">Nro.Exp.</th>
                            <th class="text-center">Fecha</th>
                            <th>Titulo</th>
                            <th> Area Destino</th>
                            <th> Autor</th>
                            <th class="text-left">Estado</th>
                            <th colspan="2" class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($resueltos as $resuelto)
                            <tr>
                                <td class="text-center align-middle"><small>{{ $resuelto->id }}</small></td>
                                <td class="text-center align-middle" style="width: 100px"><small>{{ date_format($resuelto->created_at,'d-m-Y') }}</small></td>
                                <td class="text-left align-middle"><small>{{ $resuelto->titulo}}</small></td>
                                <td class="text-left align-middle"><small>{{$resuelto->nombre}}</small></td>
                                <td class="text-left align-middle"><small>{{$resuelto->name}}</small></td>
                                <td class="text-left align-middle
                                    @if ($resuelto->estado === 1)
                                        text-secondary
                                    @elseif ($resuelto->estado === 5)
                                        text-success
                                    @else
                                        text-danger
                                    @endif">
                                    <small>{{$resuelto->estadoss}}</small>
                                </td>
                                <td class="text-center"><a class="btn" href="{{ route('admin.notas.show', $resuelto->id ) }}"><i class="far fa-eye text-info" data-toggle="tooltip" data-placement="top" title="Ver Nota"></i></a> </td>
                                @if ($resuelto->estado === 1)
                                    <td>
                                        <a class="btn" href="#"
                                                    wire:click="anularNota({{ $resuelto->id }})"
                                                    onclick="confirm('¿Desea Anular este Trámite?') || event.stopImmediatePropagation()">
                                            <i class="fas fa-ban text-danger" data-toggle="tooltip" data-placement="top" title="Anular Nota!!">
                                            </i>
                                        </a>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{-- Fin Tabla--}}
            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="" class="btn btn-danger" data-dismiss="modal"><span
                        aria-hidden="true">x </span>Cerrar</button>
            </div>
        </div>
    </div>
</div>
