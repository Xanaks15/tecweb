<?php
    use p12\backend\myapi\Read;
    include_once __DIR__.'/myapi/Read.php';

    $prodObj = new Read('marketzone');
    $nombre = $_GET['nombre'];  $prodObj->searchByName($nombre);
    
    echo $prodObj->getData();
?>