<div class="dashboard__height">

    <div class="dashboard__contenedor">

        <h2 class="dashboard__heading"><?php

use Model\Informacion;

 echo $titulo ?></h2>

        <div class="admin__contenedor-boton">
            <a class="admin__boton" href="/admin-1a4f6c7e8b9d2a5f1c8e0b6d4a9f3c2">
                <i class="fa-solid fa-circle-plus"></i>
                Añadir Pelicula
            </a>
        </div>

        <div class="admin__contenedor">
            <?php if(!empty($informacion)) { ?>
                <table class="table">
                    <thead class="table__thead">
                        <tr>
                            <th class="table__th-display" scope="col">infos</th>
                            <th class="table__th" scope="col">Imagen</th>
                            <th class="table__th" scope="col">Nombre</th>
                            <th class="table__th" scope="col">Sinopsis</th>
                            <th class="table__th" scope="col">Año</th>
                            <th class="table__th" scope="col">Clasificación</th>
                            <th class="table__th" scope="col">Token</th>
                            <th class="table__th table__th--acciones" scope="col">Acciones</th>
                        </tr>
                    </thead>

                    <tbody class="table__tbody">
                        <?php foreach($informacion as $info) { ?>
                            <tr class="table__tr">

                                <td class="table__td">
                                    <div class="formulario__imagen">
                                        <picture>
                                            <source srcset="<?php echo '/build/img/peliculas/' . $info->imagen . '.webp'?>" type="image/webp">
                                            <source srcset="<?php echo '/build/img/peliculas/' . $info->imagen . '.png'?>" type="image/png">
                                            <img class="formulario__imagen--table" src="<?php echo '/build/img/peliculas/' . $info->imagen . '.png'?>" alt="Imagen info">
                                        </picture>
                                    </div>
                                </td>

                                <td class="table__td">
                                    <?php echo $info->nombre ?? '' ?>
                                </td>

                                <td class="table__td--eventos">
                                    <?php echo $info->sinopsis ?? '' ?>
                                </td>

                                <td class="table__td">
                                    <?php echo $info->año ?? '' ?>
                                </td>

                                <td class="table__td">
                                    <?php echo $info->clasificacion ?? '' ?>
                                </td>

                                <td class="table__td">
                                    <?php echo $info->token ?? '' ?>
                                </td>

                                <td class="table__td--acciones" style="text-align: center;">
                                    <div class="table__td--flex">    

                                        <a class="table__accion--editar" href="/admin-editar-1a4f6c7e8b9d2a5f1c8e0b6d4a9f3c2?id=<?php echo $info->id ?>">
                                            <i class="fa-solid fa-user-pen"></i>
                                            Editar
                                        </a>

                                        <div data-id="<?php echo $info->id ?>" class="table__accion--logout">
                                            <i class="fa-solid fa-circle-xmark"></i>
                                            Eliminar
                                        </div>
                                        
                                    </div>
                                </td>

                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php } else { ?>    
                <p class="text-center">No hay Peliculas Aún</p>
            <?php } ?>    
        </div>

        <?php
            echo $paginacion;
        ?>
        
    </div>
    
</div>

<?php if(isset($_SESSION['mensaje'])) { 
    $mensaje = $_SESSION['mensaje']; 

    $pelicula = Informacion::where('token', $mensaje);

    unset($_SESSION['mensaje']); ?>

    <script>
        Swal.fire({
            title: 'Token: <?php echo $mensaje; ?>',
            html:
                '<div style="font-size: 1.2em; text-align:left; margin:0 auto; paddin:2rem;">' +
                    '<strong style="font-size: 1.2em; font-weight:bold;">Nombre:</strong> <span style="color: #1E293B;"><?php echo $pelicula->nombre; ?></span><br>' +
                    '<strong style="font-size: 1.2em; font-weight:bold;">Sinopsis:</strong> <span style="color: #1E293B;"><?php echo $pelicula->sinopsis; ?></span><br>' +
                    '<strong style="font-size: 1.2em; font-weight:bold;">Género:</strong> <span style="color: #1E293B;"><?php echo $pelicula->genero; ?></span><br>' +
                    '<strong style="font-size: 1.2em; font-weight:bold;">Actores:</strong> <span style="color: #1E293B;"><?php echo $pelicula->actores; ?></span><br>' +
                    '<strong style="font-size: 1.2em; font-weight:bold;">Año:</strong> <span style="color: #1E293B;"><?php echo $pelicula->año; ?></span><br>' +
                    '<strong style="font-size: 1.2em; font-weight:bold;">Clasificación:</strong> <span style="color: #1E293B;"><?php echo $pelicula->clasificacion; ?></span><br>' +
                '</div>',
            icon: 'success',
            showConfirmButton: true,
            allowOutsideClick: false
        }).then(() => {
            window.location.href = window.location.href;
        });
    </script>

<?php } ?>
