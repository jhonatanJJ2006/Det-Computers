<?php

namespace Model;

class Informacion extends ActiveRecord {
    protected static $tabla = 'informacion';
    protected static $columnasDB = ['id', 'nombre', 'imagen', 'sinopsis', 'genero', 'token', 'actores', 'año', 'clasificacion'];

    public $id;
    public $nombre;
    public $imagen;
    public $sinopsis;
    public $genero;
    public $token;
    public $actores;
    public $año;
    public $clasificacion;

    
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->sinopsis = $args['sinopsis'] ?? '';
        $this->genero = $args['genero'] ?? '';
        $this->token = $args['token'] ?? '';
        $this->actores = $args['actores'] ?? '';
        $this->año = $args['año'] ?? '';        
        $this->clasificacion = $args['clasificacion'] ?? '';        
    }

    // Generar un Token
    public function crearToken() : void {
        $this->token = uniqid();
    }

    public function validar() {
        if(!$this->nombre) {
            self::$alertas['error'][] = 'El Nombre de la Pelicula es Obligatorio';
        }
        if(!$this->imagen) {
            self::$alertas['error'][] = 'La Imagen de la Pelicula es Obligatoria';
        }
        if(!$this->sinopsis) {
            self::$alertas['error'][] = 'La Sinopsis de la Pelicula es Obligatoria';
        }
        if(!$this->genero) {
            self::$alertas['error'][] = 'El Género de la Pelicula es Obligatorio';
        }
        if(!$this->actores) {
            self::$alertas['error'][] = 'Los Actores de la Pelicula son Obligatorios';
        }
        if(!$this->año) {
            self::$alertas['error'][] = 'El Año de la Pelicula es Obligatoria';
        }
        if(!$this->clasificacion) {
            self::$alertas['error'][] = 'La Clasificacion de la Pelicula es Obligatoria';
        }
    }
}