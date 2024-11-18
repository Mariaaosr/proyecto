<?php

if(!empty($_POST["btningresar"])){
    if(empty($_POST["usuario"]) and empty($_POST["password"])){
        echo '<div class = "alert alert-danger">CAMPOS VACIOS</div>';
    }else{
        $usuario = $_POST["usuario"];
        $pass = $_POST["password"];

        $sql = $conection->query("select * from usuario where usuario='$usuario' and pass='$pass'");
        if($datos = $sql->fetch_object()){
            header("location: inicio.php");
        }else{
            echo '<div class = "alert alert-danger">DENEGADO</div>';
        }
    }
}
?>