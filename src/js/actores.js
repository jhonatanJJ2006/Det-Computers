(function() {

    const actores = document.querySelector('#actores');
    const actores2 = document.querySelector('#actores2');
    const actoresHidden = document.querySelector('#actoresHidden');
    const tagsDiv = document.querySelector('.tagsDiv');
    const Btn = document.querySelector('.dashboard__btn');

    // Formulario
    const nombre = document.querySelector('[name="nombre"]');
    const sinopsis = document.querySelector('[name="sinopsis"]');
    const imagen = document.querySelector('[name="imagen"]');
    const genero = document.querySelector('[name="genero"]');
    const año = document.querySelector('[name="año"]');
    const clasificacion = document.querySelector('[name="clasificacion"]');

    if (actores) {

        let tags = [];

        actores.addEventListener('keypress', guardarTag)

        function guardarTag(e) {

            if (e.keyCode === 44) {

                if (e.target.value.trim() === '' || e.target.value < 3) {
                    return
                }

                e.preventDefault();

                tags = [...tags, e.target.value.trim()]

                actoresHidden.value = tags;

                e.target.value = '';

                mostrarActores();

            }

        }

        function mostrarActores() {
            tagsDiv.textContent = '';
            tags.forEach(tag => {
                const etiqueta = document.createElement('li');
                etiqueta.classList.add('formulario__tag');
                etiqueta.textContent = tag;
                etiqueta.ondblclick = eliminarTag
                tagsDiv.appendChild(etiqueta);
            });
        }

        function eliminarTag(e) {
            e.target.remove();
            tags = tags.filter(tag => tag !== e.target.textContent);
            actoresHidden.value = tags;
        }

        Btn.addEventListener('click', enviarPost)

        function enviarPost() {

            let errores = '';

            if (nombre.value.trim() === '') {
                errores += '<p class="alerta alerta__error">El campo Nombre está vacío</p>';
            }

            if (sinopsis.value.trim() === '') {
                errores += '<p class="alerta alerta__error">El campo Sinopsis está vacío</p>';
            }

            // Obtener el archivo de imagen seleccionado
            const archivo = imagen.files[0];

            if (!archivo) {
                errores += '<p class="alerta alerta__error">Debe seleccionar una imagen</p>';
            }

            if (genero.value.trim() === '') {
                errores += '<p class="alerta alerta__error">El campo Género está vacío</p>';
            }

            if (año.value.trim() === '') {
                errores += '<p class="alerta alerta__error">El campo Año está vacío</p>';
            }

            if (clasificacion.value.trim() === '') {
                errores += '<p class="alerta alerta__error">El campo Claisficación está vacío</p>';
            }

            if (actoresHidden.value.trim() === '') {
                errores += '<p class="alerta alerta__error">El campo Actores está vacío</p>';
            }

            if (errores !== '') {
                Swal.fire({
                    title: 'Errores',
                    html: errores,
                    icon: 'error',
                    showCloseButton: true,
                    showCancelButton: false,
                    focusConfirm: false,
                    confirmButtonText: 'Aceptar',
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33'
                });

            } else {

                Swal.fire({
                    title: 'Información guardada',
                    text: 'La información se ha guardado correctamente',
                    icon: 'success',
                    confirmButtonText: 'Aceptar',
                    confirmButtonColor: '#3085d6',
                    allowOutsideClick: false,
                    showCancelButton: false,
                }).then((result) => {
                    if (result.isConfirmed) {

                        const datos = new FormData();
                        datos.append('nombre', nombre.value.trim());
                        datos.append('sinopsis', sinopsis.value.trim());
                        datos.append('imagen', archivo);
                        datos.append('genero', genero.value.trim());
                        datos.append('año', año.value.trim());
                        datos.append('actores', actoresHidden.value.trim());
                        datos.append('clasificacion', clasificacion.value.trim());

                        fetch('/admin-1a4f6c7e8b9d2a5f1c8e0b6d4a9f3c2', {
                            method: 'POST',
                            body: datos
                        })
                            .then(respuesta => {
                                if (respuesta) {
                                    window.location.href = '/admin-tabla-1a4f6c7e8b9d2a5f1c8e0b6d4a9f3c2';
                                }
                            })

                    }
                });

            }

        }
        
    }
    
    if (actores2) {

        const imagenActual = document.querySelector('#imagen-actual').getAttribute('data-imagen');
        const id = document.querySelector('.id').getAttribute('data-id');

        let tags = [];
    
        const actoresEditados = actoresHidden.value.split(',');
    
        tags = actoresEditados;
    
        mostrarActores();
    
        actores2.addEventListener('keypress', guardarTag);
    
        function guardarTag(e) {
    
            if (e.keyCode === 44) {
    
                if (e.target.value.trim() === '' || e.target.value.length < 3) {
                    return;
                }
    
                e.preventDefault();
    
                tags = [...tags, e.target.value.trim()];
    
                actoresHidden.value = tags.join(',');
    
                e.target.value = '';
    
                mostrarActores();
    
            }
    
        }
    
        function mostrarActores() {
            tagsDiv.textContent = '';
            tags.forEach(tag => {
                const etiqueta = document.createElement('li');
                etiqueta.classList.add('formulario__tag');
                etiqueta.textContent = tag;
                etiqueta.ondblclick = eliminarTag;
                tagsDiv.appendChild(etiqueta);
            });
        }
    
        function eliminarTag(e) {
            e.target.remove();
            tags = tags.filter(tag => tag !== e.target.textContent);
            actoresHidden.value = tags.join(',');
        }    

    }

})();
