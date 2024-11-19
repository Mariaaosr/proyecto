<?php

    class ventas{
        public function obtenDatosProducto($idproducto){
            try {
                $conection = new mysqli("localhost", "root", "", "consecionario");
                if ($conection->connect_error) {
                    throw new Exception("Error de conexión: " . $conection->connect_error);
                }
                $conection->set_charset("utf8");
        
                $sql = "SELECT ID_auto, Marca, Precio FROM autos WHERE ID_auto = '$idproducto'";
                $result = $conection->query($sql);
        
                if (!$result) {
                    throw new Exception("Error en la consulta: " . $conection->error);
                }
        
                $ver = mysqli_fetch_row($result);
                
                if ($ver) {
                    $datos = array(
                        'ID' => $ver[0],
                        'Marca' => $ver[1],
                        'Precio' => $ver[2]
                    );
                    return $datos;
                } else {
                    return array('error' => 'No se encontró el auto');
                }
            } catch(Exception $e) {
                return array('error' => $e->getMessage());
            }
        }
    }

?>