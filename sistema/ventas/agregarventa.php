<?php
include "../../php/conexion.php";
date_default_timezone_set("America/Bogota");
setlocale(LC_MONETARY, 'es_CO');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Ventas | Crear venta </title>
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

        <!-- titulo -->
        <div class="tittle-venta">
            <h2>Crear venta</h2>
        </div>

        <!-- información -->
        <div class="content-form1">
            <!-- fecha -->
            <div class="form-group" id="div-fecha">
                <input class="form-control" name="fecha_venta" id="fecha" value="<?php echo date("Y-m-d"); ?>" disabled>
            </div>
            <!-- usuario -->
            <div class="form-group" id="div-usuario">
                <input class="form-control" aria-label="Default select example" id="usuario" name="id_usuario" value="<?php echo $_SESSION['nombre_usuario']; ?>" disabled>
            </div>

        </div>

        <!-- form cliente -->
        <form name="add_cliente" id="add_cliente" action="" class="content-form2">
            <input type="hidden" name="action" value="Cliente">
            <input type="hidden" name="id" id="id" value="" required>

            <div class="search_clientes">
                <!-- cliente -->
                <div class="form-group">
                    <input class="form-control" aria-label="Default select example" id="id_cliente" name="id_cliente" value="" placeholder="ID cliente">
                </div>

                <!-- button-agregar cliente -->
                <a class="button-cliente">
                    <svg id="agregar-cliente" xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                    </svg>
                    <p>Agregar cliente</p>
                </a>

            </div>
            <div class="info_clientes">
                <!-- fecha -->
                <div class="form-group">
                    <input class="form-control" value="" id="nombre_cliente" name="nombre_cliente" placeholder="Nombre" disabled>
                </div>
                <!-- usuario -->
                <div class="form-group">
                    <input class="form-control" aria-label="Default select example" value="" placeholder="Teléfono" id="telefono_cliente" name="telefono_cliente" disabled>
                </div>
                <!-- usuario -->
                <div class="form-group">
                    <input class="form-control" aria-label="Default select example" id="direccion_cliente" placeholder="Dirección" name="direccion_cliente" disabled>
                </div>
                <!-- botón para guardar cliente -->
                <div class="guardar-cliente">
                    <a class="">
                        <input id="agg_cliente" type="submit" value="Guardar" class="btn float-right login_btn">
                    </a>
                </div>
            </div>
        </form>

        <!-- detalle venta -->
        <div class="content-formdet">
            <table class="table" id="table-venta">
                <thead>
                    <tr style="background-color:#F4F4F4">
                        <th width="80px">ID</th>
                        <th width="200px">Producto</th>
                        <th width="10px">Existencia</th>
                        <th width="10px">Cantidad</th>
                        <th width="150px">Precio unitario </th>
                        <th width="200px">Precio total </th>
                        <th width="100px">Acciones </th>
                    </tr>
                    <tr>
                        <td><input class="form-control" aria-label="Default select example" name="id_producto" id="id_producto"></td>
                        <td><input class="form-control " aria-label="Default select example" name="nameProduct" id="txt_nameProduct" disabled></td>
                        <td><input class="form-control" aria-label="Default select example" name="existencia" id="txt_existenciaProducto" disabled></td>
                        <td><input min="1" class="form-control" aria-label="Default select example" name="cantidad" id="txt_cantidad" disabled></td>
                        <td><input class="form-control" aria-label="Default select example" name="precio" id="txt_precio" disabled></td>
                        <td><input class="form-control" aria-label="Default select example" name="precio_total" id="txt_precioTotal" disabled></td>
                        <td class="input-add">
                            <a class="form-control" aria-label="Default select example" name="" id="add">
                                <svg id="agregar-producto" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                                </svg>
                                Agregar </a>
                        </td>
                    </tr>
                    <tr>
                        <td> </td>
                        <td> </td>
                        <td> </td>
                        <td> </td>
                        <td> </td>
                        <td> </td>
                        <td> </td>

                    </tr>
                    <tr style="background-color:#F4F4F4">
                        <th width="80px">ID</th>
                        <th colspan="2" width="200px">Producto</th>
                        <th width="10px">Cantidad</th>
                        <th width="150px">Precio unitario </th>
                        <th width="150px">Precio total </th>
                        <th width="100px">Acciones </th>
                    </tr>
                </thead>
                <tbody id="detalle_venta">
                    <!-- contenido se obtiene de ajax -->
                </tbody>
                <tfoot id="detalle_totales">
                    <!-- contenido se obtiene de ajax -->
                </tfoot>
            </table>
            <div class="botones-venta">
                <a class="button-procesar" id="button-procesar">
                    <input id="procesar" type="button" value="Procesar" class="btn float-right login_btn">
                </a>
                <a class="button-anular" id="button-anular">
                    <input id="anular" type="button" value="Limpiar" class="btn float-right login_btn">
                </a>
            </div>
        </div>

    </section>



</body>

</html>

<script src="../generales/funciones.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        var usuario_id = <?php echo $_SESSION['id_usuario'] ?>;
        searchForDetalle(usuario_id);
    });
</script>