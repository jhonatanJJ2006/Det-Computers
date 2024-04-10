(function() {

    const eliminarBtn = document.querySelectorAll('.table__accion--logout');

    if(eliminarBtn) {

        eliminarBtn.forEach(btn => {
            btn.addEventListener('click', eliminarInformacion);
        })

        function eliminarInformacion(e) {
            const id = e.target.getAttribute('data-id');
        
            Swal.fire({
                title: '¿Seguro que quieres eliminar?',
                text: "Esta acción no se puede deshacer",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if(result.isConfirmed) {
                    const datos = new FormData();
                    datos.append('id', id);
        
                    fetch('/admin/info/eliminar-1a4f6c7e8b9d2a5f1c8e0b6d4a9f3c2', {
                        method: 'POST',
                        body: datos
                    })
                    .then(respuesta => {
                        if (respuesta) {
                            Swal.fire({
                                title: 'Eliminado!',
                                text: 'Tu archivo ha sido eliminado.',
                                icon: 'success',
                                allowOutsideClick: false, 
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'Ok'
                            })
                            .then((result) => {
                                if (result.isConfirmed) {
                                    window.location.reload();
                                }
                            });
                        }
                    });
                    
                }
            });
        }

    }

})();