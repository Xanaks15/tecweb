<?php
    use p12\backend\myapi\Read;
    include_once __DIR__.'/myapi/Read.php';

    $prodObj = new Read('marketzone');
    $id = $_POST['id'];  $prodObj->single($id);
    
    echo $prodObj->getData();


    // $data = array();

    // if( isset($_POST['id']) ) {
    //     $id = $_POST['id'];

    //     $sql = "SELECT * FROM productos WHERE id = '{$id}'";

    //     if ( $result = $conexion->query($sql) ) {
    //         $rows = $result->fetch_all(MYSQLI_ASSOC);

    //         if(!is_null($rows)) {
    //             foreach($rows as $num => $row) {
    //                 foreach($row as $key => $value) {
    //                     $data[$num][$key] = utf8_encode($value);  // CODIFICA CADA CAMPO EN UTF-8
    //                 }
    //             }
    //         }
    //         $result->free();
    //     } else {
    //         die('Query Error: '.mysqli_error($conexion));
    //     }
    //     $conexion->close();
    // }

    // echo json_encode($data, JSON_PRETTY_PRINT);

    
?>