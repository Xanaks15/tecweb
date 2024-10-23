<?php
    include_once __DIR__.'/database.php';

    // SE CREA EL ARREGLO QUE SE VA A DEVOLVER EN FORMA DE JSON
    $data = array(
        'status'  => 'error',
        'message' => 'La consulta falló'
    );
    // SE VERIFICA HABER RECIBIDO EL ID
    if( isset($_POST['id']) ) {
        $id = $_POST['id'];
        // SE REALIZA LA QUERY DE BÚSQUEDA Y AL MISMO TIEMPO SE VALIDA SI HUBO RESULTADOS
        $sql = "SELECT * FROM productos WHERE id = {$id}";
        $result = $conexion->query($sql);
        if ($result) {  // Verificar que la consulta se haya ejecutado correctamente
            while ($row = $result->fetch_assoc()) {  // Usar fetch_assoc() en el resultado, no en la conexión
                $json[] = array(
                    
                    'Nombre' => $row['nombre'],
                    'Precio' => $row['precio'],
                    'Unidades' => $row['unidades'],
                    'Modelo' => $row['modelo'],
                    'Marca' => $row['marca'],
                    'Detalles' => $row['detalles'],
                );
            }
            
		} else {
            $data['message'] = "ERROR: No se ejecuto $sql. " . mysqli_error($conexion);
        }
		$conexion->close();
    } 
    
    // SE HACE LA CONVERSIÓN DE ARRAY A JSON
    $jsonstring = json_encode($json[0], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    echo $jsonstring;

?>