<?php
include "../../php/conexion.php";

if (!empty($_POST)) {


    $id_Cliente = $_POST['id_cliente'];

    // $query_delete = mysqli_query($conn, "DELETE FROM usuarios WHERE id_usuario = $id_Usuario" );

    $query_delete = mysqli_query($conn, "UPDATE cliente SET estado = 0 WHERE id_cliente = $id_Cliente");
    if ($query_delete) {
        header('location: listaclientes.php');
    } else {
        echo "Error al eliminar";
    }
}

if (empty($_REQUEST['id'])) {

    header('location: listaclientes.php');
} else {



    $id_Cliente = $_REQUEST['id'];

    $query = mysqli_query($conn, "SELECT nombre_cliente FROM cliente  WHERE id_cliente =  $id_Cliente");
    $result = mysqli_num_rows($query);

    if ($result > 0) {
        while ($data = mysqli_fetch_array($query)) {

            $nombre_cliente = $data['nombre_cliente'];
        }
    } else {
        header('location: listaclientes.php');
    }
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Socios | Eliminar Cliente </title>
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
            <!-- <h2>Eliminar usuario</h2> -->
        </div>
        <div id="alert" class="alert alert-danger" role="alert">
            <div class="advertencia">
                <div class="eliminar-dates">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                    </svg>
                </div>

                <div class="adv">
                    <h3>
                        ¿Estás seguro de eliminar el cliente <b> <?php echo $nombre_cliente; ?></b>?
                    </h3>
                </div>
            </div>
            <form class="button-delete" method="post" action="">
                <input type="hidden" name="id_cliente" value=" <?php echo $id_Cliente; ?> ">
                <div id="div-delete" class="form-group">
                    <button id="delete" type="submit" value="Eliminar" class="btn float-right login_btn">
                        Eliminar
                    </button>
                </div>
            </form>
        </div>
        <div class="cancel">
            <a href="listaclientes.php">
                <button id="" type="submit" value="Volver" class="btn float-right login_btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
                    </svg>
                </button>
            </a>
        </div>
    </section>
</body>

</html>