<!DOCTYPE html >
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Productos Vigentes</title>
	<script src="./src/main.js"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"/>
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
	<h3 class="text-center">PRODUCTOS VIGENTES<br/></h3>
	

	<?php
		
		@$link = new mysqli('localhost', 'root', 'zorobabel', 'marketzone', 3307);

		// Comprobar la conexión
		if ($link->connect_errno) {
			die('Falló la conexión: '.$link->connect_error.'<br/>');
		}

		// Ejecutar la consulta
		$data = [];
		if ($result = $link->query("SELECT * FROM productos WHERE eliminado = 0")) {
			while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
				$data[] = $row;  // Guardar cada fila en el arreglo $data
			}
            /** útil para liberar memoria asociada a un resultado con demasiada información */
			$result->free(); 
		}

		$link->close(); // Cerrar la conexión

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
					<th scope="col">Acción</th>
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
					<td><img class="img-producto" src="<?= $row['imagen'] ?>" alt="Imagen del producto"/></td>
					<td><p class="btn btn-primary" style="background-color: green" onclick="show(event)">Modificar</p></td>
				</tr>
				<?php endforeach; ?>
                
			</tbody>
		</table>
	<?php else : ?>
		<p>No hay productos que coincidan con el criterio.</p>
	<?php endif; ?>
</body>
</html>
