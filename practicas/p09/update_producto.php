<?php
// Obtener los datos del formulario
$id = $_POST['id'] ?? null; // Usando el operador null coalescing
$nombre = $_POST['nombre'] ?? '';
$marca = $_POST['marca'] ?? '';
$modelo = $_POST['modelo'] ?? '';
$precio = isset($_POST['precio']) && is_numeric($_POST['precio']) ? $_POST['precio'] : 0;
$detalles = $_POST['detalles'] ?? 'No especificado'; // Valor predeterminado
$unidades = isset($_POST['unidades']) && is_numeric($_POST['unidades']) ? $_POST['unidades'] : 0; // Asegurarse que sea numérico
$imagen = $_POST['imagen'] ?? '';

// Conexión a la base de datos
$link = mysqli_connect("localhost", "root", "zorobabel", "marketzone", 3307);

// Verificar conexión
if ($link === false) {
    die("ERROR: No pudo conectarse con la DB. " . mysqli_connect_error());
}

// Preparar la consulta para actualizar el producto
$sql = "UPDATE productos SET 
    nombre = '{$nombre}', 
    marca = '{$marca}', 
    modelo = '{$modelo}', 
    precio = {$precio}, 
    detalles = '{$detalles}', 
    unidades = {$unidades}, 
    imagen = '{$imagen}' 
WHERE id = {$id}";

if (mysqli_query($link, $sql)) {
    echo '<h1>Registro actualizado.</h1>';
    echo '<p><strong>ID del Producto:</strong> ' . $id . '</p>';
    echo '<p><strong>Nombre:</strong> ' . $nombre . '</p>';
    echo '<p><strong>Marca:</strong> ' . $marca . '</p>';
    echo '<p><strong>Modelo:</strong> ' . $modelo . '</p>';
    echo '<p><strong>Precio:</strong> ' . $precio . '</p>';
    echo '<p><strong>Detalles:</strong> ' . $detalles . '</p>';
    echo '<p><strong>Unidades:</strong> ' . $unidades . '</p>';
} else {
    echo "ERROR: No se ejecutó $sql. " . mysqli_error($link);
}

// Cerrar conexión
mysqli_close($link);

?>