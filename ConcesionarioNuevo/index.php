<!DOCTYPE html>
<html>
<head>
    <title>Lista</title>
</head>
<body>
    <div class="container my-5">
        <h2>Lista Ventas</h2>
        <a class="btn btn-primary" href="/create.php" role="button">Registrar Venta</a>
        <br>
        <table class="table">
            <thead>
                <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Marca</th>
                <th>Precio</th>
                <th>Sucursal</th>
                <th>Fecha</th>  
                </tr>   
            </thead>
        
    <tbody>
        <?php
            $server = "localhost";
            $user = "root";
            $password = "";
            $db = "concesionariov2";
            
            $conect = new mysqli($server, $user, $password, $db);

            $sql = "SELECT * FROM ventas";
            $result = $conect->query($sql);

            while($row = $result->fetch_assoc()){
                echo "
                    <tr>
                        <td>$row[ID_venta]</td>
                        <td>$row[Nombre]</td>
                        <td>$row[Apellido]</td>
                        <td>$row[Modelo]</td>
                        <td>$row[precio]</td>
                        <td>$row[sucursal]</td>
                        <td>$row[fecha]</td>
                        <td>
                            <a class='btn btn-primary btn-sm' href='/edit.php?ID_venta=$row[ID_venta]'>Edit</a>
                            <a class='btn btn-danger btn-sm' href='/delete.php?ID_venta=$row[ID_venta]'>Delete</a>
                        </td>
                    </tr>


                ";
            }
            
        ?>
        </tbody>
    </table>
</body>
</html>