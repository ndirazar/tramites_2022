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
                        <li class="breadcrumb-item active"><a href="{{route('admin.notas.list')}}">Trámites</a></li>
                        <li class="breadcrumb-item active">Ver Trámite</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    @include('livewire.notas.resolver-tramite',['notas' => $notas])
    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <h4 class='text-primary mr-2'>Trámite Nro : </h4>
                        <h4 class='text-dark'>{{ $notas->id }}</h4>
                    </div>
                    <div class="row">
                        <h4 class='text-secondary'>{{ $notas->titulo }}
                        <h4 class="ml-2 text-success text-bold"> {{$finalizado ? ' - FINALIZADO' : ''}}</h4>
                    </div>
                </div>
                <div class="card-body">
                    <form>
                        <legend class="col-form-legend col-form-legend-sm text-info ">Información Adicional</legend>
                        <div class="row mt-2">
                            <div class="col-sm-6">
                                <label for="inputEmail" class="col-form-label">Título Nota</label>
                                <input  wire:model.defer="state.titulo" type="text" class="text-uppercase  form-control form-control-sm @error('titulo') is-invalid @enderror" id="titulo" placeholder="Título Nota">
                                @error('titulo')
                                    <div class="invalid-feedback">
                                        {{ $message}}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <label for="descripcion" class="col-form-label">Descripción</label>
                                <textarea name="descripcion"
                                          id="descripcion"
                                          wire:model.defer="state.descripcion"
                                          class="text-uppercase text-left form-control form-control-sm
                                          @error('descripcion') is-invalid
                                          @enderror" cols="30" rows="3"></textarea>
                                @error('descripcion')
                                <div class="invalid-feedback">
                                    {{ $message}}
                                </div>
                                @enderror
                            </div>

                            <div class="col-sm-6">
                                <div class="mb-1">
                                    <label for="disabledTextInput" class="form-label col-form-label-sm">Apellido y
                                        Nombre</label>
                                    <input class="form-control form-control-sm text-uppercase" type="text"
                                        wire:model.defer="state.nombre" aria-label="readonly input example">
                                </div>
                                <div class="mb-1">
                                    <label for="disabledTextInput" class="form-label col-form-label-sm">Area / Oficina
                                        Destino</label>
                                    <input class="form-control form-control-sm" type="text"
                                        value="{{ $notas->oficina }}" aria-label="readonly input example" disabled
                                        readonly>
                                </div>
                                <div class="mb-1">
                                    <label for="disabledTextInput" class="form-label col-form-label-sm">Archivo
                                        digital</label>
                                    <input type="text" id="disabledTextInput" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-1">
                                    <label for="disabledTextInput" class="form-label col-form-label-sm">Télefono /
                                        Celular</label>
                                    <input class="form-control form-control-sm" type="text"
                                           wire:model.defer="state.telefono" aria-label="input example">
                                </div>
                                <div class="mb-1">
                                    <label for="disabledTextInput" class="form-label col-form-label-sm">Estado</label>
                                    <input
                                        class="form-control form-control-sm
                                        {{ $finalizado ? 'bg-success' : ($notas->estado_id===1 ? 'bg-info': 'bg-danger') }}"
                                        type="text" value="{{ $notas->estados }}" aria-label="input example bg"
                                        readonly>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
                {{-- End Card-Body --}}
                <div class="row">
                    {{-- Boton Guardar Trámite --}}
                    <div class="col-6 text-center">
                        <button class="btn btn-sm btn-success mb-3" wire:click.prevent="EditarNota">
                            Grabar Cambios
                            <i class="fas fa-check-double text-right ml-2"></i>
                        </button>

                    </div>
                    {{-- Boton Reenviar --}}
                    <div class="col-6 text-center">
                        <a href="{{ route('admin.notas.list') }}" class="btn btn-sm btn-warning mb-3">
                            Volver
                            <i class="fas fa-share text-right ml-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-confirmation-alert />
</div>
