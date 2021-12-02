<?php
include "../../php/conexion.php";

if (!empty($_POST)) {
    $alert = '';
    if (empty($_POST['usuario']) || empty($_POST['nombre_usuario'])
        || empty($_POST['correo']) || empty($_POST['id_rol'])
        || empty($_POST['estado'])) 
        {
        $alert = ' <h4> 
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                        </svg> <b> Error! Todos los campos son obligatorios.  </b> 
                    </h4> ';
    } else {

        $id_Usuario = $_POST['id_usuario']; 
        $usuario = $_POST['usuario'];
        $nombre_usuario = $_POST['nombre_usuario'];
        $correo = $_POST['correo'];
        $contrasena = md5($_POST['contrasena']);
        $id_rol = $_POST['id_rol'];
        $estado = $_POST['estado'];

        $query = mysqli_query($conn, "SELECT * FROM usuarios  
         WHERE  (usuario = '$usuario' AND id_usuario != $id_Usuario) 
         OR  (correo = '$correo' AND id_usuario != $id_Usuario) ");
        
        $result = mysqli_fetch_array($query);


        if ($result > 0) {
            $alert = '  <h6> 
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-exclamation-triangle" viewBox="0 0 16 16">
                                <path d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.146.146 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.163.163 0 0 1-.054.06.116.116 0 0 1-.066.017H1.146a.115.115 0 0 1-.066-.017.163.163 0 0 1-.054-.06.176.176 0 0 1 .002-.183L7.884 2.073a.147.147 0 0 1 .054-.057zm1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566z"/>
                                <path d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995z"/>
                            </svg> <b> Error! El correo o usuario ya existen. </b> 
                        </h6> ';
        } else {

            if (empty($_POST['contrasena'])) {

                $sql_update = mysqli_query ($conn, "UPDATE usuarios SET nombre_usuario = '$nombre_usuario', 
                usuario = '$usuario', correo = '$correo', id_rol = '$id_rol', estado = '$estado'
                WHERE id_usuario = $id_Usuario");

            } else {
                $sql_update = mysqli_query ($conn, "UPDATE usuarios SET nombre_usuario = '$nombre_usuario', 
                usuario = '$usuario', correo = '$correo', contrasena = '$contrasena', id_rol = '$id_rol', 
                estado = '$estado'
                WHERE id_usuario = $id_Usuario");
            }

            if ($sql_update) {
                $alert = '  <h5> 
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                    <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
                                </svg> <b> El usuario se ha actualizado correctamente. </b> 
                            </h5> ';
            } else {
                $alert = ' <h4 > 
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                </svg> <b> Error al actualizar el usuario. </b> </h4> ';

            }
        }
    }
}

// mostrar datos

if (empty($_GET['id'])) {
    header ('location:listausuarios.php');
}
$id_Usuario =  $_GET['id'];

$sql= mysqli_query($conn, "SELECT u.id_usuario, u.nombre_usuario, u.usuario, u.correo, u.estado, (u.id_rol) as id_rol, (r.nombre_rol) as nombre_rol FROM usuarios u INNER JOIN rol r ON u.id_rol = r.id_rol WHERE id_usuario=$id_Usuario");

$result_edit = mysqli_num_rows($sql);

if ($result_edit == 0 ) {
    header ('location:listausuarios.php');
} else {

    $option_rol='';
    while ($data = mysqli_fetch_array($sql)) {
        $id_Usuario = $data ['id_usuario'];
        $nombre_usuario = $data ['nombre_usuario'];
        $usuario = $data ['usuario'];
        $correo = $data ['correo'];
        $estado = $data ['estado'];
        $id_rol = $data ['id_rol'];
        $nombre_rol = $data ['nombre_rol'];

        // option-rol
        if($id_rol==1) {
            $option_rol ='<option value= "'.$id_rol.'"select>' .$nombre_rol. ' </option>';
        } else if ($id_rol==2) {
            $option_rol='<option value= "'.$id_rol.'"select>' .$nombre_rol. ' </option>';
        }

        // option-estado
        // if($estado=='Activo') {
        //     $option_est ='<option value= "'.$estado.'"select>' .$nombre_rol. ' </option>';
        // } else if ($id_rol=='Inactivo') {
        //     $option_est ='<option value= "'.$id_rol.'"select>' .$nombre_rol. ' </option>';
        // }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios | Editar Usuario </title>
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

    <?php include '../generales/header2.php'?>


    <section id="content-section" >
        <div class="titulo-section">
            <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
            </svg>
        </div>
        <div class="container-form">
            <div class="content">
                <div class="row-">

                    <form action="" method="post">
                        <div class="form-content ">
                            <div class="col-sm-4-left">
                                    <input type="hidden" name="id_usuario" id="" value=" <?php echo $id_Usuario; ?> ">
                                <div class="form-group">
                                    <input type="text" name="nombre_usuario" id="" placeholder="Nombre y Apellido" value= "<?php echo $nombre_usuario; ?>" >
                                </div>
                                <div class="form-group">
                                    <input type="text" name="usuario" id="" placeholder="Usuario" value= "<?php echo $usuario; ?>" >
                                </div>
                                <div class="form-group">
                                    <input type="text" name="correo" id="" placeholder="Correo" value= "<?php echo $correo; ?>" >
                                </div>
                            </div>

                            <div class="col-sm-4-right">
                                <div class="form-group">
                                    <input type="password" name="contrasena" id="" placeholder="Contraseña"?> 
                                </div>
                                <!-- <div class="form-group">
                                    <input type="password" name="confirm_contrasena" id="" placeholder="Confirmar contraseña">
                                </div> -->
                                <div class="form-group select">

                                    <?php 
                                    $query_rol = mysqli_query($conn, "SELECT * FROM rol");
                                    $result_rol = mysqli_num_rows($query_rol);
                                    ?>

                                    <select class="select-rol" name="id_rol">
                                        <?php
                                        echo $option_rol;

                                        if ($result_rol > 0) {
                                            while ($rol = mysqli_fetch_array($query_rol)) {
                                        ?>
                                                <option value="<?php echo $rol["id_rol"]; ?>">
                                                    <?php echo $rol["nombre_rol"] ?></option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <select name="estado" id="">
                                    <option value="Activo">Activo</option>
                                    <option value="Inactivo">Inactivo</option>
                                </select>
                            </div>
                        </div>
                        <div class="botones">
                            <button id="button-modificar" type="submit" class="btn btn-warning">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen-fill" viewBox="0 0 16 16">
                                    <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001z"/>
                                </svg>Actualizar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="alert">
            <?php echo isset($alert) ? $alert : ''; ?>
        </div>
    </section>

    <section id="botones-footer">
        <div class="content">
            <div class="botones-abl-footer">
                <div class="float-left boton wow pulse" data-wow-iteration="infinite" data-wow-duration="500ms">
                    <a href="listausuarios.php" class="boton btn btn-primary"><i
                            class="fas fa-chevron-circle-left"></i></a>
                </div>
                <div class="float-right boton wow pulse" data-wow-iteration="infinite" data-wow-duration="500ms">
                    <a href="../index.php" class="boton btn btn-primary"><i class="fas fa-home"></i></a>
                </div>
            </div>
        </div>
    </section>

        <?php include '../generales/footer.php'?>



</body>

</html>