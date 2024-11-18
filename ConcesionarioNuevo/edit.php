<?php
$server = "localhost";
$user = "root";
$password = "";
$db = "concesionariov2";


$conect = new mysqli($server, $user, $password, $db);



$ID_venta = "";
$Nombre = "";
$Apellido = "";
$Modelo = "";
$precio = "";
$sucursal = "";
$fecha = "";

$errorMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    
    if (!isset($_GET["ID_venta"]) || empty($_GET["ID_venta"])) {
        header("Location: /index.php");
        exit;
    }

    $ID_venta = $conect->real_escape_string($_GET["ID_venta"]);

    
    $sql = "SELECT * FROM ventas WHERE ID_venta = '$ID_venta'";
    $result = $conect->query($sql);

    if ($result->num_rows == 0) {
        echo "Registro no encontrado.";
        exit;
    }

    $row = $result->fetch_assoc();

    $Nombre = $row["Nombre"];
    $Apellido = $row["Apellido"];
    $Modelo = $row["Modelo"];
    $precio = $row["precio"];
    $sucursal = $row["sucursal"];
    $fecha = $row["fecha"];
} else {
    
    $ID_venta = $_POST["ID_venta"];
    $Nombre = $_POST["Nombre"];
    $Apellido = $_POST["Apellido"];
    $Modelo = $_POST["Modelo"];
    $precio = $_POST["precio"];
    $sucursal = $_POST["sucursal"];
    $fecha = $_POST["fecha"];

    do {
        if (empty($Nombre) || empty($Apellido) || empty($Modelo) || empty($precio) || empty($sucursal) || empty($fecha)) {
            $errorMessage = "Completar todos los campos";
            break;
        }

        $sql = "UPDATE ventas 
                SET Nombre = '$Nombre', Apellido = '$Apellido', Modelo = '$Modelo', 
                    precio = '$precio', sucursal = '$sucursal', fecha = '$fecha'
                WHERE ID_venta = '$ID_venta'";

        if (!$conect->query($sql)) {
            $errorMessage = "Error al actualizar";
            break;
        }


        header("Location: /index.php");
        exit;
    } while (false);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Editar</title>
   
</head>
<body>
    <div class="container my-5">
        <h2>Editar</h2>

     
        <form method="post">
            <input type="hidden" name="ID_venta" value="<?php echo $ID_venta ?>">

            <div class="mb-3">
                <label class="col-sm-3 col-form-label">Nombre</label>
                <input type="text" class="form-control" id="Nombre" name="Nombre" value="<?= $Nombre ?>" required>
            </div>

            <div class="mb-3">
                <label class="col-sm-3 col-form-label">Apellido</label>
                <input type="text" class="form-control" id="Apellido" name="Apellido" value="<?= $Apellido ?>" required>
            </div>

            <div class="mb-3">
                <label class="col-sm-3 col-form-label">Modelo</label>
                <input type="text" class="form-control" id="Modelo" name="Modelo" value="<?= $Modelo ?>" required>
            </div>

            <div class="mb-3">
                <label class="col-sm-3 col-form-label">Precio</label>
                <input type="number" step="0.01" class="form-control" id="precio" name="precio" value="<?= $precio ?>" required>
            </div>

            <div class="mb-3">
                <label class="col-sm-3 col-form-label">Sucursal</label>
                <input type="text" class="form-control" id="sucursal" name="sucursal" value="<?= $sucursal ?>" required>
            </div>

            <div class="mb-3">
                <label class="col-sm-3 col-form-label">Fecha</label>
                <input type="date" class="form-control" id="fecha" name="fecha" value="<?= $fecha ?>" required>
            </div>

            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="/index.php" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</body>
</html>
