<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Productos Vigentes</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        .text-center {
            text-align: center; /* Centra el texto */
        }
        .img-producto {
        width: 100px;  /* Ajusta el ancho como desees */
        height: 100px; /* Ajusta la altura como desees */
        object-fit: cover; /* Asegura que la imagen se recorte adecuadamente */
    }
    </style>
</head>
<body>
	<h3 class="text-center">PRODUCTOS VIGENTES</h3>
	<br/>

	<?php
	
	if(isset($_GET['eliminado'])) {
        $eliminado = $_GET['eliminado'];
    
        // Verificar si $eliminado es un número
        if (!is_numeric($eliminado)) {
            die('El parámetro "eliminado" debe ser un número.');
        }
        $eliminado = (int)$eliminado; // Convertir a entero
    } else {
        die('Parámetro "eliminado" no detectado...');
    }

	// Verificar que el eliminado no esté vacío
	if (!empty($eliminado)) {
		
		@$link = new mysqli('localhost', 'root', 'zorobabel', 'marketzone', 3307);

		// Comprobar la conexión
		if ($link->connect_errno) {
			die('Falló la conexión: '.$link->connect_error.'<br/>');
		}

		// Ejecutar la consulta
		$data = [];
		if ($result = $link->query("SELECT * FROM productos WHERE eliminado != $eliminado")) {
			while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
				$data[] = $row;  // Guardar cada fila en el arreglo $data
			}
            /** útil para liberar memoria asociada a un resultado con demasiada información */
			$result->free(); 
		}

		$link->close(); // Cerrar la conexión
	}

	// Mostrar la tabla si hay datos
    /*"<?= ?>" es una forma abreviada de escribir "<?php echo ?>" en PHP*/
	if (!empty($data)) :
	?>
		<table class="table">
			<thead class="thead-dark">
				<tr>
					<th scope="col">#</th>
					<th scope="col">Nombre</th>
					<th scope="col">Marca</th>
					<th scope="col">Modelo</th>
					<th scope="col">Precio</th>
					<th scope="col">Unidades</th>
					<th scope="col">Detalles</th>
					<th scope="col">Imagen</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($data as $row): ?>
                
				<tr>
					<th scope="row"><?= $row['id'] ?></th> 
					<td><?= $row['nombre'] ?></td>
					<td><?= $row['marca'] ?></td>
					<td><?= $row['modelo'] ?></td>
					<td><?= $row['precio'] ?></td>
					<td><?= $row['unidades'] ?></td>
					<td><?= utf8_encode($row['detalles']) ?></td>
					<td><img class="img-producto" src="<?= $row['imagen'] ?>" alt="Imagen del producto"></td>
				</tr>
				<?php endforeach; ?>
                
			</tbody>
		</table>
	<?php else : ?>
		<p>No hay productos que coincidan con el criterio.</p>
	<?php endif; ?>
</body>
</html>
