<?php
$server = "localhost";
$user = "root";
$password = "";
$db = "concesionariov2";

$conect = new mysqli($server, $user, $password, $db);

if (isset($_GET["ID_venta"])) {
    $ID_venta = $_GET["ID_venta"];

    $sql = "DELETE FROM ventas WHERE ID_venta=$ID_venta";
    $conect->query($sql);
}

header("Location: /index.php");
exit;
?>
