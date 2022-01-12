@push('js')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>
  window.addEventListener('show-delete-confirmation', event => {
    Swal.fire({
      title: '¿Seguro desea Eliminar?',
      text: "Los cambios no se pueden deshacer",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cerrar',
      confirmButtonText: 'Si'
    }).then((result) => {
      if (result.isConfirmed) {
        Livewire.emit('deleteConfirmed')
      }
    })
  })

  window.addEventListener('deleted', event => {
    Swal.fire(
      'Deleted!',
      event.detail.message,
      'success'
    )
  })
</script>
<script>
  window.addEventListener('confirmation-resolver-tramite', event => {
      Swal.fire({
        title: 'Desea Resolver este Trámite?',
        text: "Los cambios no se pueden deshacer",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cerrar',
        confirmButtonText: 'Si'
      }).then((result) => {
        if (result.isConfirmed) {
          Livewire.emit('resueltoTramite')
        }
      })
    })

    window.addEventListener('resuelto', event => {
      Swal.fire(
        'Trámite Resuelto!',
        event.detail.message,
        'success'
      )
    })

    window.addEventListener('sinObservaciones', event => {
      Swal.fire(
        'Debe contener una Observación!',
        event.detail.message,
        'warning'
      )
    })

  </script>
@endpush
