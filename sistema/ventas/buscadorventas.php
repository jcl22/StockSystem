<?php
include "../../php/conexion.php";

$busqueda = '';
$fecha_de = '';
$fecha_a = '';

if (isset($_REQUEST['busqueda']) && $_REQUEST['busqueda'] == '') {
    header('location:listaventas.php');
}
if ( isset($_REQUEST['fecha_de']) || isset($_REQUEST['fecha_a']) ) {
    if ($_REQUEST['fecha_de'] == '' || $_REQUEST['fecha_a'] == '') {
        header('location:listaventas.php');
    }
}



if (!empty($_REQUEST['busqueda'])) {
    if (!is_numeric($_REQUEST['busqueda'])) {
        header('location:listaventas.php');
    }
    $busqueda = strtolower($_REQUEST['busqueda']);
    $where = "id_venta = $busqueda";
    $buscar = "busqueda = $busqueda";
}

    if (!empty($_REQUEST['fecha_de']) && !empty($_REQUEST['fecha_a'])) {
        $fecha_de = $_REQUEST['fecha_de'];
        $fecha_a = $_REQUEST['fecha_a'];

        $buscar = '';

        if ($fecha_de > $fecha_a) {
            header('location:listaventas.php');
        } else if ($fecha_de == $fecha_a) {
            $where = "fecha_venta LIKE '$fecha_de%'";
            $buscar = 'fecha_de=$fecha_de&fecha_a=$fecha_a';
        } else {
            $f_de = $fecha_de.'00:00:00';
            $f_a = $fecha_de.'23:59:59';
            $where = "fecha BETWEEN '$f_de' AND '$f_a'";
            $buscar = 'fecha_de=$fecha_de&fecha_a=$fecha_a';
        }
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ventas | Lista de ventas</title>
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
            <h2 class="tittle-list">Lista de ventas</h2> <br>
        </div>
        <!-- busqueda -->
        <div class="buscador" id="buscar-venta">
            <!-- busqueda por No. de venta-->
            <form id="busqueda-venta" class="input-group rounded" action="buscadorventas.php" method="get">
                <input type="text" class="form-control rounded" aria-label="Search" aria-describedby="search-addon" 
                name="busqueda" id="busqueda" placeholder="No. Venta" value="<?php echo $busqueda; ?>" />
                <button class="input-group-text border-0" id="search-addon">
                    <i type="submit" class="fas fa-search"></i>
                </button>
            </form>
            <!-- busqueda por fecha -->
            <form id="busqueda-venta" class="input-group rounded" action="buscadorventas.php" method="get">
                <input type="date" class="form-control rounded" aria-label="Search" aria-describedby="search-addon" 
                name="fecha_de" id="fecha_de" value="<?php echo $fecha_de; ?>"  required/>
                <input type="date" class="form-control rounded" aria-label="Search" aria-describedby="search-addon" 
                name="fecha_a" id="fecha_a" value="<?php echo $fecha_a; ?>"  required/>
                <button class="input-group-text border-0" id="search-addon">
                    <i type="submit" class="fas fa-search"></i>
                </button>
            </form>
        </div>

        <!-- tabla -->
        <table class="table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Fecha</th>
                    <th>Cliente</th>
                    <th>Vendedor</th>
                    <th class="text-center">Estado</th>
                    <th class="text-right">Valor total</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <?php
            // paginador
            
            $sql_registe = mysqli_query($conn, "SELECT COUNT(*) as total_registros 
                FROM venta WHERE $where");

            $result_register = mysqli_fetch_array($sql_registe);
            $total_registro = $result_register['total_registros'];

            $por_pagina = 15;

            if (empty($_GET['pagina'])) {
                $pagina = 1;
            } else {
                $pagina = $_GET['pagina'];
            }

            $desde = ($pagina - 1) * $por_pagina;
            $total_paginas = ceil($total_registro / $por_pagina);

            $query = mysqli_query($conn, "SELECT v.id_venta, v.fecha_venta, v.total_venta, 
                                                v.estado, v.id_cliente,
                                                u.nombre_usuario as vendedor, 
                                                cl.nombre_cliente as cliente 
                                                FROM venta v
                                                INNER JOIN usuarios u
                                                ON v.id_usuario = u.id_usuario 
                                                INNER JOIN cliente cl
                                                ON v.id_cliente = cl.id_cliente 
                                                WHERE $where AND v.estado != 10
                                                ORDER BY v.fecha_venta DESC 
                                                LIMIT $desde, $por_pagina");
            $result = mysqli_num_rows($query);

            if ($result > 0) {
                while ($data = mysqli_fetch_array($query)) {
                    if ($data['estado'] == 1) {
                        $estado =   ' <div class="pagada"> <b>
                                        <p>Pagada
                                        </p> </b>
                                    </div> ';
                    } else {
                        $estado =   ' <div class="anulada"> <b>
                                        <p >Anulada
                                        </p>  </b>
                                    </div> ';
                    }
            ?>
                    <tbody>
                        <tr id="row_<?php echo $data["id_venta"] ?>">
                            <th scope="row"><?php echo $data["id_venta"] ?> </th>
                            <td><?php echo $data["fecha_venta"] ?> </td>
                            <td> <?php echo $data["cliente"] ?> </td>
                            <td> <?php echo $data["vendedor"] ?> </td>
                            <td><?php echo $estado; ?> </td>
                            <td class="text-right"> <span>$</span><?php echo $data["total_venta"] ?> </td>


                            <td class="text-center">
                                <a href="http://localhost/stocksystem/sistema/ventas/factura/generaFactura.php?cl=<?php echo $data["id_cliente"]; ?>&f=<?php echo $data["id_venta"]; ?>"
                                target="_blank">
                                    <button type="button" id="button-ver" class="btn btn-sucess">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-pdf" viewBox="0 0 16 16">
                                            <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z" />
                                            <path d="M4.603 14.087a.81.81 0 0 1-.438-.42c-.195-.388-.13-.776.08-1.102.198-.307.526-.568.897-.787a7.68 7.68 0 0 1 1.482-.645 19.697 19.697 0 0 0 1.062-2.227 7.269 7.269 0 0 1-.43-1.295c-.086-.4-.119-.796-.046-1.136.075-.354.274-.672.65-.823.192-.077.4-.12.602-.077a.7.7 0 0 1 .477.365c.088.164.12.356.127.538.007.188-.012.396-.047.614-.084.51-.27 1.134-.52 1.794a10.954 10.954 0 0 0 .98 1.686 5.753 5.753 0 0 1 1.334.05c.364.066.734.195.96.465.12.144.193.32.2.518.007.192-.047.382-.138.563a1.04 1.04 0 0 1-.354.416.856.856 0 0 1-.51.138c-.331-.014-.654-.196-.933-.417a5.712 5.712 0 0 1-.911-.95 11.651 11.651 0 0 0-1.997.406 11.307 11.307 0 0 1-1.02 1.51c-.292.35-.609.656-.927.787a.793.793 0 0 1-.58.029zm1.379-1.901c-.166.076-.32.156-.459.238-.328.194-.541.383-.647.547-.094.145-.096.25-.04.361.01.022.02.036.026.044a.266.266 0 0 0 .035-.012c.137-.056.355-.235.635-.572a8.18 8.18 0 0 0 .45-.606zm1.64-1.33a12.71 12.71 0 0 1 1.01-.193 11.744 11.744 0 0 1-.51-.858 20.801 20.801 0 0 1-.5 1.05zm2.446.45c.15.163.296.3.435.41.24.19.407.253.498.256a.107.107 0 0 0 .07-.015.307.307 0 0 0 .094-.125.436.436 0 0 0 .059-.2.095.095 0 0 0-.026-.063c-.052-.062-.2-.152-.518-.209a3.876 3.876 0 0 0-.612-.053zM8.078 7.8a6.7 6.7 0 0 0 .2-.828c.031-.188.043-.343.038-.465a.613.613 0 0 0-.032-.198.517.517 0 0 0-.145.04c-.087.035-.158.106-.196.283-.04.192-.03.469.046.822.024.111.054.227.09.346z" />
                                        </svg>
                                    </button>
                                </a>

                                <?php
                                if ($tipo_rol == 'Administrador') {
                                    if ($data['estado'] == 1) {
                                ?>

                                        <a href="anularventa.php?id=<?php echo $data["id_venta"] ?>">
                                            <button type="button" id="anular_venta" class="btn btn-danger">
                                                <i class="fas fa-ban"></i>
                                            </button>
                                        </a>

                                    <?php } else { ?>

                                        <a>
                                            <button type="button" id="inactive_venta" class="btn btn-danger">
                                                <i class="fas fa-ban"></i>
                                            </button>
                                        </a>
                            <?php
                                    }
                                }
                            } ?>
                            </td>
                        </tr>
                    <?php
                }
                    ?>
                    </tbody>
        </table>
        <div class="paginador">
            <ul>
                <?php
                if ($pagina != 1) {
                ?>
                    <li><a href="?pagina= <?php echo 1; ?>&<?php echo $buscar;?>"> |<< </a>
                    </li>
                    <li><a href="?pagina= <?php echo $pagina - 1; ?>&<?php echo $buscar;?>">
                            << </a>
                    </li>
                <?php
                }
                for ($i = 1; $i <= $total_paginas; $i++) {


                    if ($i == $pagina) {
                        echo '<li class="pageSelected">'.$i.'</li>';
                    } else {
                        echo '<li><a href="?pagina='.$i.'&'.$buscar.'">'.$i.'</a></li>';
                    }
                }
                if ($pagina != $total_paginas) {
                ?>


                    <li><a href="?pagina= <?php echo $pagina + 1; ?>&<?php echo $buscar;?>"> >> </a></li>
                    <li><a href="?pagina= <?php echo $total_paginas; ?>&<?php echo $buscar;?> "> >>| </a></li>
                <?php } ?>
            </ul>
        </div>

    </section>
    <script src="../generales/funciones.js"></script>
</body>

</html>