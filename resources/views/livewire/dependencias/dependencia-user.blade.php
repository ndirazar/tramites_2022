<div class="container">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Dependencias - Usuarios</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                        <li class="breadcrumb-item active">Oficinas - Usuarios</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="row justify-content-end mr-1">
                            <div>
                                <button wire:click.prevent="newAsignacion" class="btn btn-success m-2 text-center">
                                <i class="fa fa-plus-circle mr-2"></i>Asignar Oficina a Usuario</button>
                            </div>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table table-sm table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">
                                            Area / Oficina
                                            <span wire:click="sortBy('name')" class="float-right text-sm"
                                                style="cursor: pointer;">
                                            </span>
                                        </th>
                                        <th scope="col" class="text-left">Usuario</th>
                                        <th scope="col" class="text-center">Principal</th>

                                        <th scope="col" class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody wire:loading.class="text-muted">
                                    @forelse ($depUsers as $index => $depUser)
                                        <tr>
                                            <th scope="row">{{ $depUsers->firstItem() + $index }}</th>
                                            <td>
                                                {{ $depUser->nombre }}
                                            </td>
                                            <td class="text-left text-uppercase">
                                                {{ $depUser->name }}
                                            </td>
                                            <td class="text-center">
                                                <input type="checkbox" {{ $depUser->principal  ? 'checked' : ''}}>
                                            </td>

                                            <td class="text-center">
                                                <a href="" >
                                                    <i class="fa fa-edit mr-2"></i>
                                                </a>
                                                <a href="" wire:click.prevent="confirmarEliminacion({{$depUser}})">
                                                    <i class="fa fa-trash text-danger"></i>
                                                </a>

                                            </td>
                                        </tr>
                                    @empty
                                        <tr class="text-center">
                                            <td colspan="5">
                                                <p class="mt-2">No se han encontrado resultados</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer d-flex justify-content-center">
                            {{ $depUsers->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Asignacion -->
    <div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog " role="document">
            <form autocomplete="off" wire:submit.prevent="asignarOficina">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            <span>Asignar Usuario a un Oficina</span>
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nombre">Usuario</label>
                            <select class="custom-select @error('user_id') is-invalid @enderror" wire:model.defer="state.user_id">
                                <option value="" selected="selected">Seleccione un Usuario</option>
                                @foreach ($usuarios as $usuario)
                                        <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
                                @endforeach
                            </select>
                            @error('user_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="dependencia_id">Area - Oficina</label>
                            <select class="custom-select @error('dependencia_id') is-invalid @enderror" wire:model.defer="state.dependencia_id">
                                <option value="" selected="selected">Seleccione un Area</option>
                                @foreach ($oficinas as $key => $value)
                                    <option value="{{ $key }}">{{ $value }} </option>
                                @endforeach
                            </select>
                            @error('dependencia_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-check">
                            <input wire:model.defer="principal" type="checkbox" class="form-check-input" id="principal">
                            <label class="form-check-label" for="labelPrincipal">Oficina Principal?</label>
                          </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal"><i class="fa fa-times mr-1"></i> Cerrar</button>
                        <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-save mr-1"></i>
                            <span>Guardar Cambios</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Delete User</h5>
                </div>

                <div class="modal-body">
                    <h4>¿Seguro que desea Eliminar el Usuario?</h4>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times mr-1"></i> Cerrar</button>
                    <button type="button" wire:click.prevent="EliminarAsignacion" class="btn btn-danger"><i class="fa fa-trash mr-1"></i>Guardar Cambios</button>
                </div>
            </div>
        </div>
    </div>





</div>
{{-- Set focus Nombre en el Modal --}}
@push('scripts-developer')
    <script>
        $('#form').on('shown.bs.modal', function () {
            $('#usuario').trigger('focus').select();
        })
    </script>
@endpush
