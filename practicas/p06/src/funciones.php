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
                    echo '<h4>Bienvenida, usted está en el rango de edad permitido.</h4>';
            }
            else
            {
                echo '<h4>No cumple los requisitos</h4>';
            }
        }
    }

    $vehiculos = [
        'ABC1234' => [
            'Auto' => [
                'marca' => 'HONDA',
                'modelo' => 2005,
                'tipo' => 'sedan'
            ],
            'Propietario' => [
                'nombre' => 'Kaltum Abdala',
                'ciudad' => 'Veracruz, Cordaba.',
                'direccion' => 'calle 7 av 11 y 13'
            ]
        ],
        'DEF5678' => [
            'Auto' => [
                'marca' => 'MAZDA',
                'modelo' => 2019,
                'tipo' => 'sedan'
            ],
            'Propietario' => [
                'nombre' => 'Ma. del Consuelo Molina',
                'ciudad' => 'Puebla, Pue.',
                'direccion' => '97 oriente'
            ]
        ],
        'GHI9012' => [
            'Auto' => [
                'marca' => 'TOYOTA',
                'modelo' => 2018,
                'tipo' => 'hachback'
            ],
            'Propietario' => [
                'nombre' => 'Juan Perez',
                'ciudad' => 'Puebla, Pue.',
                'direccion' => 'Av. Reforma 123'
            ]
        ],
        'JKL3456' => [
            'Auto' => [
                'marca' => 'FORD',
                'modelo' => 2017,
                'tipo' => 'camioneta'
            ],
            'Propietario' => [
                'nombre' => 'Ana Lopez',
                'ciudad' => 'Guadalajara, Jal.',
                'direccion' => 'Calle Falsa 123'
            ]
        ],
        'MNO7890' => [
            'Auto' => [
                'marca' => 'CHEVROLET',
                'modelo' => 2016,
                'tipo' => 'sedan'
            ],
            'Propietario' => [
                'nombre' => 'Carlos Martinez',
                'ciudad' => 'Monterrey, NL.',
                'direccion' => 'Av. Siempre Viva 742'
            ]
        ],
        'PQR1234' => [
            'Auto' => [
                'marca' => 'NISSAN',
                'modelo' => 2015,
                'tipo' => 'hachback'
            ],
            'Propietario' => [
                'nombre' => 'Laura Sanchez',
                'ciudad' => 'Tijuana, BC.',
                'direccion' => 'Calle 8 No. 45'
            ]
        ],
        'STU5678' => [
            'Auto' => [
                'marca' => 'BMW',
                'modelo' => 2020,
                'tipo' => 'sedan'
            ],
            'Propietario' => [
                'nombre' => 'Miguel Angel',
                'ciudad' => 'Cancún, QR.',
                'direccion' => 'Blvd. Kukulcan Km 12'
            ]
        ],
        'VWX9012' => [
            'Auto' => [
                'marca' => 'AUDI',
                'modelo' => 2019,
                'tipo' => 'camioneta'
            ],
            'Propietario' => [
                'nombre' => 'Sofia Hernandez',
                'ciudad' => 'Mérida, Yuc.',
                'direccion' => 'Calle 60 No. 123'
            ]
        ],
        'YZA3456' => [
            'Auto' => [
                'marca' => 'MERCEDES',
                'modelo' => 2018,
                'tipo' => 'sedan'
            ],
            'Propietario' => [
                'nombre' => 'Luis Gomez',
                'ciudad' => 'Querétaro, Qro.',
                'direccion' => 'Av. Universidad 456'
            ]
        ],
        'BCD7890' => [
            'Auto' => [
                'marca' => 'VOLKSWAGEN',
                'modelo' => 2017,
                'tipo' => 'hachback'
            ],
            'Propietario' => [
                'nombre' => 'Mariana Torres',
                'ciudad' => 'Toluca, Edo. Mex.',
                'direccion' => 'Calle de la Amargura 789'
            ]
        ],
        'EFG1234' => [
            'Auto' => [
                'marca' => 'KIA',
                'modelo' => 2016,
                'tipo' => 'camioneta'
            ],
            'Propietario' => [
                'nombre' => 'Pedro Ramirez',
                'ciudad' => 'León, Gto.',
                'direccion' => 'Blvd. Adolfo López Mateos 321'
            ]
        ],
        'HIJ5678' => [
            'Auto' => [
                'marca' => 'HYUNDAI',
                'modelo' => 2015,
                'tipo' => 'sedan'
            ],
            'Propietario' => [
                'nombre' => 'Gabriela Fernandez',
                'ciudad' => 'Aguascalientes, Ags.',
                'direccion' => 'Calle de la Paz 654'
            ]
        ],
        'KLM9012' => [
            'Auto' => [
                'marca' => 'TESLA',
                'modelo' => 2021,
                'tipo' => 'sedan'
            ],
            'Propietario' => [
                'nombre' => 'Ricardo Lopez',
                'ciudad' => 'Ciudad de México, CDMX.',
                'direccion' => 'Av. Insurgentes Sur 1234'
            ]
        ],
        'NOP3456' => [
            'Auto' => [
                'marca' => 'FIAT',
                'modelo' => 2014,
                'tipo' => 'hachback'
            ],
            'Propietario' => [
                'nombre' => 'Sandra Morales',
                'ciudad' => 'Morelia, Mich.',
                'direccion' => 'Calle del Sol 987'
            ]
        ],
        'QRS7890' => [
            'Auto' => [
                'marca' => 'PEUGEOT',
                'modelo' => 2013,
                'tipo' => 'camioneta'
            ],
            'Propietario' => [
                'nombre' => 'Jorge Gutierrez',
                'ciudad' => 'San Luis Potosí, SLP.',
                'direccion' => 'Av. Carranza 456'
            ]
        ]
    ];

    function mostrarVehiculos($matricula, $todos) {
        $vehiculos = [
            'ABC1234' => [
                'Auto' => [
                    'marca' => 'HONDA',
                    'modelo' => 2005,
                    'tipo' => 'sedan'
                ],
                'Propietario' => [
                    'nombre' => 'Jorge Gutierrez',
                    'ciudad' => 'Hidalgo, SLP.',
                    'direccion' => 'calle 7 av 11 y 13'
                ]
            ],
            'DEF5678' => [
                'Auto' => [
                    'marca' => 'MAZDA',
                    'modelo' => 2019,
                    'tipo' => 'sedan'
                ],
                'Propietario' => [
                    'nombre' => 'Ma. del Consuelo Molina',
                    'ciudad' => 'Puebla, Pue.',
                    'direccion' => '97 oriente'
                ]
            ],
            'GHI9012' => [
                'Auto' => [
                    'marca' => 'TOYOTA',
                    'modelo' => 2018,
                    'tipo' => 'hachback'
                ],
                'Propietario' => [
                    'nombre' => 'Juan Perez',
                    'ciudad' => 'Puebla, Pue.',
                    'direccion' => 'Av. Reforma 123'
                ]
            ],
            'JKL3456' => [
                'Auto' => [
                    'marca' => 'FORD',
                    'modelo' => 2017,
                    'tipo' => 'camioneta'
                ],
                'Propietario' => [
                    'nombre' => 'Ana Lopez',
                    'ciudad' => 'Guadalajara, Jal.',
                    'direccion' => 'Calle Falsa 123'
                ]
            ],
            'MNO7890' => [
                'Auto' => [
                    'marca' => 'CHEVROLET',
                    'modelo' => 2016,
                    'tipo' => 'sedan'
                ],
                'Propietario' => [
                    'nombre' => 'Carlos Martinez',
                    'ciudad' => 'Monterrey, NL.',
                    'direccion' => 'Av. Siempre Viva 742'
                ]
            ],
            'PQR1234' => [
                'Auto' => [
                    'marca' => 'NISSAN',
                    'modelo' => 2015,
                    'tipo' => 'hachback'
                ],
                'Propietario' => [
                    'nombre' => 'Laura Sanchez',
                    'ciudad' => 'Tijuana, BC.',
                    'direccion' => 'Calle 8 No. 45'
                ]
            ],
            'STU5678' => [
                'Auto' => [
                    'marca' => 'BMW',
                    'modelo' => 2020,
                    'tipo' => 'sedan'
                ],
                'Propietario' => [
                    'nombre' => 'Miguel Angel',
                    'ciudad' => 'Cancún, QR.',
                    'direccion' => 'Blvd. Kukulcan Km 12'
                ]
            ],
            'VWX9012' => [
                'Auto' => [
                    'marca' => 'AUDI',
                    'modelo' => 2019,
                    'tipo' => 'camioneta'
                ],
                'Propietario' => [
                    'nombre' => 'Sofia Hernandez',
                    'ciudad' => 'Mérida, Yuc.',
                    'direccion' => 'Calle 60 No. 123'
                ]
            ],
            'YZA3456' => [
                'Auto' => [
                    'marca' => 'MERCEDES',
                    'modelo' => 2018,
                    'tipo' => 'sedan'
                ],
                'Propietario' => [
                    'nombre' => 'Luis Gomez',
                    'ciudad' => 'Querétaro, Qro.',
                    'direccion' => 'Av. Universidad 456'
                ]
            ],
            'BCD7890' => [
                'Auto' => [
                    'marca' => 'VOLKSWAGEN',
                    'modelo' => 2017,
                    'tipo' => 'hachback'
                ],
                'Propietario' => [
                    'nombre' => 'Mariana Torres',
                    'ciudad' => 'Toluca, Edo. Mex.',
                    'direccion' => 'Calle de la Amargura 789'
                ]
            ],
            'EFG1234' => [
                'Auto' => [
                    'marca' => 'KIA',
                    'modelo' => 2016,
                    'tipo' => 'camioneta'
                ],
                'Propietario' => [
                    'nombre' => 'Pedro Ramirez',
                    'ciudad' => 'León, Gto.',
                    'direccion' => 'Blvd. Adolfo López Mateos 321'
                ]
            ],
            'HIJ5678' => [
                'Auto' => [
                    'marca' => 'HYUNDAI',
                    'modelo' => 2015,
                    'tipo' => 'sedan'
                ],
                'Propietario' => [
                    'nombre' => 'Gabriela Fernandez',
                    'ciudad' => 'Aguascalientes, Ags.',
                    'direccion' => 'Calle de la Paz 654'
                ]
            ],
            'KLM9012' => [
                'Auto' => [
                    'marca' => 'TESLA',
                    'modelo' => 2021,
                    'tipo' => 'sedan'
                ],
                'Propietario' => [
                    'nombre' => 'Ricardo Lopez',
                    'ciudad' => 'Ciudad de México, CDMX.',
                    'direccion' => 'Av. Insurgentes Sur 1234'
                ]
            ],
            'NOP3456' => [
                'Auto' => [
                    'marca' => 'FIAT',
                    'modelo' => 2014,
                    'tipo' => 'hachback'
                ],
                'Propietario' => [
                    'nombre' => 'Sandra Morales',
                    'ciudad' => 'Morelia, Mich.',
                    'direccion' => 'Calle del Sol 987'
                ]
            ],
            'QRS7890' => [
                'Auto' => [
                    'marca' => 'PEUGEOT',
                    'modelo' => 2013,
                    'tipo' => 'camioneta'
                ],
                'Propietario' => [
                    'nombre' => 'Jorge Gutierrez',
                    'ciudad' => 'San Luis Potosí, SLP.',
                    'direccion' => 'Av. Carranza 456'
                ]
            ]
        ];
        
        if (isset($matricula)) {
            if (isset($vehiculos[$matricula])) {
                echo '<pre>';
                print_r($vehiculos[$matricula]);
                echo '</pre>';
            } else {
                echo '<p>No se encontró el vehículo con matrícula ' . htmlspecialchars($matricula) . '.</p>';
            }
        }

        if (isset($todos)) {
            echo '<pre>';
            print_r($vehiculos);
            echo '</pre>';
        }
    }

}

