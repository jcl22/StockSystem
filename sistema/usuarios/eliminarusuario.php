<?php
include "../../php/conexion.php";

if (!empty($_POST)) {    

    $id_Usuario = $_POST ['id_usuario'];

    // $query_delete = mysqli_query($conn, "DELETE FROM usuarios WHERE id_usuario = $id_Usuario" );

    $query_delete = mysqli_query($conn, "UPDATE usuarios SET estado = 0 WHERE id_usuario = $id_Usuario");

    if ($query_delete) {
        header('location: listausuarios.php');
    } else {
        echo "Error al eliminar";        
    }
}

if (empty($_REQUEST['id'])) {
    header('location: listausuarios.php');
} else {

    
    $id_Usuario = $_REQUEST['id'];

    $query = mysqli_query($conn, "SELECT u.nombre_usuario, u.usuario, r.nombre_rol FROM usuarios u INNER JOIN rol r ON u.id_rol = r.id_rol WHERE u.id_usuario =  $id_Usuario");
    $result = mysqli_num_rows($query);

    if ($result > 0) {
        while ($data = mysqli_fetch_array($query)) {

            $nombre_usuario = $data['nombre_usuario'];
            $usuario = $data['usuario'];
            $nombre_rol = $data['nombre_rol'];
        }
    } else {
        header('location: listausuarios.php');
    }
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios | Eliminar Usuario</title>
    <meta name="keywords" content="">
    <meta name="description" content="">

    <!-- Favicons -->
    <link rel="icon" href="../../img/LOGO-ICON.ico">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Poppins:300,400,500,700" rel="stylesheet">
    <script src="https://kit.fontawesome.com/7f19db1c03.js" crossorigin="anonymous"></script>

    <?php include '../../php/scripts2.php' ?>

</head>

<body>

    <?php include '../generales/header2.php' ?>

    <section id="content-section">
        <div class="titulo-section">
            <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" fill="currentColor" class="bi bi-person-x" viewBox="0 0 16 16">
                <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                <path fill-rule="evenodd" d="M12.146 5.146a.5.5 0 0 1 .708 0L14 6.293l1.146-1.147a.5.5 0 0 1 .708.708L14.707 7l1.147 1.146a.5.5 0 0 1-.708.708L14 7.707l-1.146 1.147a.5.5 0 0 1-.708-.708L13.293 7l-1.147-1.146a.5.5 0 0 1 0-.708z" />
            </svg>
        </div>
        <div class="container-eliminar">
            <div class="content">
                <div class="eliminar">
                    <h3>
                        <!-- <span>¡Cuidado!</span>  -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                        </svg> <br>
                        Esto es importante. ¿Estás seguro de eliminar el usuario?
                    </h3>
                    <div class="datos-usuarioeliminar">
                        <p> <b> <span>Nombre:</span> <?php echo $nombre_usuario; ?> </b></p>
                        <p> <b> <span>Usuario:</span> <?php echo $usuario; ?> </b></p>
                        <p> <b> <span>Rol:</span> <?php echo $nombre_rol; ?> </b></p>
                    </div> 
                    <p class="subtitulo"> *El usuario se eliminará completamente*. </p> <br>

                    <form class="buttons-eliminar" method="post" action="">
                        <input type="hidden" name="id_usuario" value= " <?php echo $id_Usuario; ?> ">
                        <!-- <a href="editarusuario.php">
                            <button id="button-editar" type="button" class="btn btn-warning">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-dash" viewBox="0 0 16 16">
                                    <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                                    <path fill-rule="evenodd" d="M11 7.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5z" />
                                </svg>Inactivar
                            </button>
                        </a> -->
                        <button href="editarusuario.php" id="button-eliminar" type="submit" class="btn btn-danger">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                            </svg>Eliminar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>


    <section id="botones-footer">
        <div class="content">
            <div class="botones-abl-footer">
                <div class="float-left boton wow pulse" data-wow-iteration="infinite" data-wow-duration="500ms">
                    <a href="listausuarios.php" class="boton btn btn-primary"><i class="fas fa-chevron-circle-left"></i></a>
                </div>
                <div class="float-right boton wow pulse" data-wow-iteration="infinite" data-wow-duration="500ms">
                    <a href="../index.php" class="boton btn btn-primary"><i class="fas fa-home"></i></a>
                </div>
            </div>
        </div>
    </section>

    <?php include '../generales/footer.php' ?>


</body>

</html>