<?php
include "../../php/conexion.php";

if (!empty($_POST)) {
    $alert = '';
    if (
        empty($_POST['id_usuario']) || empty($_POST['usuario']) || empty($_POST['nombre_usuario'])
        || empty($_POST['correo']) || empty($_POST['contrasena']) || empty($_POST['id_rol'])
    ) {
        $alert = ' <h4> 
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                        </svg> <b> Error! Todos los campos son obligatorios.  </b> 
                    </h4> ';
    } else {


        $id_usuario = $_POST['id_usuario'];
        $usuario = $_POST['usuario'];
        $nombre_usuario = $_POST['nombre_usuario'];
        $correo = $_POST['correo'];
        $contrasena = md5($_POST['contrasena']);
        $id_rol = $_POST['id_rol'];

        $query = mysqli_query($conn, "SELECT * FROM usuarios 
        WHERE id_usuario = '$id_usuario' OR  usuario = '$usuario' OR  correo = '$correo'");
        $result = mysqli_fetch_array($query);

        if ($result > 0) {
            $alert = '  <h6> 
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-exclamation-triangle" viewBox="0 0 16 16">
                                <path d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.146.146 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.163.163 0 0 1-.054.06.116.116 0 0 1-.066.017H1.146a.115.115 0 0 1-.066-.017.163.163 0 0 1-.054-.06.176.176 0 0 1 .002-.183L7.884 2.073a.147.147 0 0 1 .054-.057zm1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566z"/>
                                <path d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995z"/>
                            </svg> <b> Error! El ID usuario, usuario o correo ya existen. </b> 
                        </h6> ';
        } else {
            $query_insert = mysqli_query($conn, "INSERT INTO usuarios (id_usuario, usuario, 
            nombre_usuario, correo, contrasena, id_rol) VALUES ('$id_usuario', '$usuario',
            '$nombre_usuario', '$correo', '$contrasena', '$id_rol')");

            if ($query_insert) {
                $alert = '  <h5> 
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                    <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
                                </svg> <b> El usuario se ha creado correctamente. </b> 
                            </h5> ';
            } else {
                $alert = ' <h4 > 
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                </svg> <b> Error al crear el usuario. </b> </h4> ';
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
    <title>Usuarios | Agregar Usuario </title>
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
            <svg class="img-agguser" xmlns="http://www.w3.org/2000/svg" width="70" height="70" fill="currentColor" class="bi bi-person-plus-fill" viewBox="0 0 16 16">
                <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z" />
            </svg>
        </div>
        <div class="container-form">
            <div class="content">
                <div class="row-">

                    <form action="" method="post">
                        <div class="form-content ">
                            <div class="col-sm-4-left">
                                <div class="form-group">
                                    <input type="text" name="id_usuario" id="" placeholder="ID usuario">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="nombre_usuario" id="" placeholder="Nombre y Apellido">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="usuario" id="" placeholder="Usuario">
                                </div>

                            </div>

                            <div class="col-sm-4-right">
                                <div class="form-group">
                                    <input type="text" name="correo" id="" placeholder="Correo">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="contrasena" id="" placeholder="Contraseña">
                                </div>
                                <div class="form-group select">

                                    <?php
                                    $query_rol = mysqli_query($conn, "SELECT * FROM rol");
                                    $result_rol = mysqli_num_rows($query_rol);
                                    ?>

                                    <select class="select-form" name="id_rol">
                                        <?php
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
                        <div class="botones">
                            <button id="button-crear"type="submit" class="btn btn-success">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-save2" viewBox="0 0 16 16">
                                    <path d="M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9.5a1 1 0 0 0-1 1v4.5h2a.5.5 0 0 1 .354.854l-2.5 2.5a.5.5 0 0 1-.708 0l-2.5-2.5A.5.5 0 0 1 5.5 6.5h2V2a2 2 0 0 1 2-2H14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h2.5a.5.5 0 0 1 0 1H2z" />
                                </svg>Crear
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
                    <a href="modulo_usuarios.php" class="boton btn btn-primary"><i
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