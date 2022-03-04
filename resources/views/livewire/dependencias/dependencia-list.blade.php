<div class="container">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Oficinas</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.inicio')}}">Panel Control</a></li>
                        <li class="breadcrumb-item active">Oficinas</li>
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
                    <div class="d-flex justify-content-between mb-2">
                        <button wire:click.prevent="addNew"
                                class="btn btn-success">
                                    <i class="fa fa-plus-circle mr-1"></i>
                                Nueva Oficina
                        </button>
                        <x-search-input wire:model="searchTerm" />
                    </div>
                    <div class="card">
                        <div class="card-body table-responsive">
                            <table class="table table-sm table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">
                                            Area / Oficina
                                            <span wire:click="sortBy('name')" class="float-right text-sm" style="cursor: pointer;">
                                            </span>
                                        </th>
                                        <th scope="col" class="text-center">
                                            Genera Trámite
                                            <span class="float-right text-sm" style="cursor: pointer;">
                                            </span>
                                        </th>
                                        <th scope="col" class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody wire:loading.class="text-muted">
                                    @forelse ($dependencias as $index => $dependencia)
                                    <tr>
                                        <th scope="row">{{ $dependencias->firstItem() + $index }}</th>
                                        <td>
                                            {{ $dependencia->nombre }}
                                        </td>
                                        <td class="text-center">
                                             <input type="checkbox" {{$dependencia->genera_tramite ? 'checked' : ''}}>
                                        </td>
                                            <td class="text-center">
                                                <a href="" wire:click.prevent="editaDependencia({{ $dependencia }})">
                                                    <i class="fa fa-edit mr-2"></i>
                                                </a>
                                            <a href="" >
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
                        <div class="card-footer d-flex justify-content-end">
                            {{ $dependencias->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content -->

    <!-- Modal -->
    <div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog" role="document">
            <form autocomplete="off" wire:submit.prevent="{{ $showEditModal ? 'updateDependencia' : 'createDependencia' }}">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            @if($showEditModal)
                            <span>Edit User</span>
                            @else
                            <span>Add New User</span>
                            @endif
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nombre">Nombre Area / Oficina</label>
                            <input type="text" wire:model.defer="state.nombre"
                            class="form-control form-control-sm text-uppercase @error('nombre') is-invalid @enderror"
                            id="nombre" aria-describedby="nombre" placeholder="Ingrese Nombre Oficina">
                            @error('nombre')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="genera_tramite">Genera Trámite</label>
                            <select id="genera_tramite" class="form-control form-control-sm
                                    @error('genera_tramite') is-invalid @enderror"
                                    wire:model.defer="state.genera_tramite">
                                <option value=1>Si</option>
                                <option value=0>No</option>
                            </select>
                            @error('genera_tramite')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal"><i class="fa fa-times mr-1"></i> Cerrar</button>
                        <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-save mr-1"></i>
                            @if($showEditModal)
                            <span>Guardar Cambios</span>
                            @else
                            <span>Grabar</span>
                            @endif
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Set focus Nombre en el Modal --}}
@push('scripts-developer')
    <script>
        $('#form').on('shown.bs.modal', function () {
            $('#nombre').trigger('focus').select();
        })
    </script>
@endpush

