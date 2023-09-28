<?php

define('TEMPLATES_URL', __DIR__ . DIRECTORY_SEPARATOR . 'templates');
define('FUNCIONES_URL', __DIR__ . 'funciones.php');
define('CARPETA_IMAGENES', realpath(__DIR__ . '/../imagenes/') . DIRECTORY_SEPARATOR);

function incluirTemplate( string $nombre, bool $inicio = false ) {
    include TEMPLATES_URL . "/${nombre}.php";
}

function estaAutenticado() {
    session_start();

    if($_SESSION['login']) {
        header("Location: /");
    } 

}

function debuguear( $variable ) {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// Escapa / sanitiza el HTML
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}