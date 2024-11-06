<?php
    $conexion = @mysqli_connect(
        'localhost',
        'root',
        'zorobabel',
        'marketzone',
        3307
    );

    /**
     * NOTA: si la conexión falló $conexion contendrá false
     **/
    if(!$conexion) {
        die('¡Base de datos NO conextada!');
    }
?>