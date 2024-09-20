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
        echo '<h4>Respuesta: </h4>';
        if(isset($_GET['numero']))
        {
            esMultiplo($_GET['numero']);
        }
        else
        {
            echo '<p>Introduce un número en la URL</p>';
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

<h2>Ejercicio 3</h2>
    <p>Utiliza un ciclo while para encontrar el primer número entero obtenido aleatoriamente,<br>
        pero que además sea múltiplo de un número dado.</p>
        <?php
        echo '<h4>Respuesta:</h4>';
        if(isset($_GET['numero']))
        {
            echo 
            generarMultiplov1($_GET['numero']);
        }
        else
        {
            echo '<p>Introduce un número en la  URL</p>';
        }
    ?>

<h2>Ejercicio 4</h2>
    <p> Crear un arreglo cuyos índices van de 97 a 122 y cuyos valores son las letras de la ‘a’<br> 
        a la ‘z’. Usa la función chr(n) que devuelve el caracter cuyo código ASCII es n para poner <br>
        el valor en cada índice. Es decir:</p>
        <p> [97] => a <br>
            [98] => b <br>
            [99] => c <br>
            … <br>
            [122] => z </p>
    
    <p> ✓ Crea el arreglo con un ciclo for <br>
        ✓ Lee el arreglo y crea una tabla en XHTML con echo y un ciclo foreach <br>
        foreach ($arreglo as $key => $value) {
            # code...
        }</p>

    <?php
        echo '<h4>Respuesta:</h4>';
        echo '<p>';
        abcNum();
    
    ?>

<h2>Ejercicio 5</h2>
    <p> Usar las variables $edad y $sexo en una instrucción if para identificar una persona de <br>
        sexo “femenino”, cuya edad oscile entre los 18 y 35 años y mostrar un mensaje de <br>
        bienvenida apropiado. Por ejemplo: <br>
        <br>
        <em>Bienvenida, usted está en el rango de edad permitido.</em> <br>
        <br>
        En caso contrario, deberá devolverse otro mensaje indicando el error. <br>
        <br>
        ✓ Los valores para $edad y $sexo se deben obtener por medio de un formulario en HTML. <br>
        ✓ Utilizar el la Variable Superglobal $_POST (revisar documentación). <br> 
    </p>
    <h3>Respuesta</h3>
    <fieldset>
    <legend>Formulario</legend>
    <form action="" method="post">
        <label for="edad">Introduce tu edad:</label>
        <input type="tel" name="edad" id="edad" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
        
        <label for="sexo">Selecciona tu sexo:</label>
        <select name="sexo" id="sexo" require>
            <option value="femenino">Femenino</option>
            <option value="masculino">Femenino</option>
        </select>
        <br>
        <button type="submit">Enviar</button>
    </form>
    
    </fieldset>
    
    <?php
        if(isset($_POST["edad"]) && isset($_POST["sexo"]))
        {
            $edad = $_POST['edad'];
            $sexo = $_POST['sexo'];
            
            validarEdadyGenero($edad, $sexo);
        }
    ?>
    
<h2>Ejercicio 5</h2>
    <p> Crea en código duro un arreglo asociativo que sirva para registrar el parque vehicular de <br>
    una ciudad. Cada vehículo debe ser identificado por: <br>
    • Matricula <br>
    • Auto <br>
    o Marca <br>
    o Modelo (año)<br>
    o Tipo (sedan|hachback|camioneta)<br>
    • Propietario<br>
    o Nombre<br>
    o Ciudad<br>
    o Dirección<br>
    La matrícula debe tener el siguiente formato LLLNNNN, donde las L pueden ser letras de<br>
    la A-Z y las N pueden ser números de 0-9.<br>
    Para hacer esto toma en cuenta las siguientes instrucciones:<br>
    ✓ Crea en código duro el registro para 15 autos<br>
    ✓ Utiliza un único arreglo, cuya clave de cada registro sea la matricula<br>
    ✓ Lógicamente la matricula no se puede repetir.<br>
    ✓ Los datos del Auto deben ir dentro de un arreglo.<br>
    ✓ Los datos del Propietario deben ir dentro de un arreglo.<br>
    Usa print_r para mostrar la estructura general del arreglo, que luciría de forma similar al<br>
    siguiente ejemplo:<br>

    Array ( [UBN6338] => Array ( [Auto] => Array ( [marca] => HONDA [modelo] => 2020<br>
    [tipo] => camioneta ) [Propietario] => Array ( [nombre] => Alfonzo Esparza [ciudad]<br>
    => Puebla, Pue. [direccion] => C.U., Jardines de San Manuel ) ) [UBN6339] => Array<br>
    ( [Auto] => Array ( [marca] => MAZDA [modelo] => 2019 [tipo] => sedan ) [Propietario]<br>
    => Array ( [nombre] => Ma. del Consuelo Molina [ciudad] => Puebla, Pue. [direccion]<br>
    => 97 oriente ) ) )<br>
    Para que puedas identificar la estructura te lo muestro de forma más ordenada:<br>
    Array (<br>
    [UBN6338] =><br>
    Array (<br>
    [Auto] => Array (<br>
    [marca] => HONDA [modelo] => 2020 [tipo] => camioneta<br>
    )<br>
    [Propietario] => Array (<br>
    [nombre] => Alfonzo Esparza [ciudad] => Puebla, Pue. [direccion]<br>
    => C.U., Jardines de San Manuel<br>
    )<br>
    )<br>
    [UBN6339] =><br>
    Array (<br>
    [Auto] => Array ( <br>
                    [marca] => MAZDA [modelo] => 2019 [tipo] => sedan<br>
    )<br>
        [Propietario] => Array (<br>
                        [nombre] => Ma. del Consuelo Molina [ciudad] => Puebla, Pue.<br>
                        [direccion] => 97 oriente<br>
                )<br>
        )<br>
    )<br>
    </p>
    <h3>Respuesta</h3>
    <?php
        
    ?>
    
    <h2>Consulta de Vehículos</h2>
    <form method="post">
        Matrícula: <input type="text" name="matricula">
        <input type="submit" value="Consultar">
        <br>
    </form>

    <form method="post">
        <input type="submit" name="todos" value="Mostrar Todos los Autos" style="margin-bottom: 20px">
    </form>

    <?php
        $matricula = isset($_POST["matricula"]) ? $_POST["matricula"] : null;
        $todos = isset($_POST["todos"]) ? $_POST["todos"] : null;
        mostrarVehiculos($matricula, $todos);
    ?>

    
</body>
</html>