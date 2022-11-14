<?php
    class Pelicula {
        public $id;
        public $titulo;
        public $genero;
        public $caratula;
        public $banner;
        public $fecha;
        public $adultos;
        public $descripcion;
        public $nota;

        public function __construct($id, $titulo, $genero, $caratula, $banner, $fecha, $adultos, $descripcion, $nota) {
            
            $this->id = $id;
            $this->titulo = $titulo;
            $this->genero = $genero;
            $this->caratula = $caratula;
            $this->banner = $banner;
            $this->fecha = $fecha;
            $this->adultos = $adultos;
            $this->descripcion = $descripcion;
            $this->nota = $nota;

        }

        public function __get ($propiedad) {
            return $this->$propiedad;
        }

        /**
         * Muestra trait Bienvenida->zoologico() y atributos de todos los animales, 
         * luego llama al metodo sonido()
         */
        public function __toString() {
            return $this->zoologico()." $this->nombre, $this->patas patas, ".$this->sonido();
        }
    }

