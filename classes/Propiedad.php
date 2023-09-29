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

    // Conectar a la base de datos
    public static function setDB($database) {
        self::$db = $database;
    }

    // Constructor
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
        $this->vendedores_id = $args["vendedores_id"] ?? "1";
    }

    // Guarda los cambios realizados
    public function guardar() {
        if(!is_null($this->id)) {
            // Actualizar
            $this->actualizar();
        } else {
            // Insertar
            $this->crear();
        }
    }

    // Crea la propiedad en la base de datos
    public function crear() {

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

        // Mensaje de exito
        if($resultado) {
            // Redireccionar al usuario
            header("Location: /admin?resultado=1");
        }

    }

    // Actualiza la propiedad en la base de datos
    public function actualizar() {

        // Sanitizar los datos
        $atributos = $this->sanitizarAtributos();

        // Generar query
        $valores = [];
        foreach($atributos as $key => $value) {
            $valores[] = "{$key} = '{$value}'";
        }

        $query = "UPDATE propiedades SET ";
        $query .= join(", ", $valores);
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
        $query .= " LIMIT 1 ";

        // Actualizar en la base de datos
        $resultado = self::$db->query($query);

        if($resultado) {
            // Redireccionar al usuario
            header("Location: /admin?resultado=2");
        }
    }

    // Elimina la propiedad
    public function eliminar() {
        $query = "DELETE FROM propiedades WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
        $resultado = self::$db->query($query);

        if($resultado) {
            $this->borrarImagen();
            header("Location: /admin?resultado=3");
        }
    }

    // Toma las propiedades y las convierte en un objeto
    public function atributos() {
        $atributos = [];
        foreach(self::$columnasDB as $columna) {
            if($columna === "id") continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    // Sanitiza los datos
    public function sanitizarAtributos() {
        $atributos = $this->atributos();
        $sanitizado = [];
        foreach($atributos as $key => $value) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }
        return $sanitizado;
    }

    // Sube la imagen a la carpeta
    public function setImagen($imagen) {
        // Elimina la imagen previa
        if( !is_null($this->id) ) {
            $this->borrarImagen();
        }
        // Asignar al atributo de imagen el nombre de la imagen
        if($imagen) {
            $this->imagen = $imagen;
        }
    }

    // Elimina la imagen 
    public function borrarImagen() {
        $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);
        
        if($existeArchivo) {
            unlink(CARPETA_IMAGENES . $this->imagen);
        }
    }

    // Obtener los errores
    public static function getErrores() {
        return self::$errores;
    }

    // Valida los datos antes de guardarlos
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

    // Listar propiedades por id
    public static function find($id) {
        $query = "SELECT * FROM propiedades WHERE id = ${id}";
        $resultado = self::consultarSQL($query);

        // nos retorna el primer elemento del arreglo
        return array_shift($resultado);
    }

    // Consultar propiedades en base a un query
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

    // Crear un objeto en base a la consulta
    protected static function crearObjeto($registro) {
        $objeto = new self;

        foreach($registro as $key => $value) {
            if(property_exists($objeto, $key)) {
                $objeto->$key = $value;
            }
        }

        return $objeto;
    }

    // Sincroniza el objeto en memoria con los cambios realizados por el usuario
    public function sincronizar($args = []) {
        foreach($args as $key => $value) {
            if(property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value;
            }
        }
    }
    
}