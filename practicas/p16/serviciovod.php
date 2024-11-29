<?php
libxml_use_internal_errors(true);
$xml= new DOMDocument();
$xml->loadXML(file_get_contents('catalogoVOD.xml'));
// echo $xml->saveXML();
// o usa $xml->load si prefieres usar la ruta del archivo
$xsd = 'serviciovod_ep.xsd';

$htmlStart = <<<HTML
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo Xanaks</title>
    <style>
    :root {
        --primary: #0ea5e9;
        --primary-dark: #0369a1;
        --secondary: #1e293b;
        --accent: #3b82f6;
        --text: #f8fafc;
        --border: #475569;
    }

    body {
        background-color: var(--secondary);
        color: var(--text);
        font-family: 'Inter', system-ui, -apple-system, sans-serif;
        margin: 0;
        padding: 0;
        line-height: 1.6;
    }

    header {
        background: linear-gradient(135deg, var(--primary), var(--accent));
        padding: 2.5rem 1rem;
        text-align: center;
        position: relative;
        overflow: hidden;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    }

    header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: radial-gradient(circle at center, transparent 0%, rgba(0, 0, 0, 0.2) 100%);
        pointer-events: none;
    }

    #logo {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        border: 4px solid rgba(255, 255, 255, 0.8);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        margin: 0 auto 1.5rem;
        display: block;
        object-fit: cover;
    }

    #logo:hover {
        transform: scale(1.05) rotate(5deg);
        border-color: white;
    }

    h1 {
        font-size: 3rem;
        font-weight: 800;
        color: white;
        margin: 0;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        letter-spacing: -0.025em;
    }

    h2 {
        font-size: 1.875rem;
        color: var(--primary);
        margin: 2rem 0 1.5rem;
        position: relative;
        padding-bottom: 0.5rem;
    }

    h2::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 60px;
        height: 4px;
        background: var(--primary);
        border-radius: 2px;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 2rem 1rem;
    }

    .card {
        background: rgba(255, 255, 255, 0.05);
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 2rem;
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        margin: 1.5rem 0;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    }

    thead {
        background-color: var(--primary-dark);
        color: white;
    }

    th {
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        font-size: 0.875rem;
    }

    th, td {
        padding: 1rem;
        text-align: left;
        border-bottom: 1px solid var(--border);
    }

    tbody tr {
        background-color: rgba(255, 255, 255, 0.03);
        transition: all 0.2s ease;
    }

    tbody tr:hover {
        background-color: rgba(255, 255, 255, 0.07);
        transform: translateY(-1px);
    }

    tbody tr:last-child td {
        border-bottom: none;
    }

    ul {
        list-style-type: none;
        padding: 0;
        margin: 0;
    }

    li {
        padding: 0.5rem 0;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    li:last-child {
        border-bottom: none;
    }

    @media (max-width: 768px) {
        h1 {
            font-size: 2rem;
        }

        .container {
            padding: 1rem;
        }

        table {
            display: block;
            overflow-x: auto;
            white-space: nowrap;
        }

        th, td {
            padding: 0.75rem;
        }
    }
    </style>
</head>
<header>
    <img src="logo.jpg" alt="Logotipo" id="logo"/>
    <h1>Cátalogo Xanaks</h1>
</header>
<body>
    <div class="container">
HTML;

echo $htmlStart;

if (!$xml->schemaValidate($xsd)){
    echo '<div class="card"><h1>Errores de Validación</h1><ul>';
    $errors = libxml_get_errors();
    foreach ($errors as $error)
    {
        echo '<li>Error [' . $error->code . ']: ' . $error->message . '</li>';
    }
    echo $lista;
    echo '</ul></div>';
    libxml_clear_errors();
}else {
    $xmlContent = simplexml_import_dom($xml->documentElement);
    $usuario = isset($_POST['usuario']) ? $_POST['usuario'] : '';
    $idioma = isset($_POST['size']) ? $_POST['size'] : '';

    // Películas
    $genero = isset($_POST['pel-genero']) ? $_POST['pel-genero'] : '';
    $titulo = isset($_POST['pel-titulo1']) ? $_POST['pel-titulo1'] : '';
    $duracion = isset($_POST['pel-duracion1']) ? $_POST['pel-duracion1'] : '';
    $titulo2 = isset($_POST['pel-titulo2']) ? $_POST['pel-titulo2'] : '';
    $duracion2 = isset($_POST['pel-duracion2']) ? $_POST['pel-duracion2'] : '';

    // Series
    $generoS = isset($_POST['ser-genero']) ? $_POST['ser-genero'] : '';
    $tituloS = isset($_POST['ser-titulo1']) ? $_POST['ser-titulo1'] : '';
    $duracionS = isset($_POST['ser-duracion1']) ? $_POST['ser-duracion1'] : '';
    $titulo2S = isset($_POST['ser-titulo2']) ? $_POST['ser-titulo2'] : '';
    $duracion2S = isset($_POST['ser-duracion2']) ? $_POST['ser-duracion2'] : '';

    // Verificar si ya existe el perfil
    $perfilExistente = false;
    foreach ($xmlContent->cuenta->perfiles->perfil as $perfil) {
        if ((string)$perfil['usuario'] == $usuario) {
            $perfilExistente = true;
            break;
        }
    }

    if (!$perfilExistente) {
        // Crear un nuevo perfil de usuario en el XML
        $nuevoPerfil = $xmlContent->cuenta->perfiles->addChild('perfil');
        $nuevoPerfil->addAttribute('usuario', $usuario);
        $nuevoPerfil->addAttribute('idioma', $idioma);
    } else {
        echo '<p>El perfil con el usuario ' . $usuario . ' ya existe.</p>';
    }

    // Verificar si el género de película ya existe
    $generoExistente = false;
    foreach ($xmlContent->contenido->peliculas->genero as $gen) {
        if ((string)$gen['nombre'] == $genero) {
            $generoExistente = true;
            $generoP = $gen;  // Usar el género existente
            break;
        }
    }

    if (!$generoExistente) {
        $generoP = $xmlContent->contenido->peliculas->addChild('genero');
        $generoP->addAttribute('nombre', $genero);
    }

    // Agregar títulos de películas
    $generoP->addChild('titulo', $titulo)->addAttribute('duracion', $duracion);
    if ($titulo2) {
        $generoP->addChild('titulo', $titulo2)->addAttribute('duracion', $duracion2);
    }

    // Verificar si el género de series ya existe
    $generoSExistente = false;
    foreach ($xmlContent->contenido->series->genero as $genS) {
        if ((string)$genS['nombre'] == $generoS) {
            $generoSExistente = true;
            $generoS = $genS;  // Usar el género existente
            break;
        }
    }

    if (!$generoSExistente) {
        $generoS = $xmlContent->contenido->series->addChild('genero');
        $generoS->addAttribute('nombre', $generoS);
    }

    // Agregar títulos de series
    $generoS->addChild('titulo', $tituloS)->addAttribute('duracion', $duracionS);
    if ($titulo2S) {
        $generoS->addChild('titulo', $titulo2S)->addAttribute('duracion', $duracion2S);
    }
    // Guardar el archivo XML modificado
    $xmlContent->asXML('catalogoVODN.xml');  

    echo '<div class="card">';
    echo '<h2>Cuenta</h2>';
    echo '<p>Correo: ' . $xmlContent->cuenta['correo'] . '</p>';
    echo '<h3>Perfiles</h3><ul>';
    foreach ($xmlContent->cuenta->perfiles->perfil as $perfil) {
        echo '<li>Usuario: ' . $perfil['usuario'] . ', Idioma: ' . $perfil['idioma'] . '</li>';
    }
    echo '</ul></div>';
    // Películas 
    echo '<h2>Pel&iacute;culas</h2>';
    echo '<table class="table table-dark table-striped table-hover"><thead><tr><th>T&iacute;tulo</th><th>Duraci&oacute;n</th><th>G&eacute;nero</th></tr></thead><tbody>';
    foreach ($xmlContent->contenido->peliculas->genero as $genero) {
        foreach ($genero->titulo as $titulo) {
            echo '<tr><td>' . $titulo . '</td><td>' . $titulo['duracion'] . ' minutos</td><td>' . $genero['nombre'] . '</td></tr>';
        }
    }
    echo '</tbody></table>';

    // Mostrar series
    echo '<h2>Series</h2>';
    echo '<table class="table table-dark table-striped table-hover"><thead><tr><th>T&iacute;tulo</th><th>Duraci&oacute;n</th><th>G&eacute;nero</th></tr></thead><tbody>';
    foreach ($xmlContent->contenido->series->genero as $genero) {
        foreach ($genero->titulo as $titulo) {
            echo '<tr><td>' . $titulo . '</td><td>' . $titulo['duracion'] . ' capitulos</td><td>' . $genero['nombre'] . '</td></tr>';
        }
    }
    echo '</tbody></table>';
}
echo '<div class="mt-4">';
echo '<a href="catalogoVODN.xml" class="btn btn-primary" target="_blank">Descargar Catálogo Actualizado</a>';
echo '</div>';
echo '</div></body></html>';
?>