<div wire:ignore.self class="modal fade bd-example-modal-lg" id="movimientosModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title w-100 text-center" id="exampleModalLabel">Movimientos Trámites</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-sm table-hover">
                    <thead>
                        <tr>
                            <th class="text-center">Nro.Exp.</th>
                            <th class="text-center">Fecha/Hora</th>
                            <th>Usuario</th>
                            <th class="text-left">Estado</th>
                            <th>Area</th>
                            <th>Observaciones</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($movimientos as $movimiento)
                            <tr>
                                <td class=text-center><small>{{$movimiento->nota_id}}</small></td>
                                <td class=text-center ><small>{{ \Carbon\Carbon::parse($movimiento->fecha)->format('d-m-Y H:i')}}</small></td>
                                <td ><small>{{$movimiento->usuario}}</small></td>
                                <td class="text-left @if ($movimiento->estado === 'CREADO') text-info
                                                       @else text-danger @endif"
                                 >
                                    <small>{{$movimiento->estado}}</small>
                                </td>
                                <td ><small>{{$movimiento->area}}</small></td>
                                <td class="text-center"> <small>{{$movimiento->observaciones}}</small></td>
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
