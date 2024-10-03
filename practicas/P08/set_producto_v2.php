<?php
    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : 'nombre_producto';
    $marca  = isset($_POST['marca']) ? $_POST['marca'] : 'marca_producto';
    $modelo = isset($_POST['modelo']) ? $_POST['modelo'] : 'modelo_producto';
    $precio = isset($_POST['precio']) ? $_POST['precio'] : 'precio_producto';
    $detalles = isset($_POST['detalles']) ? $_POST['detalles'] : 'detalles_producto';
    $unidades = isset($_POST['unidades']) ? $_POST['unidades'] : 'unidades_producto';
    $imagen   = isset($_POST['imagen']) ? $_POST['imagen'] : 'img/image.png';

    /** SE CREA EL OBJETO DE CONEXION */
    @$link = new mysqli('localhost', 'root', 'zorobabel', 'marketzone', 3307);	

    /** comprobar la conexión */
    if ($link->connect_errno) {
        die('Falló la conexión: ' . $link->connect_error . '<br/>');
    }

    /** Crear una consulta para insertar los datos */
    $sql_check = "SELECT * FROM productos WHERE nombre = '{$nombre}' AND marca = '{$marca}' AND modelo = '{$modelo}'";
    $result = $link->query($sql_check);
    if($result->num_rows == 0){
        /** $sql = "INSERT INTO productos VALUES ('{$nombre}', '{$marca}', '{$modelo}', {$precio}, '{$detalles}', {$unidades}, '{$imagen}','{0}')"; */
        $sql = "INSERT INTO productos (nombre, marca, modelo, precio, detalles, unidades, imagen) VALUES ('{$nombre}', '{$marca}', '{$modelo}', {$precio}, '{$detalles}', {$unidades}, '{$imagen}')";
        $link->query($sql);
        echo '<br/>';
        /** Mostrar el resumen de los datos insertados */
        echo '<h3>Resumen de los datos:</h3><br/>';
        echo 'Producto insertado con ID: ' . $link->insert_id . '<br/>';
        echo 'Nombre: ' . $nombre . '<br/>';
        echo 'Marca: ' . $marca . '<br/>';
        echo 'Modelo: ' . $modelo . '<br/>';
        echo 'Precio: $' . $precio . '<br/>';
        echo 'Detalles: ' . $detalles . '<br/>';
        echo 'Unidades: ' . $unidades . '<br/>';
        echo '<img src="' . $imagen . '" alt="Imagen del producto"><br/>';
    }
    else {
        echo 'El producto ya existe en la base de datos';
    }

    $link->close();

?>
