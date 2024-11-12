<?php
    namespace p12\backend\myapi;
    use p12\backend\myapi\DataBase;

    include_once __DIR__.'/DataBase.php';

    class Read extends DataBase{

        public function __construct($db){
            $this->data = array();
            parent::__construct($db);
        }

        public function list(){
                // SE CREA EL ARREGLO QUE SE VA A DEVOLVER EN FORMA DE JSON
            $this->data = array();

            // SE REALIZA LA QUERY DE BÚSQUEDA Y AL MISMO TIEMPO SE VALIDA SI HUBO RESULTADOS
            if ( $result = $this->conexion->query("SELECT * FROM productos WHERE eliminado = 0") ) {
                // SE OBTIENEN LOS RESULTADOS
                $rows = $result->fetch_all(MYSQLI_ASSOC);

                if(!is_null($rows)) {
                    // SE CODIFICAN A UTF-8 LOS DATOS Y SE MAPEAN AL ARREGLO DE RESPUESTA
                    foreach($rows as $num => $row) {
                        foreach($row as $key => $value) {
                            $this->data[$num][$key] = utf8_encode($value);
                        }
                    }
                }
                $result->free();
            } else {
                die('Query Error: '.mysqli_error($this->conexion));
            }
            $this->conexion->close();
    
        }

        public function search($dato){
            $this->data = array();
            // SE VERIFICA HABER RECIBIDO LA BUSQUEDA
            if( isset($dato) ) {
                $search = $dato;
                // SE REALIZA LA QUERY DE BÚSQUEDA Y AL MISMO TIEMPO SE VALIDA SI HUBO RESULTADOS
                $sql = "SELECT * FROM productos WHERE (id = '{$search}' OR nombre LIKE '%{$search}%' OR marca LIKE '%{$search}%' OR detalles LIKE '%{$search}%') AND eliminado = 0";
                if ( $result = $this->conexion->query($sql) ) {
                    // SE OBTIENEN LOS RESULTADOS
                    $rows = $result->fetch_all(MYSQLI_ASSOC);

                    if(!is_null($rows)) {
                        // SE CODIFICAN A UTF-8 LOS DATOS Y SE MAPEAN AL ARREGLO DE RESPUESTA
                        foreach($rows as $num => $row) {
                            foreach($row as $key => $value) {
                                $this->data[$num][$key] = utf8_encode($value);
                            }
                        }
                    }
                    $result->free();
                } else {
                    die('Query Error: '.mysqli_error($this->conexion));
                }
                $this->conexion->close();
            } 

        }
        
        public function searchByName($search){
            $this->data = array();
           // SE VERIFICA HABER RECIBIDO EL NOMBRE
            $name = $search;
            if( isset($name) ) {
                // SE REALIZA LA QUERY DE BÚSQUEDA Y AL MISMO TIEMPO SE VALIDA SI HUBO RESULTADOS
                $sql = "SELECT * FROM productos WHERE nombre = '{$name}' AND eliminado = 0";
                if($result = $this->conexion->query($sql)){
                    if ( $result->num_rows > 0) {
                        $this->data['status'] =  "success";
                        $this->data['message'] =  "Nombre ya registrado";
                    } 
                }      
                $this->conexion->close();
            } 
        }
        public function single($id_){
            $this->data = array();

            if( isset($id_)) {
                $id = $id_;
                $sql = "SELECT * FROM productos WHERE id = '{$id}'";
                if ( $result = $this->conexion->query($sql) ) {
                    $rows = $result->fetch_all(MYSQLI_ASSOC);
                    if(!is_null($rows)) {
                        foreach($rows as $num => $row) {
                            foreach($row as $key => $value) {
                                $this->data[$num][$key] = utf8_encode($value);  // CODIFICA CADA CAMPO EN UTF-8
                            }
                        }
                    }
                    $result->free();
                } else {
                    die('Query Error: '.mysqli_error($this->conexion));
                }
                $this->conexion->close();
            }
        }

        public function singleByName($name){
            $this->data = array();

            if( isset($name) ) {
                $nombre = $name;

                $sql = "SELECT * FROM productos WHERE nombre = '{$nombre}'";

                if ( $result = $this->conexion->query($sql) ) {
                    $rows = $result->fetch_all(MYSQLI_ASSOC);

                    if(!is_null($rows)) {
                        foreach($rows as $num => $row) {
                            foreach($row as $key => $value) {
                                $this->data[$num][$key] = utf8_encode($value);  // CODIFICA CADA CAMPO EN UTF-8
                            }
                        }
                    }
                    $result->free();
                } else {
                    die('Query Error: '.mysqli_error($this->conexion));
                }
                $this->conexion->close();
            }
        }

    }
?>