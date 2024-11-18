<?php


$conection = new mysqli("localhost", "root", "", "consecionario", "3306");
$conection->set_charset("utf8");



$server = "localhost";
$user = "root";
$password = "";
$db = "consecionario";

$conexion =  new mysqli($server, $user, $password, $db);

if($conexion->connect_errno){
    die("conexion fallida" . $conexion->connect_errno);
}else{
    echo "conectado";
}
?>