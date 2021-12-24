<?php
include "../../php/conexion.php";

if (!empty($_POST)) {
    $alert = '';
    if (
        empty($_POST['usuario']) || empty($_POST['nombre_usuario'])
        || empty($_POST['correo']) || empty($_POST['id_rol'])
    ) {
        $alert ='<div id="alert" class="alert alert-warning d-flex align-items-center" role="alert">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                    </svg><b> Error! Todos los campos son obligatorios.  </b> 
                </div> ';
    } else {

        $id_Usuario = $_POST['id_usuario'];
        $usuario = $_POST['usuario'];
        $nombre_usuario = $_POST['nombre_usuario'];
        $correo = $_POST['correo'];
        $contrasena = md5($_POST['contrasena']);
        $id_rol = $_POST['id_rol'];
        $estado = 1;

        $query = mysqli_query($conn, "SELECT * FROM usuarios  
         WHERE  (usuario = '$usuario' AND id_usuario != $id_Usuario) 
         OR  (correo = '$correo' AND id_usuario != $id_Usuario) ");

        $result = mysqli_fetch_array($query);


        if ($result > 0) {
            $alert ='<div id="alert" class="alert alert-danger d-flex align-items-center" role="alert">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                        </svg><b> Error! El Usuario o correo ya existen.  </b> 
                    </div>';
        } else {

            if (empty($_POST['contrasena'])) {

                $sql_update = mysqli_query($conn, "UPDATE usuarios SET nombre_usuario = '$nombre_usuario', 
                usuario = '$usuario', correo = '$correo', id_rol = '$id_rol', estado = '$estado'
                WHERE id_usuario = $id_Usuario");
            } else {
                $sql_update = mysqli_query($conn, "UPDATE usuarios SET nombre_usuario = '$nombre_usuario', 
                usuario = '$usuario', correo = '$correo', contrasena = '$contrasena', id_rol = '$id_rol', 
                estado = '$estado'
                WHERE id_usuario = $id_Usuario");
            }

            if ($sql_update) {
                $alert ='<div id="alert" class="alert alert-success d-flex align-items-center" role="alert">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                            </svg><b> El usuario se ha actualizado correctamente  </b> 
                        </div>';
            } else {
                $alert ='<div id="alert" class="alert alert-danger d-flex align-items-center" role="alert">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                            </svg><b> Error al actualizar el usuario  </b> 
                        </div>';
            }
        }
    }
}

// mostrar datos

if (empty($_GET['id'])) {
    header('location:listausuarios.php');
}
$id_Usuario =  $_GET['id'];

$sql = mysqli_query($conn, "SELECT u.id_usuario, u.nombre_usuario, u.usuario, u.correo, u.estado, (u.id_rol) as id_rol, (r.nombre_rol) as nombre_rol FROM usuarios u INNER JOIN rol r ON u.id_rol = r.id_rol WHERE id_usuario=$id_Usuario AND estado=1");
$result_edit = mysqli_num_rows($sql);

if ($result_edit == 0) {
    header('location:listausuarios.php');
} else {

    $option_rol = '';
    while ($data = mysqli_fetch_array($sql)) {
        $id_Usuario = $data['id_usuario'];
        $nombre_usuario = $data['nombre_usuario'];
        $usuario = $data['usuario'];
        $correo = $data['correo'];
        $estado = 1;
        $id_rol = $data['id_rol'];
        $nombre_rol = $data['nombre_rol'];

        // option-rol
        if ($id_rol == 1) {
            $option_rol = '<option value= "' . $id_rol . '"select>' . $nombre_rol . ' </option>';
        } else if ($id_rol == 2) {
            $option_rol = '<option value= "' . $id_rol . '"select>' . $nombre_rol . ' </option>';
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
            <h2>Editar usuario </h2> <br>
        </div>
        <form action="" method="post">
            <div class="formulario">
                <div>
                    <input type="hidden" name="id_usuario" id="" value=" <?php echo $id_Usuario; ?> ">
                    <div class="form-group">
                        <label for="formGroupExampleInput2">Nombre</label>
                        <input type="text" class="form-control" id="" name="nombre_usuario" value="<?php echo $nombre_usuario; ?>">
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput2">Usuario</label>
                        <input type="text" class="form-control" id="" name="usuario" value="<?php echo $usuario; ?>">
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput">Correo</label>
                        <input type="text" class="form-control" id="" name="correo" value="<?php echo $correo; ?>">
                    </div>
                </div>
                <div>
                    <div class="form-group">
                        <label for="formGroupExampleInput">Contraseña</label>
                        <input type="password" class="form-control" id="" name="contrasena">
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput2">Rol</label>
                        <?php
                        $query_rol = mysqli_query($conn, "SELECT * FROM rol");
                        $result_rol = mysqli_num_rows($query_rol);
                        ?>
                        <select class="form-control" aria-label="Default select example" name="id_rol">
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
                </div>
            </div>
            <div class="button">
                <input id="login" type="submit" value="Actualizar" class="btn float-right login_btn">
            </div>
        </form>
        <?php echo isset($alert) ? $alert : ''; ?>

    </section>


</body>

</html>