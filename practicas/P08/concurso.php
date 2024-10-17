<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<title>Registro Completado</title>
		<style type="text/css">
			body {margin: 20px; 
			background-color: #C4DF9B;
			font-family: Verdana, Helvetica, sans-serif;
			font-size: 90%;}
			h1 {color: #005825;
			border-bottom: 1px solid #005825;}
			h2 {font-size: 1.2em;
			color: #4A0048;}
		</style>
	</head>
	<body>
	<h1>Tu articulo se subió correctamente</h1>

		<ul>
			<li><strong>Nombre:</strong> <em><?php echo isset($_POST['nombre']) ? $_POST['nombre'] : 'No proporcionado'; ?></em></li>
			<li><strong>Modelo:</strong> <em><?php echo isset($_POST['marca']) ? $_POST['marca'] : 'No proporcionado'; ?></em></li>
			<li><strong>Precio:</strong> <em><?php echo isset($_POST['precio']) ? $_POST['precio'] : 'No proporcionado'; ?></em></li>
			<li><strong>Detalles:</strong> <em><?php echo isset($_POST['detalles']) ? $_POST['detalles'] : 'No proporcionado'; ?></em></li>
			<li><strong>Unidades:</strong> <em><?php echo isset($_POST['unidades']) ? $_POST['unidades'] : 'No proporcionado'; ?></em></li>
			<li><strong>Imagen:</strong> <em><?php echo isset($_POST['imagen']) ? $_POST['imagen'] : 'No proporcionado'; ?></em></li>
			
		</ul>
		

		
		<p>
			<a href="http://validator.w3.org/check?uri=referer"><img src="http://www.w3.org/Icons/valid-xhtml10" alt="Valid XHTML 1.0 Strict" height="31" width="88" /></a>
		</p>
	</body>
</html>