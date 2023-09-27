<?php

function conectarDB() : mysqli {
    $db = new mysqli('localhost', 'root', 'hb17029980', 'bienesraices_crud');
    if(!$db) {
        echo "Error no se pudo conectar";
        exit;
    }

    return $db;
}