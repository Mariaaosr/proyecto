<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "../clases/ventas.php";

// Log de lo que se recibe
file_put_contents('debug.log', 'POST recibido: ' . print_r($_POST, true) . "\n", FILE_APPEND);

if(!isset($_POST['idproducto'])) {
    echo json_encode(['error' => 'No se recibió el ID del producto']);
    exit;
}

$obj = new ventas();
$datos = $obj->obtenDatosProducto($_POST['idproducto']);

// Log de los datos que se van a devolver
file_put_contents('debug.log', 'Datos a devolver: ' . print_r($datos, true) . "\n", FILE_APPEND);

echo json_encode($datos);
?>