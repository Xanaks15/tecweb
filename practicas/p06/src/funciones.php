<?php
    function esMultiplo($num)
    {
        if(isset($_GET['numero']))
        {
            $num = $_GET['numero'];
            if ($num%5==0 && $num%7==0)
            {
                echo '<p>R= El número '.$num.' SÍ es múltiplo de 5 y 7.</p>';
            }
            else
            {
                echo '<p>R= El número '.$num.' NO es múltiplo de 5 y 7.</p>';
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
            
            echo '<p>'.$total_numeros.' números obtenidos en '.$iteraciones.' iteraciones</p>';
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

function abcNum()
{
    $letras = array();
    for ($i=97; $i <= 122; $i++) { 
        $letras[$i] = chr($i);
    }
    echo '<table style="border-collapse: collapse; border: 1px solid black;">';
    echo '<tr><th style="border: 1px solid black; padding: 5px;">Índice</th><th style="border: 1px solid black; padding: 5px;">Letra</th></tr>';
    
    foreach ($letras as $key => $value) {
        echo '<tr>';
        echo '<td style="border: 1px solid black; padding: 5px;">'.$key.'</td>';
        echo '<td style="border: 1px solid black; padding: 5px;">'.$value.'</td>';
        echo '</tr>';
    }

    echo '</table>';

}

function validarEdadyGenero($edad,$sexo){
    if(isset($_POST["edad"]) && isset($_POST["sexo"]))
    {
        $edad = $_POST['edad'];
        $sexo = $_POST['sexo'];
    
        if($sexo == "femenino" && $edad >= 18 && $edad <= 35)
        {
                echo '<p>Bienvenida, usted está en el rango de edad permitido.</p>';
        }
        else
        {
            echo '<h4>No cumple los requisitos</h4>';
        }
    }
}
}

