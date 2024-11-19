<?php
// Configuración de la base de datos
$server = "localhost";
$user = "root";
$password = "";
$db = "consecionario";

// Crear la conexión
try {
    $conection = new mysqli($server, $user, $password, $db);
    $conection->set_charset("utf8");

    // Verificar la conexión
    if ($conection->connect_error) {
        die("Error de conexión: " . $conection->connect_error);
    }
} catch (Exception $e) {
    die("Error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Venta de Producto</title>
    <!-- Agregar jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Agregar Select2 para mejorar los selects -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h4>Vender un producto</h4>
        <div class="row">
            <div class="col-sm-4">
                <form id="frmVentasProductos">
                    <div class="mb-3">
                        <label class="form-label">Selecciona Cliente</label>
                        <select class="form-control input-sm" id="clienteVenta" name="clienteVenta">
                            <option value="">Selecciona</option>
                            <?php
                            $sql = "SELECT ID_cliente, Nombre, Apellido FROM clientes";
                            $result = $conection->query($sql);

                            if ($result && $result->num_rows > 0) {
                                while ($cliente = $result->fetch_assoc()) {
                                    echo "<option value='" . $cliente['ID_cliente'] . "'>" . 
                                        htmlspecialchars($cliente['Nombre']) . " " . 
                                        htmlspecialchars($cliente['Apellido']) . 
                                        "</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Producto</label>
                        <select class="form-control input-sm" id="productoVenta" name="productoVenta">
                            <option value="">Selecciona</option>
                            <?php
                            $sql = "SELECT ID_auto, Marca FROM autos";
                            $result = $conection->query($sql);

                            if ($result && $result->num_rows > 0) {
                                while($auto = $result->fetch_assoc()) {
                                    echo "<option value='" . $auto['ID_auto'] . "'>" . 
                                        htmlspecialchars($auto['Marca']) . 
                                        "</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Precio</label>
                        <input type="text" class="form-control input-sm" id="precioV" name="precioV" readonly>
                    </div>

                    <button type="button" class="btn btn-primary" id="btnAgregar">Agregar</button>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript">
    $(document).ready(function(){
        // Inicializar Select2
        $('#clienteVenta').select2();
        $('#productoVenta').select2();

        // Manejar el cambio en el select de productos
        $('#productoVenta').on('change', function(){
            let idProducto = $(this).val();
            
            if(idProducto) {
                $.ajax({
                    type: "POST",
                    url: "../procesos/llenarFormProducto.php",
                    data: {
                        idproducto: idProducto
                    },
                    dataType: 'json',
                    success: function(response){
                        console.log("Respuesta:", response);
                        if(response.Precio) {
                            $('#precioV').val(response.Precio);
                        } else if(response.error) {
                            console.error("Error:", response.error);
                            alert("Error al obtener el precio: " + response.error);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Error en la petición AJAX:", error);
                        alert("Error al comunicarse con el servidor");
                    }
                });
            } else {
                $('#precioV').val('');
            }
        });
    });
    </script>


<script type="text/javascript">

	function crearVenta(){
		$.ajax({
			url:"../procesos/ventas/crearVenta.php",
			success:function(r){
				if(r > 0){
					$('#frmVentasProductos')[0].reset();
					alertify.alert("Venta creada con exito, consulte la informacion de esta en ventas hechas :D");
				}else if(r==0){
					alertify.alert("No hay lista de venta!!");
				}else{
					alertify.error("No se pudo crear la venta");
				}
			}
		});
	}
</script>


</body>
</html>