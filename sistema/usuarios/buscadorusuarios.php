<?php
include "../../php/conexion.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios | Lista Usuarios</title>
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
        <div>
            <h2 class="tittle-list">Lista de usuarios</h2> <br>
        </div>
        <?php
        $busqueda = strtolower($_REQUEST['busqueda']);
        if (empty($busqueda)) {
            header('location:listausuarios.php');
        }
        ?>
        <!-- busqueda -->
        <div class="buscador">
            <form id="busqueda-users" class="input-group rounded" action="buscadorusuarios.php" method="get">
                <input type="text" class="form-control rounded" aria-label="Search" aria-describedby="search-addon" name="busqueda" id="busqueda" placeholder="Buscar" value="<?php echo $busqueda; ?>" />
                <button class="input-group-text border-0" id="search-addon">
                    <i type="submit" class="fas fa-search"></i>
                </button>
            </form>
        </div>


        <!-- tabla -->
        <table class="table">
            <thead>
                <tr>
                    <th>ID usuario</th>
                    <th>Nombre</th>
                    <th>Usuario</th>
                    <th>Correo</th>
                    <th>Rol</th>
                    <?php
                    if ($tipo_rol == 'Administrador') {
                    ?>
                        <th>Acciones</th>
                    <?php } ?>
                </tr>
            </thead>
            <?php
            //paginador

            $rol = '';
            if ($busqueda == 'administrador' || $busqueda == 'a'|| $busqueda == 'ad' || $busqueda == 'adm' || $busqueda == 'admi'
            || $busqueda == 'admin' || $busqueda == 'admini' || $busqueda == 'adminis' || $busqueda == 'administ'
            || $busqueda == 'administra' || $busqueda == 'administrad' || $busqueda == 'administrado') {
                $rol = "OR id_rol LIKE '%1%'";
            } else if ($busqueda == 'empleado' || $busqueda == 'e' || $busqueda == 'em' || $busqueda == 'emp' || $busqueda == 'empl'
            || $busqueda == 'emple' || $busqueda == 'emplea' || $busqueda == 'emplead') {
                $rol = "OR id_rol LIKE '%2%'";
            }
            
            $sql_registe = mysqli_query($conn, "SELECT COUNT(*) as total_registros FROM usuarios 
            WHERE 
            (id_usuario LIKE '%$busqueda%' OR
            nombre_usuario LIKE '%$busqueda%' OR
            usuario LIKE '%$busqueda%' OR
            correo LIKE '%$busqueda%' $rol)
            AND
            estado = 1");

            $result_register = mysqli_fetch_array($sql_registe);
            $total_registro = $result_register['total_registros'];

            $por_pagina = 5;

            if (empty($_GET['pagina'])) {
                $pagina = 1;
            } else {
                $pagina = $_GET['pagina'];
            }

            $desde = ($pagina - 1) * $por_pagina;
            $total_paginas = ceil($total_registro / $por_pagina);


            $query = mysqli_query($conn, "SELECT u.id_usuario, u.nombre_usuario, u.usuario, u.correo, u.estado, r. nombre_rol 
            FROM usuarios u 
            INNER JOIN rol r ON u.id_rol = r.id_rol 
            WHERE 
            (u.id_usuario LIKE '%$busqueda%' OR
            u.nombre_usuario LIKE '%$busqueda%' OR
            u.usuario LIKE '%$busqueda%' OR
            u.correo LIKE '%$busqueda%' OR r.nombre_rol LIKE '%$busqueda%')
            AND
            estado = 1 ORDER BY u.id_usuario ASC LIMIT $desde, $por_pagina");

            $result = mysqli_num_rows($query);

            if ($result > 0) {
                while ($data = mysqli_fetch_array($query)) {

                    $estado = '';
                    if ($data["estado"] == 1) {
                        $estado = 'Activo';
                    } else {
                        $estado = 'Inactvo';
                    }


            ?>
                    <tbody>
                        <tr>
                            <th scope="row"><?php echo $data["id_usuario"] ?> </th>
                            <td> <?php echo $data["nombre_usuario"] ?> </td>
                            <td> <?php echo $data["usuario"] ?> </td>
                            <td><?php echo $data["correo"] ?> </td>
                            <td> <?php echo $data["nombre_rol"] ?></td>

                            <?php
                            if ($tipo_rol == 'Administrador') {
                            ?>
                                <td>
                                    <?php
                                    if ($data["nombre_rol"] != 'Administrador') {
                                    ?>
                                        <a href="editarusuario.php?id=<?php echo $data["id_usuario"] ?>">
                                            <button type="button" id="button-editar" class="btn btn-warning">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                                </svg>
                                            </button>
                                        </a>

                                        <a href="eliminarusuario.php?id=<?php echo $data["id_usuario"] ?>">
                                            <button type="button" id="button-eliminar" class="btn btn-danger">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                                </svg>
                                            </button>
                                        </a>
                                    <?php } else {  ?>
                                        <a href="editarusuario.php?id=<?php echo $data["id_usuario"] ?>">
                                            <button type="button" id="button-editar" class="btn btn-warning">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                                </svg>

                                            </button>
                                        </a>

                                <?php }
                                } ?>
                        </tr>
                <?php
                }
            }
                ?>
                    </tbody>
        </table>
        <?php
        if ($total_registro != 0) {
        ?>
            <div class="paginador">
                <ul>
                    <?php
                    if ($pagina != 1) {
                    ?>
                        <li><a href="?pagina= <?php echo 1; ?>&busqueda=<?php echo $busqueda; ?>"> |<< </a>
                        </li>
                        <li><a href="?pagina= <?php echo $pagina - 1; ?>&busqueda=<?php echo $busqueda; ?>">
                                << </a>
                        </li>
                    <?php
                    }
                    for ($i = 1; $i <= $total_paginas; $i++) {


                        if ($i == $pagina) {
                            echo '<li class="pageSelected">' . $i . '</li>';
                        } else {
                            echo '<li><a href="?pagina=' . $i . '&busqueda=' . $busqueda . '">' . $i . '</a></li>';
                        }
                    }
                    if ($pagina != $total_paginas) {
                    ?>


                        <li><a href="?pagina= <?php echo $pagina + 1; ?>&busqueda=<?php echo $busqueda; ?>"> >> </a></li>
                        <li><a href="?pagina= <?php echo $total_paginas; ?>&busqueda=<?php echo $busqueda; ?>"> >>| </a></li>
                    <?php } ?>
                </ul>
            </div>
        <?php } else if ($total_registro == 0) { ?>
            </div>
            <div id="alert-buscador" class="alert alert-danger d-block align-items-center" role="alert">
                <div class="div-alertbusc">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle-fill" viewBox="0 0 16 16">
                        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
                    </svg><b> No se encontraron registros para esta búsqueda </b> <br>
                </div>
                <a class="a-buscador" href="./listausuarios.php">Volver</a>
            </div>
        <?php } ?>
    </section>

</body>

</html>