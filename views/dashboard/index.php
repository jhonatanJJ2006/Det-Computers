<main>

    <div class="dashboard__contenedor">
        
        <div class="dashboard__logo">
    
            <picture>
                <source srcset="<?php echo '/build/img/logo1.webp'?>" type="image/webp">
                <source srcset="<?php echo '/build/img/logo1.png'?>" type="image/png">
                <img class="dashboard__logo--imagen" src="<?php echo '/build/img/logo1.png'?>" alt="Imagen Logo">
            </picture>
            
        </div>
    
        <div class="dashboard__3d">
        <model-viewer
            class="dashboard__3d--tamaño"
            id="modelViewer"
            src="/build/img/3d/planeta.glb"
            camera-orbit="90deg 80deg 5"
            auto-rotate
            ar
            poster="/build/img/tierra.webp"
        ></model-viewer>
    
        </div>
    
        <div class="dashboard__frase">Construyendo tu presencia digital desde cero, pixel a pixel</div>
    
        <div class="dashboard__boton">
            <a class="dashboard__boton--watsap" href="https://api.whatsapp.com/send?phone=593985930530">
                <i class="fa-brands fa-whatsapp"></i>
                Contactenos
            </a>
        </div>
    
    </div>        

</main>


