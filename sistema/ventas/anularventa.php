<?php
include "../../php/conexion.php";

if (!empty($_POST)) {


    $id_Venta = $_POST['id_venta'];

    // $query_delete = mysqli_query($conn, "DELETE FROM usuarios WHERE id_usuario = $id_Usuario" );

    $query_anular = mysqli_query($conn, "CALL anular_venta('$id_Venta')");
    if ($query_anular) {
        header('location: listaventas.php');
    } else {
        echo "Error al anular la venta";
    }
}

if (empty($_REQUEST['id'])) {

    header('location: listaventas.php');
} else {

    $id_Venta = $_REQUEST['id'];

    $query = mysqli_query($conn, "SELECT v.id_venta, v.total_venta,                                 
                                        cl.nombre_cliente as cliente 
                                        FROM venta v
                                        INNER JOIN cliente cl
                                        ON v.id_cliente = cl.id_cliente 
                                        WHERE id_venta =  $id_Venta");
    $result = mysqli_num_rows($query);

    if ($result > 0) {
        while ($data = mysqli_fetch_array($query)) {
            $id_factura = $data['id_venta'];
            $valor = $data['total_venta'];
            $nombre_cliente = $data['cliente'];
        }
    } else {
        header('location: listaventas.php');
    }
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ventas | Anular venta </title>
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
        <div class="tittle">
            <!-- <h2>Anular venta</h2> -->
        </div>
        <div id="alert" class="alert alert-danger" role="alert">
            <div class="advertencia">


                <div class="adv">
                    <h3> <b>¿Estás seguro de anular esta venta? </b></h3>
                    <div class="description-anular">
                        <p> <b>Factura: </b>  #<?php echo $id_factura; ?> </p>
                        <p><b>Valor: </b>$<?php echo $valor; ?> </p>
                        <p><b>Cliente: </b> <?php echo $nombre_cliente; ?> </p>
                    </div>


                </div>
            </div>
            <form class="button-delete" method="post" action="">
                <input type="hidden" name="id_venta" value=" <?php echo $id_Venta; ?> ">
                <div id="div-delete" class="form-group">
                    <button id="delete" type="submit" value="Eliminar" class="btn float-right login_btn">
                        Anular
                    </button>
                </div>
            </form>
        </div>
    </section>
</body>

</html>