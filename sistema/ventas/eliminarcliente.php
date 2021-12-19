<?php
include "../../php/conexion.php";

if (!empty($_POST)) {
  

    $id_Cliente = $_POST ['id_cliente'];

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
    <title>Ventas | Eliminar Cliente </title>
    <meta name="keywords" content="">
    <meta name="description" content="">

    <!-- Favicons -->
    <link rel="icon" href="../../img/LOGO-ICON.ico">

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
            <h2>Eliminar cliente</h2>
        </div>
        <div id="alert" class="alert alert-danger" role="alert">
            <div class="eliminar-dates">
                <p> <b> <span>ID:</span> <?php echo $id_Cliente; ?> </b></p>
                <p> <b> <span>Nombre:</span> <?php echo $nombre_cliente; ?> </b></p>
            </div>
            <div class="advertencia">
                <!-- <div class="eliminar-svg">
                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                    </svg>
                </div> -->
                <div class="adv">
                    <h3>
                        ¿Estás seguro de eliminar el cliente?
                    </h3>
                </div>
            </div>
            <form class="button-delete" method="post" action="">
                <input type="hidden" name="id_cliente" value=" <?php echo $id_Cliente; ?> ">
                <div id="div-delete" class="form-group">
                    <button id="delete" type="submit" value="Eliminar" class="btn float-right login_btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                        </svg></button>
                    <butt>
                </div>
            </form>
        </div>
    </section>
</body>

</html>