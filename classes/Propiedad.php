<?php

namespace App;

class Propiedad {

    // Base de datos
    protected static $db;
    protected static $columnasDB = [
        "id",
        "titulo",
        "precio",
        "imagen",
        "descripcion",
        "habitaciones",
        "wc",
        "estacionamiento",
        "creado",
        "vendedores_id"
    ];

    // Errores
    protected static $errores = [];
    
    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamiento;
    public $creado;
    public $vendedores_id;

    /**
     * Define la conexion a la base de datos
     * @param object $database
     * @return void
     */
    public static function setDB($database) {
        self::$db = $database;
    }

    /**
     * Constructor de la clase
     * @param array $args Arreglo asociativo con propiedades de la clase
     * @return void
     */
    public function __construct($args = []) {
        $this->id = $args["id"] ?? null;
        $this->titulo = $args["titulo"] ?? "";
        $this->precio = $args["precio"] ?? "";
        $this->imagen = $args["imagen"] ?? "";
        $this->descripcion = $args["descripcion"] ?? "";
        $this->habitaciones = $args["habitaciones"] ?? "";
        $this->wc = $args["wc"] ?? "";
        $this->estacionamiento = $args["estacionamiento"] ?? "";
        $this->creado = date("Y/m/d");
        $this->vendedores_id = $args["vendedores_id"] ?? "";
    }

    /**
     * Guarda una propiedad en la base de datos
     * @return void
     */
    public function guardar() {

        // Sanitizar los datos
        $atributos = $this->sanitizarAtributos();

        // Generar query
        $query = "INSERT INTO propiedades ( ";
        $query .= join(", ", array_keys($atributos));
        $query .= " ) VALUES ( '";
        $query .= join("', '", array_values($atributos));
        $query .= "' ) ";
        
        // Insertar en la base de datos
        $resultado = self::$db->query($query);

        return $resultado;

    }

    /**
     * Toma las propiedades y las convierte en un objeto
     * @param array $propiedad
     * @return object
     */
    public function atributos() {
        $atributos = [];
        foreach(self::$columnasDB as $columna) {
            if($columna === "id") continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

   /**
    * Sanitiza los datos
    * @return array
    */
    public function sanitizarAtributos() {
        $atributos = $this->atributos();
        $sanitizado = [];
        foreach($atributos as $key => $value) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }
        return $sanitizado;
    }

    /**
     * Sube la imagen al servidor
     * @param string $nombreImagen
     * @return void
     */
    public function setImagen($imagen) {
        // Elimina la imagen previa
        // if(!is_null($this->id)) {
        //     $this->borrarImagen();
        // }

        // Asignar al atributo de imagen el nombre de la imagen
        if($imagen) {
            $this->imagen = $imagen;
        }
    }

    /**
     * Obtener Errores
     * @return array
     */
    public static function getErrores() {
        return self::$errores;
    }

    /**
     * Valida los datos antes de guardarlos
     * @return array
     */
    public function validar() {

        if(!$this->titulo) {
            self::$errores[] = "Debes añadir un titulo";
        }

        if(!$this->precio) {
            self::$errores[] = "El precio es obligatorio";
        }

        if(strlen($this->descripcion) < 50) {
            self::$errores[] = "La descripcion es obligatoria y debe tener al menos 50 caracteres";
        }

        if(!$this->habitaciones) {
            self::$errores[] = "El numero de habitaciones es obligatorio";
        }

        if(!$this->wc) {
            self::$errores[] = "El numero de baños es obligatorio";
        }

        if(!$this->estacionamiento) {
            self::$errores[] = "El numero de estacionamientos es obligatorio";
        }

        if(!$this->vendedores_id) {
            self::$errores[] = "Elige un vendedor";
        }

        if(!$this->imagen) {
             self::$errores[] = "La imagen es obligatoria";
        }

        return self::$errores;
    }

    // Listar todas las propiedades
    public static function all() {
        $query = "SELECT * FROM propiedades";
        $resultado = self::consultarSQL($query);
        
        return $resultado;
    }

    /**
     * Consulta propiedades de la base de datos
     * @param $query
     * @return array
     */
    public static function consultarSQL($query) {
        // Consultar la base de datos
        $resultado = self::$db->query($query);

        // Iterar los resultados
        $array = [];
        while($registro = $resultado->fetch_assoc()) {
            $array[] = self::crearObjeto($registro);
        }

        // Liberar la memoria
        $resultado->free();

        // Retornar los resultados
        return $array;
    }

    /**
     * Crear un objeto en base a una consulta
     * @param array $registro
     * @return object
     */
    protected static function crearObjeto($registro) {
        $objeto = new self;

        foreach($registro as $key => $value) {
            if(property_exists($objeto, $key)) {
                $objeto->$key = $value;
            }
        }

        return $objeto;
    }

}