<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Práctica 3</title>
</head>
<body>
    <h2>Ejercicio 1</h2>
    <p>Determina cuál de las siguientes variables son válidas y explica por qué:</p>
    <p>$_myvar,  $_7var,  myvar,  $myvar,  $var7,  $_element1, $house*5</p>
    <?php
        //AQUI VA MI CÓDIGO PHP
        $_myvar;
        $_7var;
        //myvar;       // Inválida
        $myvar;
        $var7;
        $_element1;
        //$house*5;     // Invalida
        
        echo '<h4>Respuesta:</h4>';   
    
        echo '<ul>';
        echo '<li>$_myvar es válida porque inicia con guión bajo.</li>';
        echo '<li>$_7var es válida porque inicia con guión bajo.</li>';
        echo '<li>myvar es inválida porque no tiene el signo de dolar ($).</li>';
        echo '<li>$myvar es válida porque inicia con una letra.</li>';
        echo '<li>$var7 es válida porque inicia con una letra.</li>';
        echo '<li>$_element1 es válida porque inicia con guión bajo.</li>';
        echo '<li>$house*5 es inválida porque el símbolo * no está permitido.</li>';
        echo '</ul>';
    ?>

    <h2>Ejercicio 2</h2>
    <p>Proporcionar los valores de $a, $b, $c como sigue:</p>
    <?php
        echo '$a = “ManejadorSQL”;';
        echo '<br>';
        echo '$b = "MySQL";';
        echo '<br>';
        echo '$a = &$a;';
        $a = 'ManejadorSQL';
        $b = 'MySQL';
        $c = &$a;

        echo '<p>a. Ahora muestra el contenido de cada variable</p>';
        echo '<li>'.$a.'</li>';
        echo '<li>'.$b.'</li>';
        echo '<li>'.$c.'</li>';

        echo '<p>b. Agrega al código actual las siguientes asignaciones:</p>';
        $a = "PHP server";
        $b = &$a;

        echo '<p>c. Vuelve a mostrar el contenido de cada uno';
        echo '<li>'.$a.'</li>';
        echo '<li>'.$b.'</li>';
        echo '<li>'.$c.'</li>';

        echo '<p>d. Describe en y muestra en la página obtenida qué ocurrió en el segundo bloque de asignaciones</p>';
        echo '<h4>Respuesta:</h4>'; 
        echo '<li> En el segundo bloque de asignaciones, la variable $a se le asigna el valor "PHP server" y la <br> variable $b se le asigna la referencia de la variable $a. Por lo tanto, al mostrar el contenido de $a y $b,<br>
                ambos mostrarán el valor "PHP server".</li>';
        unset($a, $b, $c);
    ?>

<h2>Ejercicio 3</h2>
    <p> Muestra el contenido de cada variable inmediatamente después de cada asignación, <br>
        verificar la evolución del tipo de estas variables (imprime todos los componentes de los<br>
        arreglo):
    </p>
    <?php
        $a = "PHP5 ";
        echo '<li>$a: '.$a.'</li>';

        $z[] = &$a;
        echo '<li>$z: ';print_r($z);

        $b = "5a version de PHP";
        echo '<li>$b: '.$b.'</li>';

        $c = intval($b)*10;
        echo '<li>$c: '.$c.'</li>';

        $a .= $b;
        echo '<li>$a: '.$a.'</li>';

        settype($b, "int");
        $b *= $c;
        echo '<li>$b: '.$b.'</li>';

        $z[0] = "MySQL";
        echo '<li>$z: ';print_r($z);
    ?>

<h2>Ejercicio 4</h2>
    <p> Lee y muestra los valores de las variables del ejercicio anterior, pero ahora con la ayuda de<br>
        la matriz $GLOBALS o del modificador global de PHP.
    </p>

    <?php
        
        echo '<li>$a: '.$GLOBALS['a'].'</li>';

        echo '<li>$b: '.$GLOBALS['b'].'</li>';

        echo '<li>$c: '.$GLOBALS['c'].'</li>';

        echo '<li>$z: ';print_r($GLOBALS['z'][0]);
    ?>

<h2>Ejercicio 5</h2>
    <p> Dar el valor de las variables $a, $b, $c al final del siguiente script: </p>
    <?php
    
        $a = "7 personas";
        echo '<li>$a = '.$a.'</li>';
        $b = (integer) $a;
        echo '<li>$b = '.$b.'</li>';
        $a = "9E3";
        echo '<li>$a = '.$a.'</li>';
        $c = (double) $a;
        echo '<li>$c = '.$c.'</li>';
        
        unset($a, $b, $c);  // Limpia las variables

    ?>

<h2>Ejercicio 6</h2>
    <p> Dar y comprobar el valor booleano de las variables $a, $b, $c, $d, $e y $f <br>y muéstralas
        usando la función var_dump(<datos>).</p>
    <?php
        $a = "0";
        $b = "TRUE";
        $c = FALSE;
        $d = ($a OR $b);  // or es verdadero si uno de los dos es verdadero
        $e = ($a AND $c); // and es verdadero si ambos son verdaderos
        $f = ($a XOR $b); // xor es verdadero si uno de los dos es verdadero pero no ambos

        echo '<li>$a: ';
        var_dump($a);
        echo '<li> $b: ';
        var_dump($b);
        echo '<li> $c: ';
        var_dump($c);
        echo '<li> $d: ';
        var_dump($d);
        echo '<li> $e: ';
        var_dump($e);
        echo '<li> $f: ';
        var_dump($f);
        echo '<br>';

        echo '<p> Después investiga una función de PHP que permita transformar el valor booleano de $c y $e en uno que se pueda mostrar con un echo: </p>';
        
        echo '$c: '. var_export($c, true).'<br>';
        echo '$e: '. var_export($e, true).'<br>';
        
        unset($a, $b, $c, $d, $e, $f); 
    ?>

<h2>Ejercicio 7</h2>
    <p> Usando la variable predefinida $_SERVER, determina lo siguiente:</p>
    <?php
    echo '<p>a. La versión de Apache y PHP,</p>';
    echo 'Version de Apache: '.$_SERVER['SERVER_SOFTWARE'].'<br>';
    echo '<p>b. El nombre del sistema operativo (servidor),</p>';
    echo 'Nombre del sistema operativo: '.$_SERVER['SERVER_NAME'].'<br>';
    echo '<p>c. El idioma del navegador (cliente).</p>';
    echo 'Idioma del navegador: '.$_SERVER['HTTP_ACCEPT_LANGUAGE'].'<br>';
    ?>
</body>
</html>