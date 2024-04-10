<?php 

namespace Controllers;

use Classes\Paginacion;
use Intervention\Image\ImageManagerStatic as Image;
use Model\Informacion;
use MVC\Router;

class AdminController {

    public static function index(Router $router) {

        session_start();

        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            try {

                $datos = $_POST;
                $informacion = new Informacion($datos);

                if(isset($_FILES['imagen']) && !empty($_FILES['imagen']['tmp_name'])) {
                    $carpeta_imagenes = '../public/build/img/peliculas';
                
                    // Crear la carpeta si no existe
                    if(!is_dir($carpeta_imagenes)) {
                        mkdir($carpeta_imagenes, 0755, true);
                    }
                
                    $imagen_png = Image::make($_FILES['imagen']['tmp_name'])->encode('png',80);
                    $imagen_webp = Image::make($_FILES['imagen']['tmp_name'])->encode('webp',80);
                
                    $nombre_imagen = md5(uniqid(rand(), true));
    
                    $informacion->imagen = $nombre_imagen;
                }             

                $informacion->crearToken();

                $alertas = $informacion->validar();

                if(empty($alertas)) {

                    // Guardar las imagenes
                    $imagen_png->save($carpeta_imagenes . '/' . $nombre_imagen . ".png");
                    $imagen_webp->save($carpeta_imagenes . '/' . $nombre_imagen . ".webp");

                    // Guardar en la base de datos
                    $resultado = $informacion->guardar();
                    echo json_encode($resultado);

                    $_SESSION['mensaje'] = $informacion->token;
                }

            } catch (\Throwable $th) {
                echo json_encode([
                    'resultado' => 'error'
                ]);
            }            
                
        }

        $router->render('/admin/index', [
            'titulo' => 'Formulario para Peliculas'
        ]);
    }

    public static function tabla(Router $router) {

        session_start();

        $pagina_actual = $_GET['page'];
        $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);
        
        $registros_por_pagina = 15;
        $total = Informacion::total();
        $paginacion = new Paginacion($pagina_actual, $registros_por_pagina, $total);

        
        if(!$pagina_actual || $pagina_actual < 1) {
            header('location: /admin-tabla-1a4f6c7e8b9d2a5f1c8e0b6d4a9f3c2?page=1');
        }
        
        $informacion = Informacion::paginar($registros_por_pagina, $paginacion->offset());

        $router->render('admin/tabla', [
            'titulo' => 'Peliculas',
            'informacion' => $informacion,
            'paginacion' => $paginacion->paginacion()
        ]);
    }

    public static function editar(Router $router) {

        session_start();

        $id = s($_GET['id']);
        if(!$id) {
            header('Location: /admin-1a4f6c7e8b9d2a5f1c8e0b6d4a9f3c2');
        }

        $informacion = Informacion::find($id);
        if(!$informacion) {
            header('Location: /admin-1a4f6c7e8b9d2a5f1c8e0b6d4a9f3c2');
        }        

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            // Leer Imagen
            if(!empty($_FILES['imagen']['tmp_name'])) {
                $carpeta_imagenes = '../public/build/img/peliculas';

                // Crear la carpeta si no existe
                if(!is_dir($carpeta_imagenes)) {
                    mkdir($carpeta_imagenes, 0755, true);
                }
                
                $imagen_png = Image::make($_FILES['imagen']['tmp_name'])->encode('png',80);
                $imagen_webp = Image::make($_FILES['imagen']['tmp_name'])->encode('webp',80);
                
                $nombre_imagen = md5(uniqid(rand(), true));
                
                $_POST['imagen'] = $nombre_imagen;
                
                unlink(__DIR__ . '/' . $carpeta_imagenes . '/' . $informacion->imagen . '.png');
                unlink(__DIR__ . '/' . $carpeta_imagenes . '/' . $informacion->imagen . '.webp');

            } else {
                $_POST['imagen'] = $informacion->imagen_actual;
            }

            $informacion->sincronizar($_POST);

            $alertas = $informacion->validar();

            if(empty($alertas)) {
                if(isset($nombre_imagen)) {
                    $imagen_png->save($carpeta_imagenes . '/' . $nombre_imagen . ".png");
                    $imagen_webp->save($carpeta_imagenes . '/' . $nombre_imagen . ".webp");    
                }

                $resultado = $informacion->guardar();

                $_SESSION['mensaje'] = $informacion->token;

                if($resultado) {
                    header('location: /admin-tabla-1a4f6c7e8b9d2a5f1c8e0b6d4a9f3c2');
                }
            }
        }

        $router->render('admin/editar', [
            'titulo' => 'Editar la Informacion de la Pelicula',
            'informacion' => $informacion
        ]);
    }

    public static function eliminar() {

        $carpeta_imagenes = '../public/build/img/peliculas';

        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            try {

                $id = $_POST['id'];

                $informacion = Informacion::find($id);

                unlink(__DIR__ . '/' . $carpeta_imagenes . '/' . $informacion->imagen . '.png');
                unlink(__DIR__ . '/' . $carpeta_imagenes . '/' . $informacion->imagen . '.webp');

                $resultado = $informacion->eliminar();
                echo json_encode($resultado);

            } catch (\Throwable $th) {
                echo json_encode([
                    'resultado' => 'error'
                ]);
            }   
        }    
    }
}