<?php
include "../../php/conexion.php";
date_default_timezone_set("America/Bogota");
setlocale(LC_MONETARY, 'es_CO');

if (!empty($_POST)) {
    $alert = '';
    if (
        empty($_POST['id_producto']) || empty($_POST['id_bodega'])
        || empty($_POST['cantidad_compra']) || empty($_POST['id_proveedor'])
    ) {
        $alert = '<div id="alert" class="alert alert-warning d-flex align-items-center" role="alert">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                    </svg><b> Error! Todos los campos son obligatorios.  </b> 
                </div> ';
    } else {

        $id_proveedor = $_POST['id_producto'];
        $id_usuario = $_POST['id_usuario'];
        $fecha_compra = $_POST['fecha_compra'];

        $query_compra = mysqli_query($conn, "SELECT * FROM compra");
        $result_compra = mysqli_fetch_array($query_compra);


        if ($result_compra > 0) {
            $query_insert_compra = mysqli_query($conn, "INSERT INTO compra (id_usuario, 
            id_proveedor, fecha_compra) VALUES ('$id_usuario','$id_proveedor','$fecha_compra')");

            $id_producto = $_POST['id_producto'];
            $id_bodega = $_POST['id_bodega'];
            $cantidad_compra = $_POST['cantidad_compra'];

            $query_detcompra = mysqli_query($conn, "SELECT * FROM detalle_compra");
            $result_detcompra = mysqli_fetch_array($query_detcompra);

            if ($result_detcompra > 0) {
                $query_insert_detcompra = mysqli_query($conn, "INSERT INTO detalle_compra (id_producto, 
                id_bodega, cantidad_compra) VALUES ('$id_producto','$id_bodega','$cantidad_compra')");

                if ($query_insert_compra && $query_insert_detcompra) {
                    $alert = '<div id="alert" class="alert alert-success d-flex align-items-center" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                </svg>Compra generada con exito
                </div>';
                } else {
                    $alert = '<div id="alert" class="alert alert-danger d-flex align-items-center" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                </svg><b> Error al crear el producto. </b> 
                </div>';
                }
            }
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compras | Crear proveedor </title>
    <meta name="keywords" content="">
    <meta name="description" content="">

    <!-- Favicons -->
    <link rel="icon" href="../../img/StockS.ico">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Poppins:300,400,500,700" rel="stylesheet">
    <script src="https://kit.fontawesome.com/7f19db1c03.js" crossorigin="anonymous"></script>


</head>

<body>
    <header>
        <?php include '../generales/headerapp.php' ?>

    </header>
    <section>
        <div class="tittle-compra">
            <h2>Crear compra</h2> <br>
        </div>

        <!-- formulario  -->
        <form action="" method="post">
            <div class="formulario" id="formulario">

                <!-- compra -->
                <div class="content-form1">

                    <!-- fecha -->
                    <div class="form-group">
                        <label for="formGroupExampleInput">Fecha</label>
                        <input class="form-control" name="fecha_compra" id="" value="<?php echo date("Y-m-d"); ?>" disabled>
                    </div>

                    <!-- usuario -->
                    <div class="form-group">
                        <label for="formGroupExampleInput">Nombre usuario</label>
                        <input class="form-control" aria-label="Default select example" name="id_usuario" value="<?php echo $_SESSION['nombre_usuario']; ?>" disabled>
                    </div>

                    <!-- proveedor -->
                    <div class="form-group">
                        <label for="formGroupExampleInput2">Proveedor</label>
                        <select class="form-control" aria-label="Default select example" name="id_proveedor" id="id_proveedor">
                            <?php
                            $query = $conn->query("SELECT * FROM proveedor WHERE estado=1 ORDER BY nombre_proveedor ASC");
                            while ($row = $query->fetch_assoc()) {
                                $value = "value=\"$row[id_proveedor]\"";                      #El id_colaborador lo tomaremos del value
                                echo "<option $value $data>$row[nombre_proveedor] </option>";           #El nombre lo tomaremos del text
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
        </form>

        <!-- detalle compra -->
        <div class="content-form2">
            <table class="table" id="table">
                <thead>
                    <tr style="background-color:#F4F4F4">
                        <th width="150px">Producto</th>
                        <th width="150px">Bodega a ingresar </th>
                        <th width="80px">Cantidad</th>
                        <th width="120px">Costo unitario </th>
                        <th width="130px">Costo total </th>
                        <th width="100px">Acciones </th>
                    </tr>
                    <tr>
                        <td><input class="form-control" aria-label="Default select example" name="id_producto" 
                        id="id_producto"></td>
                        <td><input class="form-control" aria-label="Default select example" name="cantidad_producto"></td>
                        <td><input class="form-control" aria-label="Default select example" name="id_bodega"></td>
                        <td><input class="form-control" aria-label="Default select example" name="costo_producto" disabled></td>
                        <td><input class="form-control" aria-label="Default select example" name="costo_total" disabled></td>
                        <td>
                            <a class="form-control" aria-label="Default select example" name="" id="add"> <i class="fas fa-plus"></i> Agregar </a>
                        </td>
                    </tr>
                    <tr>
                        <td> </td>
                        <td> </td>
                        <td> </td>
                        <td> </td>
                        <td> </td>
                        <td> </td>

                    </tr>
                    <tr style="background-color:#F4F4F4">
                        <th width="150px">Producto</th>
                        <th width="150px">Bodega a ingresar </th>
                        <th width="80px">Cantidad</th>
                        <th width="120px">Costo unitario </th>
                        <th width="130px">Costo total </th>
                        <th width="100px">Acciones </th>
                    </tr>
                </thead>
                <tbody id="detalle_compra">
                    <tr>
                        <td>Pintura</td>
                        <td>001</td>
                        <td>2</td>
                        <td>100</td>
                        <td>200</td>
                        <td><a class="form-control" aria-label="Default select 
                            example" name="" onclick="event.preventDefault();del_product_detalle(1);" id="quit""><i class=" far fa-trash-alt"></i></a> </td>
                    </tr>
                    <tr>
                        <td>Casco</td>
                        <td>001</td>
                        <td>4</td>
                        <td>400</td>
                        <td>1200</td>
                        <td><a class="form-control" aria-label="Default select example" name="" onclick="event.preventDefault();del_product_detalle(1);" id="quit""><i class=" far fa-trash-alt"></i></a>
                        </td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2" class="textright"> <b>TOTAL</b> </td>
                        <td class="textright">6</td>
                        <td class="textright">500</td>
                        <td class="textright">1400</td>
                    </tr>
                </tfoot>
            </table>
            <!-- <a class="button-compra">
                <input id="login" type="button" value="Procesar" class="btn float-right login_btn">
            </a> -->
        </div>
        <?php echo isset($alert) ? $alert : ''; ?>
    </section>

</body>

</html>

<script>
    // traer datos según id de producto

    document.getElementById('producto').onchange = function() {
        /* Referencia al option seleccionado */
        var mOption = this.options[this.selectedIndex];
        /* Referencia a los atributos data de la opción seleccionada */
        var mData = mOption.dataset;

        /* Referencia a los input */
        var elId = document.getElementById('id');
        var elCosto = document.getElementById('costo_producto');
        var elCostototal = document.getElementById('costo_total')


        /* Asignamos cada dato a su input*/
        elId.value = this.value;
        elCosto.value = mData.costo_producto;

        elCostototal.value = mData.costo_producto * document.getElementById('cantidad_producto').value;

    };

    // buscar producto
        $('id_producto').keyup(function(e) {
            e.preventDefault();

            var pr = $(this).val ();
            var action = 'searchProducto';

            $ajax ({
                url: '../generales/ajax.php',
                type:"POST",
                async : true,
                data: {action:action,product: pr},

                success: function(response) {
                    console.log(response);
                },
                error: function(error) {

                }
            });

        });
</script>