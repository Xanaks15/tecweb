<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Práctica 4</title>
</head>
<body>
    <h2>Ejercicio 1</h2>
    <p>Escribir programa para comprobar si un número es un múltiplo de 5 y 7</p>
    <?php
        include 'src/funciones.php';
        if(isset($_GET['numero']))
        {
            esMultiplo($_GET['numero']);
        }
        else
        {
            echo '<h3>Introduce un número en la URL</h3>';
        }
    ?>

<h2>Ejercicio 2</h2>
    <p>Crea un programa para la generación repetitiva de 3 números aleatorios hasta obtener una
    secuencia compuesta por:</p>
    <p> impar, par, impar <br> 
        por Ejemplo: <br>

        990, 382, 786 <br>
        422, 361, 473 <br>
        392, 671, 914 <br>
        <mark>213, 744, 911<mark></p>

    <p>Estos números deben almacenarse en una matriz de Mx3, donde M es el número de filas y 
        3 el número de columnas. <br> Al final muestra el número de iteraciones y la cantidad de
        números generados: <br>
        <br>
        12 números obtenidos en 4 iteraciones </p>
    <?php
        
        echo '<h4>Respuesta:</h4>';
        echo '<p>';
        generarSecuencia();
        echo '</p>';
    ?>



    <h2>Ejemplo de POST</h2>
    <form action="http://localhost/tecweb/practicas/p04/index.php" method="post">
        Name: <input type="text" name="name"><br>
        E-mail: <input type="text" name="email"><br>
        <input type="submit">
    </form>
    <br>
    <?php
        if(isset($_POST["name"]) && isset($_POST["email"]))
        {
            echo $_POST["name"];
            echo '<br>';
            echo $_POST["email"];
        }
    ?>
</body>
</html>