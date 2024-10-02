<?php
if (isset($_POST['nombre_producto']) && isset($_POST['marca_producto']) && isset($_POST['modelo_producto']) && isset($_POST['precio_producto']) && isset($_POST['detalles_producto']) && isset($_POST['unidades_productos']) && isset($_POST['imagen_producto'])) {

    // Asignar los datos del formulario
    $nombre = $_POST['nombre_producto'];
    $marca  = $_POST['marca_producto'];
    $modelo = $_POST['modelo_producto'];
    $precio = $_POST['precio_producto'];
    $detalles = $_POST['detalles_producto'];
    $unidades = $_POST['unidades_productos'];
    $imagen   = $_POST['imagen_producto'];  

    /** SE CREA EL OBJETO DE CONEXION */
    @$link = new mysqli('localhost', 'root', 'zorobabel', 'marketzone', 3307);	

    /** comprobar la conexión */
    if ($link->connect_errno) {
        die('Falló la conexión: ' . $link->connect_error . '<br/>');
    }

    /** Crear una consulta para insertar los datos */
    $sql = "INSERT INTO productos (nombre, marca, modelo, precio, detalles, unidades, imagen) VALUES ('{$nombre}', '{$marca}', '{$modelo}', {$precio}, '{$detalles}', {$unidades}, '{$imagen}')";
    
    if ($link->query($sql)) {
        echo 'Producto insertado con ID: ' . $link->insert_id;
    } else {
        echo 'El Producto no pudo ser insertado =( ' . $link->error;
    }

    $link->close();
} else {
    echo "Por favor, completa todos los campos.";
}
?>
