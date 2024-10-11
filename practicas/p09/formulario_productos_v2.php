<!DOCTYPE html >
<html>
  
  <head>
    <meta charset="utf-8" >
    <title>Actualizar Producto</title>
    <script src="./src/main.js"></script>
    <style type="text/css">
      ol, ul { 
      list-style-type: none;
      }
    </style>
  </head>

  <body>
    <h1>Actualizar Producto</h1>

    <form id="ActualizarProductos" action="http://localhost/tecweb/practicas/p09/update_producto.php" method="post" onsubmit="return checkForm()" >
      <fieldset>
        <legend>Actualiza los datos del producto</legend>
        <ul>
            <input type="hidden" name="id" value="<?= !empty($_POST['id']) ? $_POST['id'] : $_GET['id'] ?>">
            <li><label for="form-nombre">Nombre:</label> <input type="text" cols="30" id="form-nombre" name="nombre" placeholder="..." onblur="checkName()" value="<?= !empty($_POST['nombre']) ? htmlspecialchars($_POST['nombre']) : htmlspecialchars($_GET['nombre']) ?>" > </li><br/>
            <li><label for="marca">Marca:</label> 
            <select name="marca" id="marca" onblur="checkMarca()">
              <option value="" disabled <?= !empty($_POST['marca']) || !empty($_GET['marca']) ? '' : 'selected' ?>>Selecciona una marca</option>
              <option value="Apple" <?= (!empty($_POST['marca']) && $_POST['marca'] == 'Apple') || (!empty($_GET['marca']) && $_GET['marca'] == 'Apple') ? 'selected' : '' ?>>Apple</option>
              <option value="Samsung" <?= (!empty($_POST['marca']) && $_POST['marca'] == 'Samsung') || (!empty($_GET['marca']) && $_GET['marca'] == 'Samsung') ? 'selected' : '' ?>>Samsung</option>
              <option value="Amazon" <?= (!empty($_POST['marca']) && $_POST['marca'] == 'Amazon') || (!empty($_GET['marca']) && $_GET['marca'] == 'Amazon') ? 'selected' : '' ?>>Amazon</option>
              <option value="Sony" <?= (!empty($_POST['marca']) && $_POST['marca'] == 'Sony') || (!empty($_GET['marca']) && $_GET['marca'] == 'Sony') ? 'selected' : '' ?>>Sony</option>
              <option value="Xiaomi" <?= (!empty($_POST['marca']) && $_POST['marca'] == 'Xiaomi') || (!empty($_GET['marca']) && $_GET['marca'] == 'Xiaomi') ? 'selected' : '' ?>>Xiaomi</option>
            </select></p>
            <li><label for="modelo">Modelo:</label> 
                <input type="text" name="modelo" placeholder="..." id="modelo" tabindex="3" 
                value="<?= !empty($_POST['modelo']) ? htmlspecialchars($_POST['modelo']) : (!empty($_GET['modelo']) ? htmlspecialchars($_GET['modelo']) : '') ?>" 
                onblur="checkModel()">
            </li><br/>

            <li><label for="precio">Precio:</label> 
                <span>$</span> 
                <input type="number" step="0.01" name="precio" placeholder="Mayor a 99.99" id="precio" 
                value="<?= !empty($_POST['precio']) ? htmlspecialchars($_POST['precio']) : (!empty($_GET['precio']) ? htmlspecialchars($_GET['precio']) : '') ?>" 
                onblur="checkPrice()">
            </li><br/>

            <li><label for="detalles">Detalles (opcional):</label><br>
                <textarea name="detalles" rows="4" cols="60" id="detalles" placeholder="No más de 250 caracteres de longitud" tabindex="5" onblur="checkDetalles()">
                <?= !empty($_POST['detalles']) ? htmlspecialchars($_POST['detalles']) : (!empty($_GET['detalles']) ? htmlspecialchars($_GET['detalles']) : '') ?>
                </textarea>
            </li><br/>

            <li><label for="unidades">Unidades:</label> 
                <input type="number" name="unidades" placeholder="Minimo 0" id="unidades" tabindex="6" 
                value="<?= !empty($_POST['unidades']) ? htmlspecialchars($_POST['unidades']) : (!empty($_GET['unidades']) ? htmlspecialchars($_GET['unidades']) : '') ?>" 
                onblur="checkUnidades()">
            </li><br/>

            <li><label for="imagen">Imagen:</label> 
                <input type="text" name="imagen" placeholder="URL image" id="imagen" tabindex="7" 
                value="<?= !empty($_POST['imagen']) ? htmlspecialchars($_POST['imagen']) : (!empty($_GET['imagen']) ? htmlspecialchars($_GET['imagen']) : '') ?>" 
                onblur="checkImg()">
            </li><br/>

        </ul>  
      </fieldset>
      <p>
        <input type="submit" value="Actualizar">
        <input type="reset">
      </p>
    </form>
  </body>
</html>