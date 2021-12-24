<?php
include "../../php/conexion.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos | Lista Productos</title>
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
            <h2 class="tittle-list">Lista de productos</h2> <br>
        </div>
        <!-- busqueda -->
        <div class="buscador">
            <form id="busqueda-users" class="input-group rounded" action="buscadorclientes.php" method="get">
                <input type="text" class="form-control rounded" aria-label="Search" aria-describedby="search-addon" name="busqueda" id="busqueda" placeholder="Buscar" />
                <button class="input-group-text border-0" id="search-addon">
                    <i type="submit" class="fas fa-search"></i>
                </button>
            </form>
        </div>


        <!-- tabla -->
        <div class="table-productos">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Proveedor</th>
                        <th>Precio</th>
                        <th>Existencia</th>
                        <th>Foto</th>
                        <?php
                        if ($tipo_rol == 'Administrador') {
                        ?>
                            <th width="80px">Acciones</th>
                        <?php } ?>
                    </tr>
                </thead>
                <?php
                // paginador

                $sql_registe = mysqli_query($conn, "SELECT COUNT(*) as total_registros 
                FROM producto WHERE estado = 1");

                $result_register = mysqli_fetch_array($sql_registe);
                $total_registro = $result_register['total_registros'];

                $por_pagina = 3;

                if (empty($_GET['pagina'])) {
                    $pagina = 1;
                } else {
                    $pagina = $_GET['pagina'];
                }

                $desde = ($pagina - 1) * $por_pagina;
                $total_paginas = ceil($total_registro / $por_pagina);


                $query = mysqli_query($conn, "SELECT p.id_producto, p.nombre_producto, p.precio, p.existencia, 
            pr.nombre_proveedor, p.foto
            FROM producto p INNER JOIN proveedor pr ON p.id_proveedor = pr.id_proveedor 
            WHERE p.estado = 1 ORDER BY 
            p.id_producto DESC LIMIT $desde, $por_pagina");

                $result = mysqli_num_rows($query);

                if ($result > 0) {
                    while ($data = mysqli_fetch_array($query)) {

                        if ($data['foto'] != 'img_producto.png') {
                            $foto = 'img_productos/uploads/' . $data['foto'];
                        } else {
                            $foto = 'img_productos/default/' . $data['foto'];
                        }


                ?>
                        <tbody>
                            <tr>
                                <th scope="row"><?php echo $data["id_producto"] ?> </th>
                                <td> <?php echo $data["nombre_producto"] ?> </td>
                                <td> <?php echo $data["nombre_proveedor"] ?> </td>
                                <td><?php echo $data["precio"] ?> </td>
                                <td> <?php echo $data["existencia"] ?> </td>
                                <td> <img src=" <?php echo $foto; ?> " alt=" <?php echo $data["nombre_producto"] ?> " width="80px" height="80px"> </td>

                                <?php
                                if ($tipo_rol == 'Administrador') {
                                ?>
                                    <td class="actions">
                                        <a href="agregarexistencias.php?id=<?php echo $data["id_producto"] ?>">
                                            <button type="button" id="button-agregar" class="btn btn-success">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-repeat" viewBox="0 0 16 16">
                                                    <path d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9z" />
                                                    <path fill-rule="evenodd" d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5.002 5.002 0 0 0 8 3zM3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9H3.1z" />
                                                </svg>
                                            </button>
                                        </a>
                                        <a href="editarproducto.php?id=<?php echo $data["id_producto"] ?>">
                                            <button type="button" id="button-editar" class="btn btn-warning">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                                </svg>
                                            </button>
                                        </a>

                                        <a href="eliminarproducto.php?id=<?php echo $data["id_producto"] ?>">
                                            <button type="button" id="button-eliminar" class="btn btn-danger">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                                </svg>
                                            </button>
                                        </a>
                                    </td>
                                <?php }   ?>
                            <?php
                        } ?>
                            </tr>
                        <?php
                    }
                        ?>
                        </tbody>
            </table>

        </div>
        <div class="paginador">
            <ul>
                <?php
                if ($pagina != 1) {
                ?>
                    <li><a href="?pagina= <?php echo 1; ?> "> |<< </a>
                    </li>
                    <li><a href="?pagina= <?php echo $pagina - 1; ?>">
                            << </a>
                    </li>
                <?php
                }
                for ($i = 1; $i <= $total_paginas; $i++) {


                    if ($i == $pagina) {
                        echo '<li class="pageSelected">' . $i . '</li>';
                    } else {
                        echo '<li><a href="?pagina=' . $i . '">' . $i . '</a></li>';
                    }
                }
                if ($pagina != $total_paginas) {
                ?>


                    <li><a href="?pagina= <?php echo $pagina + 1; ?>"> >> </a></li>
                    <li><a href="?pagina= <?php echo $total_paginas; ?> "> >>| </a></li>
                <?php } ?>
            </ul>
        </div>
    </section>
</body>

</html>