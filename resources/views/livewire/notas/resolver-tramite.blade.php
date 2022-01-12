{{-- Resolver Trámite Modal--}}
<div wire:ignore.self class="modal fade bd-example-modal-md" id="resolverModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title w-100 text-center" id="exampleModalLabel">Terminar Trámite</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col-md-12 ">
                            <label for="monto">Observaciones</label>
                            <div class="form-group">
                                    <textarea class="form-control form-control-sm text-uppercase"
                                              wire:model.defer="observaciones"
                                              id="observaciones" rows="5" maxlength ="255"
                                              widht="500px">
                                    </textarea>
                                     @error('observaciones') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="cancelarTramite" class="btn btn-danger"
                    data-dismiss="modal">Cerrar</button>
                <button type="button" wire:click.prevent="resolverTramite({{$notas->id}})" class="btn btn-primary"
                    data-dismiss="modal">Guardar</button>
            </div>
        </div>
    </div>
</div>
@push('scripts')

{{-- Focus and Select Value --}}

<script>
    $('#resolverModal').on('shown.bs.modal', function () {
    setTimeout(function (){
        $('#observaciones').focus().select();
    }, 100);
})
</script>

@endpush


