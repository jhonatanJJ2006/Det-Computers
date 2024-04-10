<main class="dashboard">

    <div class="dashboard__contenedor">

        <div class="dashboard__contenedor2">
            <h2 class="dashboard__heading"><?php echo $titulo ?></h2> 
            
            <div class="admin__contenedor-boton">
                <a class="admin__boton" href="/admin-tabla-1a4f6c7e8b9d2a5f1c8e0b6d4a9f3c2">
                    <
                    Volver
                </a>
            </div>
                
            <?php include_once __DIR__ . '/../../templates/alertas.php' ?>
            
            <form class="formulario-admin" enctype="multipart/form-data" method="POST">
                
                <fieldset class="formulario__fieldset">
            
                    <legend class="formulario__legend">Información</legend>
            
                    <div class="formulario__campo">
                        <label class="formulario__label" for="nombre">Nombre</label>
                        <input class="formulario__input" id="nombre" type="text" placeholder="Nombre de la Pelicula" name="nombre" value="<?php echo $informacion->nombre ?? '' ?>">
                    </div>

                    <div class="formulario__campo">
                        <label class="formulario__label" for="sinopsis">Sinopsis</label>
                        <textarea id="sinopsis" class="formulario__input" name="sinopsis" rows="15" placeholder="Sinopsis de la Pelicula"><?php echo $informacion->sinopsis ?? '' ?></textarea>
                    </div>
                    
                    <div class="formulario__campo">
                        <label class="formulario__label" for="imagen">Imagen</label>
                        <input class="formulario__input formulario__input--file" id="imagen" type="file" name="imagen">
                    </div>

                    <?php
                        if($informacion->imagen) { ?>
                            <p id="imagen-actual" data-imagen="<?php echo $informacion->imagen ?>" class="formulario__label">Imagen Actual:</p>

                            <div class="formulario__imagen">
                                <picture>
                                    <source srcset="<?php echo '/build/img/peliculas/' . $informacion->imagen . '.webp'?>" type="image/webp">
                                    <source srcset="<?php echo '/build/img/peliculas/' . $informacion->imagen . '.png'?>" type="image/png">
                                    <img src="<?php echo '/build/img/peliculas/' . $informacion->imagen . '.png'?>" alt="Imagen producto">
                                </picture>
                            </div>
                        <?php }
                    ?>

                    <div class="formulario__campo">
                        <label class="formulario__label" for="genero">Género</label>
                        <input class="formulario__input" id="genero" type="text" placeholder="Genero de la Pelicula" name="genero" value="<?php echo $informacion->genero ?? '' ?>">
                    </div>    

                    <div class="formulario__campo">
                        <label class="formulario__label" for="actores2">Actores (Separar por comas)</label>
                        <input class="formulario__input" id="actores2" type="text" placeholder="Actores de la Pelicula">
                        <input id="actoresHidden" type="hidden" name="actores" value="<?php echo $informacion->actores ?>">
                        <div class="formulario__tagsDiv tagsDiv"></div>
                    </div>            

                    <div class="formulario__campo">
                        <label class="formulario__label" for="año">Año</label>
                        <input class="formulario__input" id="año" type="number" placeholder="Año de la Pelicula" name="año" value="<?php echo $informacion->año ?? '' ?>">
                    </div>        

                    <div class="formulario__campo">
                        <label class="formulario__label" for="clasificacion">Clasificacion</label>
                        <select class="formulario__input" name="clasificacion" id="clasificacion">
                            <option disabled selected value="">-- Seleccionar una Categoria --</option>
                            <option <?php echo ($informacion->clasificacion == 'A') ? 'selected' : '' ?> value="A">Categoria "A"</option>
                            <option <?php echo ($informacion->clasificacion == 'B') ? 'selected' : '' ?> value="B">Categoria "B"</option>
                            <option <?php echo ($informacion->clasificacion == 'C') ? 'selected' : '' ?> value="C">Categoria "C"</option>
                        </select>
                    </div>        
                    
                    <div data-id="<?php echo $informacion->id ?>" class="id"></div>
            
                </fieldset>

                <input class="dashboard__btn" type="submit" value="Registrar Pelicula">            
            
            </form>

        </div>
        
    </div>

</main>

