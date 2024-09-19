<?php
    function esMultiplo($num)
    {
        if(isset($_GET['numero']))
        {
            $num = $_GET['numero'];
            if ($num%5==0 && $num%7==0)
            {
                echo '<h3>R= El número '.$num.' SÍ es múltiplo de 5 y 7.</h3>';
            }
            else
            {
                echo '<h3>R= El número '.$num.' NO es múltiplo de 5 y 7.</h3>';
            }
        }
    }

function generarSecuencia()
{
    $numeros = array();
    $iteraciones = 0;
    $total_numeros = 0;
    $encontrado = false;

    while (!$encontrado) {
        $iteraciones++;

        $n1 = rand(100, 999);
        $n2 = rand(100, 999);
        $n3 = rand(100, 999);

        $numeros[] = array($n1, $n2, $n3);
        $total_numeros += 3;

        if ($n1 % 2 != 0 && $n2 % 2 == 0 && $n3 % 2 != 0) {
            $encontrado = true;  
            // Muestra el número de iteraciones y la cantidad total de números generados
            echo '<h4>'.$total_numeros.' números obtenidos en '.$iteraciones.' iteraciones</h4>';
        }
    }

function generarMultiplov1($num) {
    $iteraciones = 0;
    $num = intval($_GET['numero']);   
    $multiplo = rand($num+1, 1000); 
    while ( $multiplo % $num  != 0)
    {
        $multiplo = rand($num+1, 1000);
        $iteraciones++;
    }
    echo 'Primer multiplo de '.$num.' encontrado en '.$iteraciones.' iteraciones: '.$multiplo;
}

/*function generarMultiplov2($num) {
    $iteraciones = 0;
    $num = $_GET['numero'];
    do {
        $multiplo = rand(1, 1000);
        $iteraciones++;
    }while ( $multiplo % $num  != 0 && $multiplo >$num);

    echo 'Primer multiplo de '.$num.' encontrado en '.$iteraciones.' iteraciones: '.$multiplo;
}*/
}