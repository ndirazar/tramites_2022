<div class="container">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    @if ($generaTramite)
                        <h1>Cargar Trámite</h1>
                    @else
                        <h1>Sin Permisos para Crear Trámite</h1>
                    @endif
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.inicio')}}">Panel Control</a></li>
                        <li class="breadcrumb-item active">Cargar Trámite</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-start">
                <div class="col-md-12">
                    <div class="card" x-data="{ currentTab: $persist('profile') }">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills" wire:ignore>
                                <li @click.prevent="currentTab = 'profile'" class="nav-item"><a class="nav-link" :class="currentTab === 'profile' ? 'active' : ''" href="#profile" data-toggle="tab"><i class="fas fa-clipboard mr-1"></i> Trámite</a></li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane" :class="currentTab === 'profile' ? 'active' : ''" id="profile" wire:ignore.self>
                                    <form wire:submit.prevent="CrearNota" class="form-horizontal" autocomplete="off">
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label for="inputEmail" class="col-form-label">Título Nota</label>
                                                <input wire:model.defer="state.titulo" type="text" class="text-uppercase  form-control form-control-sm @error('titulo') is-invalid @enderror" id="titulo" placeholder="Título Nota">
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
                                                          class="text-uppercase form-control form-control-sm @error('descripcion') is-invalid @enderror"
                                                          cols="30" rows="3" wire:model.defer="state.descripcion">
                                                </textarea>
                                                @error('descripcion')
                                                <div class="invalid-feedback">
                                                    {{ $message}}
                                                </div>
                                                @enderror
                                            </div>

                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label for="nombre" class="col-form-label">Apellido y Nombre</label>
                                                <input wire:model.defer="state.nombre"
                                                       type="text"
                                                       class="text-uppercase form-control form-control-sm @error('nombre') is-invalid @enderror"
                                                       id="nombre" placeholder="Apellido y Nombre">
                                                @error('nombre')
                                                <div class="invalid-feedback">
                                                    {{ $message}}
                                                </div>
                                                @enderror
                                            </div>

                                            <div class="col-sm-6">
                                                <label for="telefono" class="col-form-label">Teléfono / Celular</label>
                                                <input wire:model.defer="state.telefono"
                                                       type="number" class="form-control form-control-sm @error('telefono') is-invalid @enderror"
                                                       id="telefono"
                                                       placeholder="Celular - Telefono">
                                                @error('telefono')
                                                <div class="invalid-feedback">
                                                    {{ $message}}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label for="dependencia_id" class="col-form-label">Oficina Destino</label>
                                                <select wire:model.defer="state.dependencia_id" class="form-control @error('dependencia_id') is-invalid @enderror">
                                                    <option value="">Selecionar un Area Destino</option>
                                                    @foreach ($dependencias as $dependencia)
                                                        <option value="{{ $dependencia->id }}">{{ $dependencia->nombre }}</option>
                                                    @endforeach
                                                </select>
                                                @error('dependencia_id')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="archivo" class="col-form-label">Archivo</label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="archivo">
                                                    <label class="custom-file-label" for="archivo">Seleccionar Archivo</label>
                                                  </div>
                                                  @error('archivo')
                                                    <div class="invalid-feedback">
                                                        {{ $message}}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                            <div class="form-group justify-content-between row">
                                                <div class="col-sm-6">
                                                    <button type="submit" class="btn btn-success"><i class="fa fa-save mr-1"></i> Grabar</button>
                                                </div>
                                            </div>
                                    </form>
                                </div>

                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

</div>

@push('styles')
<style>
    .profile-user-img:hover {
        background-color: blue;
        cursor: pointer;
    }
</style>
@endpush

@push('alpine-plugins')
<!-- Alpine Plugins -->
<script defer src="https://unpkg.com/@alpinejs/persist@3.x.x/dist/cdn.min.js"></script>
@endpush

@push('js')
{{-- <script>
    $(document).ready(function () {
        Livewire.on('nameChanged', (changedName) => {
            $('[x-ref="username"]').text(changedName);
        })
    });
</script> --}}

{{-- Focus and Select Value --}}

<script>
    $(document).ready(function () {
        setTimeout(function (){
        $('#titulo').focus().select();
    }, 100);
})
</script>

@endpush
















</div>
