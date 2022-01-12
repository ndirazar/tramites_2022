<div class="container">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Configuraciones</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.inicio')}}">Panel Control</a></li>
                        <li class="breadcrumb-item active">Configuracion</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Ajustes Generales</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form wire:submit.prevent="updateSetting">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6 col-12-xs">
                                        <div class="form-group">
                                            <label for="siteName">Nombre Sitio</label>
                                            <input wire:model.defer="state.site_name" type="text" class="form-control" id="siteName" placeholder="Enter site name">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="siteEmail">Email</label>
                                            <input wire:model.defer="state.site_email" type="email" class="form-control" id="siteEmail" placeholder="Email Principal">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="siteTitle">Título Sitio</label>
                                            <input wire:model.defer="state.site_title" type="text" class="form-control" id="siteTitle" placeholder="Enter site title">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="footerText">Pie Texto</label>
                                            <input wire:model.defer="state.footer_text" type="text" class="form-control" id="footerText" placeholder="Texto Pie Página">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="nroNota">Nro Nota Siguiente</label>
                                            <input wire:model.defer="state.nroNota" type="text" class="form-control" id="nroNota" placeholder="Ingreso Nro Nota Siguiente">
                                        </div>
                                    </div>
                                    <div class="col-6 mt-5">
                                        <div class="form-group">
                                            <div class="custom-control custom-switch">
                                                <input wire:model.defer="state.sidebar_collapse" type="checkbox" class="custom-control-input" id="sidebarCollapse">
                                                <label class="custom-control-label" for="sidebarCollapse">Sidebar Colapsar</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-save mr-1"></i>Guardar Cambios</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@push('js')
<script>
    $('#sidebarCollapse').on('change', function() {
        $('body').toggleClass('sidebar-collapse');
    })
</script>
@endpush
