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
$succesMessage = "";


if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $ID_venta = $_POST["ID_venta"];
    $Nombre = $_POST["Nombre"];
    $Apellido = $_POST["Apellido"];
    $Modelo = $_POST["Modelo"];
    $precio = $_POST["precio"];
    $sucursal = $_POST["sucursal"];
    $fecha = $_POST["fecha"];

    do{
        if(empty($Nombre) || empty($Apellido) || empty($Modelo) || empty($precio) ||
        empty($sucursal) || empty($fecha)){
            $errorMessage = "...";
            break;
        }

        $sql="insert into ventas values ('$ID_venta', '$Nombre','$Apellido','$Modelo','$precio', '$sucursal', '$fecha')";

        $resultado= mysqli_query($conect, $sql);

        if($resultado){
            echo "<script>
            Swal.fire({
                title: 'Good job!',
                text: 'You clicked the button!',
                icon: 'success'
            });
            </script>";

        }else{
            echo "<script
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Something went wrong!'
              });
            </script>";
        }



        $ID_venta = "";
        $Nombre = "";
        $Apellido = "";
        $Modelo = "";
        $precio = "";
        $sucursal = "";
        $fecha = "";

        $succesMessage = "Add";

        header("location: /index.php");
        exit;

    }while(false);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    
    <title>CONCESIONARIO</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body>
    <div class="container my-5"></div>
        <h2>REGISTRAR VENTA</h2>

        <?php

        if(!empty($errorMessage)){
            echo "
            <div class='alert alert-warning alert-dismissable fade show' role='alert'>
                <strong>$errorMessage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' arial-label='Close'></button>
            </div>
            ";
        }

        ?>


        <form method="post">
            <div class = "row mb-3">
                <label class="col-sm-3 col-form-label">Nombre</label>
                <div class="col-cm-6">
                    <input type="text" class="form-control" name="Nombre" value="<?php echo $Nombre; ?>">
                </div>
            </div>

            <div class = "row mb-3">
                <label class="col-sm-3 col-form-label">Apellido</label>
                <div class="col-cm-6">
                    <input type="text" class="form-control" name="Apellido" value="<?php echo $Apellido; ?>">
                </div>
            </div>

            <div class = "row mb-3">
                <label class="col-sm-3 col-form-label">Modelo</label>
                <div class="col-cm-6">
                    <input type="text" class="form-control" name="Modelo" value="<?php echo $Modelo; ?>">
                </div>
            </div>

            <div class = "row mb-3">
                <label class="col-sm-3 col-form-label">Precio</label>
                <div class="col-cm-6">
                    <input type="text" class="form-control" name="precio" value="<?php echo $precio; ?>">
                </div>
            </div>

            <div class = "row mb-3">
                <label class="col-sm-3 col-form-label">Sucursal</label>
                <div class="col-cm-6">
                    <input type="text" class="form-control" name="sucursal" value="<?php echo $sucursal; ?>">
                </div>
            </div>

            <div class = "row mb-3">
                <label class="col-sm-3 col-form-label">Fecha</label>
                <div class="col-cm-6">
                    <input type="date" class="form-control" name="fecha" value="<?php echo $fecha; ?>">
                </div>
            </div>


            <div class = "row mb-3">
                <div class="offset-sm-3 col-sm-3-d-grid">
                <button type="submit" class="btn-btn-primary">Submit</button>
                </div>
                <div class="offset-sm-3 col-sm-3-d-grid">
                <a class="btn btn-outline-primary" href="/index.php" role="button">Cancel</a>
                </div>
            
            </div>

        </form>
</body>
</html>