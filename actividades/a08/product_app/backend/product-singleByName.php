<?php
    use backend\myapi\Products;
    include_once __DIR__.'/myapi/Products.php';

    $prodObj = new Products('marketzone');
    $nombre = $_GET['nombre'];  $prodObj->singleByName($nombre);
    
    echo $prodObj->getData();
?>